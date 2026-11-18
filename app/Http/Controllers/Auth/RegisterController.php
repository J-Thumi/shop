<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailOtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Register a new ecommerce customer and send an email OTP.
     */
    public function store(
        Request $request,
        EmailOtpService $otpService
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],

            'terms' => [
                'required',
                'accepted',
            ],
        ], [
            'terms.accepted' => 'You must accept the Terms of Service and Privacy Policy to complete registration.',
        ]);

        $email = strtolower(trim($validated['email']));

        $user = User::create([
            'name' => $validated['name'],
            'email' => $email,
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'terms_accepted_at' => now(),
        ]);

        // The customer must verify their email before logging in.
        $otp = $otpService->send($user);

        $request->session()->put([
            'pending_otp_id' => $otp->id,
            'pending_otp_user_id' => $user->id,
            'pending_otp_remember' => false,
        ]);

        return redirect()->route('otp.create')
            ->with(
                'status',
                'Your account has been created. Check your email for your verification code.'
            );
    }
}
