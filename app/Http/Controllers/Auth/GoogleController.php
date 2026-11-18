<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    /**
     * Redirect the customer to Google.
     */
    public function redirect(Request $request): RedirectResponse
    {
        $intent = $request->query('intent', 'login');

        if (!in_array($intent, ['login', 'register'], true)) {
            abort(400);
        }

        $request->session()->put('google_auth_intent', $intent);

        return Socialite::driver('google')
            ->scopes(['openid', 'email', 'profile'])
            ->redirect();
    }

    /**
     * Handle Google's callback.
     */
    public function callback(Request $request): RedirectResponse
    {
        if ($request->has('error')) {
            $this->clearGoogleSession($request);

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Google authentication was cancelled or denied.',
                ]);
        }

        $intent = $request->session()->pull('google_auth_intent', 'login');

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            report($e);

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Unable to authenticate with Google. Please try again.',
                ]);
        }

        // Only accept a verified Google email address.
        if (
            empty($googleUser->email) ||
            !filter_var($googleUser->email, FILTER_VALIDATE_EMAIL) ||
            !($googleUser->user['email_verified'] ?? false)
        ) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Google must provide a verified email address.',
                ]);
        }

        $email = strtolower(trim($googleUser->email));
        $googleId = $googleUser->getId();

        // 1. Check whether this Google account is already linked.
        $user = User::where('google_id', $googleId)->first();

        if ($user) {
            // Prevent a Google identity from authenticating an account
            // whose email no longer matches.
            if (strtolower($user->email) !== $email) {
                return redirect()->route('login')
                    ->withErrors([
                        'email' => 'Your Google email does not match the email linked to your account.',
                    ]);
            }

            $user->forceFill([
                'google_avatar' => $googleUser->getAvatar(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();

            return $this->authenticateUser($request, $user, false);
        }

        // 2. Check whether a normal ecommerce account already exists.
        $user = User::where('email', $email)->first();

        if ($user) {
            // Do not overwrite an existing Google identity.
            if ($user->google_id !== null) {
                return redirect()->route('login')
                    ->withErrors([
                        'email' => 'This account is already linked to another Google account.',
                    ]);
            }

            // Google has verified ownership of this email.
            // Link the existing customer account.
            $user->forceFill([
                'google_id' => $googleId,
                'google_avatar' => $googleUser->getAvatar(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();

            return $this->authenticateUser($request, $user, false);
        }

        // 3. No existing account was found.
        // Do not silently register a customer who selected Login.
        if ($intent === 'login') {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'No account exists with this Google email. Please create an account first.',
                ]);
        }

        // 4. Start the ecommerce registration process.
        $request->session()->put('google_registration', [
            'google_id' => $googleId,
            'name' => $googleUser->getName() ?: 'Customer',
            'email' => $email,
            'avatar' => $googleUser->getAvatar(),
        ]);

        return redirect()->route('google.complete');
    }

    /**
     * Display the remaining customer registration form.
     */
    public function complete(Request $request)
    {
        $googleData = $request->session()->get('google_registration');

        if (!$googleData) {
            return redirect()->route('register');
        }

        return view('auth.google-complete', [
            'googleData' => $googleData,
        ]);
    }

    /**
     * Complete ecommerce customer registration.
     */
    public function store(Request $request): RedirectResponse
    {
        $googleData = $request->session()->get('google_registration');

        if (!$googleData) {
            return redirect()->route('register');
        }

        $validated = $request->validate([
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone',
            ],
            'terms' => [
                'required',
                'accepted',
            ],
        ], [
            'terms.accepted' => 'You must accept the Terms of Service and Privacy Policy to continue.',
        ]);

        // Create the account inside a transaction.
        $user = DB::transaction(function () use ($googleData, $validated) {

            // Protect against duplicate registrations.
            $existingUser = User::where('email', $googleData['email'])
                ->orWhere('google_id', $googleData['google_id'])
                ->lockForUpdate()
                ->first();

            if ($existingUser) {
                return null;
            }

            $user = new User();

            $user->forceFill([
                'name' => $googleData['name'],
                'email' => $googleData['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make(Str::random(64)),
                'google_id' => $googleData['google_id'],
                'google_avatar' => $googleData['avatar'],
                'email_verified_at' => now(),
                'terms_accepted_at' => now(),
            ]);

            $user->save();

            return $user;
        });

        if (!$user) {
            $request->session()->forget('google_registration');

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'An account with this Google email already exists. Please sign in.',
                ]);
        }

        $request->session()->forget('google_registration');

        // Google has already verified the customer's email.
        // No additional email OTP is necessary.
        return $this->authenticateUser($request, $user, true);
    }

    /**
     * Authenticate the customer and redirect to the shop.
     */
    private function authenticateUser(
        Request $request,
        User $user,
        bool $registration
    ): RedirectResponse {

        // Clear unfinished authentication and registration state.
        $request->session()->forget([
            'pending_otp_id',
            'pending_otp_user_id',
            'pending_otp_remember',
            'pending_otp_fallback',
            'google_auth_intent',
            'google_registration',
        ]);

        Auth::login($user, false);

        // Regenerate session ID to prevent session fixation.
        $request->session()->regenerate();

        // Return the customer to their intended destination.
        // Otherwise, take them to the product catalogue.
        return redirect()->intended(route('products.index'))
            ->with(
                'status',
                $registration
                    ? 'Your ' . config('app.name') . ' account has been created successfully!'
                    : 'You have successfully signed in with Google.'
            );
    }

    /**
     * Clear unfinished Google authentication state.
     */
    private function clearGoogleSession(Request $request): void
    {
        $request->session()->forget([
            'google_auth_intent',
            'google_registration',
        ]);
    }
}
