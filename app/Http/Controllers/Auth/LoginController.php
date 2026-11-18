<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailOtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Validate credentials and send an email OTP.
     */
    public function store(
        Request $request,
        EmailOtpService $otpService
    ): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials['email'] = strtolower(trim($credentials['email']));

        $remember = $request->boolean('remember');

        $key = 'login:' . $credentials['email'] . ':' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again later.',
            ])->onlyInput('email');
        }

        if (!Auth::validate($credentials)) {
            RateLimiter::hit($key, 60);

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        RateLimiter::clear($key);

        $user = User::where('email', $credentials['email'])->firstOrFail();

        // If the email is already verified, still require OTP for
        // password-based login, as intended by this authentication flow.
        $otp = $otpService->send($user);

        $request->session()->put([
            'pending_otp_id' => $otp->id,
            'pending_otp_user_id' => $user->id,
            'pending_otp_remember' => $remember,
        ]);

        return redirect()->route('otp.create')
            ->with('status', 'We have sent a verification code to your email address.');
    }

    /**
     * Log out the authenticated customer.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('products.index');
    }
}
