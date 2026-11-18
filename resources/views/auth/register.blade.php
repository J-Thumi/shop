
@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center px-4 sm:px-6 py-12 bg-[#FAFAFA]">

    <div class="w-full max-w-[480px]">

        {{-- Registration Card --}}
        <div class="bg-white border border-[#E4E4E7] rounded-2xl shadow-sm p-6 sm:p-9">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="mx-auto mb-5 flex items-center justify-center w-12 h-12 rounded-2xl bg-orange-50 text-[#F97316]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                            d="M12 4v16m8-8H4" />
                    </svg>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#18181B]">
                    Create your account
                </h1>

                <p class="mt-2 text-sm text-[#71717A]">
                    Join {{ config('app.name') }} and discover quality technology products.
                </p>
            </div>

            {{-- Google Registration --}}
            <a href="{{ route('google.redirect', ['intent' => 'register']) }}"
                class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-[#E4E4E7] rounded-xl text-sm font-semibold text-[#18181B] hover:bg-[#FAFAFA] hover:border-[#D4D4D8] transition-colors duration-200">

                <svg class="w-5 h-5 shrink-0" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 3.07 13.22l7.98 6.19C12.73 13.72 17.87 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.77 7.18l7.73 6C44.4 37.88 46.98 31.7 46.98 24.55z"/>
                    <path fill="#FBBC05" d="M10.05 28.59A14.4 14.4 0 0 1 9.27 24c0-1.59.28-3.13.78-4.59l-7.98-6.19A23.92 23.92 0 0 0 0 24c0 3.86.92 7.52 2.55 10.78l7.5-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.9-5.8l-7.73-6c-2.15 1.45-4.9 2.3-8.17 2.3-6.13 0-11.27-4.22-12.95-9.91l-7.5 6.19C7.01 43.3 14.91 48 24 48z"/>
                </svg>

                Continue with Google
            </a>

            {{-- Divider --}}
            <div class="relative flex items-center my-7">
                <div class="flex-grow border-t border-[#E4E4E7]"></div>
                <span class="px-4 text-xs font-medium text-[#A1A1AA]">OR REGISTER WITH EMAIL</span>
                <div class="flex-grow border-t border-[#E4E4E7]"></div>
            </div>

            {{-- Registration Form --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-[#18181B] mb-2">
                        Full name
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        autocomplete="name"
                        required
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        class="w-full px-4 py-3 bg-white border border-[#E4E4E7] rounded-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316]/10 @error('name') border-red-500 @enderror">

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-[#18181B] mb-2">
                        Email address
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        class="w-full px-4 py-3 bg-white border border-[#E4E4E7] rounded-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316]/10 @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="block text-sm font-semibold text-[#18181B] mb-2">
                        Phone number
                        <span class="font-normal text-[#71717A]">(M-Pesa)</span>
                    </label>

                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-[#FAFAFA] border border-r-0 border-[#E4E4E7] rounded-l-xl text-sm font-semibold text-[#52525B]">
                            +254
                        </span>

                        <input
                            id="phone"
                            name="phone"
                            type="tel"
                            autocomplete="tel-national"
                            required
                            value="{{ old('phone') }}"
                            placeholder="712 345 678"
                            class="min-w-0 flex-1 px-4 py-3 bg-white border border-[#E4E4E7] rounded-r-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316]/10 @error('phone') border-red-500 @enderror">
                    </div>

                    @error('phone')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="mt-1.5 text-xs text-[#A1A1AA]">
                        Enter your number without the country code.
                    </p>
                </div>

                {{-- Passwords --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-data="{ showPassword: false, showConfirmation: false }">

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-[#18181B] mb-2">
                            Password
                        </label>

                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Create password"
                                class="w-full px-4 pr-11 py-3 bg-white border border-[#E4E4E7] rounded-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316]/10 @error('password') border-red-500 @enderror">

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                                class="absolute inset-y-0 right-0 px-3 text-[#A1A1AA] hover:text-[#18181B]">

                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                    <circle cx="12" cy="12" r="3" stroke-width="1.6"/>
                                </svg>

                                <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 5.3A10 10 0 0112 5c4.5 0 8.3 3 9.5 7a10 10 0 01-3 4.3M6.2 6.2A10.2 10.2 0 002.5 12c1.3 4 5 7 9.5 7 1 0 2-.2 2.9-.5"/>
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-[#18181B] mb-2">
                            Confirm password
                        </label>

                        <div class="relative">
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                :type="showConfirmation ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Confirm password"
                                class="w-full px-4 pr-11 py-3 bg-white border border-[#E4E4E7] rounded-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316]/10">

                            <button
                                type="button"
                                @click="showConfirmation = !showConfirmation"
                                :aria-label="showConfirmation ? 'Hide confirmation password' : 'Show confirmation password'"
                                class="absolute inset-y-0 right-0 px-3 text-[#A1A1AA] hover:text-[#18181B]">

                                <svg x-show="!showConfirmation" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                    <circle cx="12" cy="12" r="3" stroke-width="1.6"/>
                                </svg>

                                <svg x-show="showConfirmation" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 5.3A10 10 0 0112 5c4.5 0 8.3 3 9.5 7a10 10 0 01-3 4.3M6.2 6.2A10.2 10.2 0 002.5 12c1.3 4 5 7 9.5 7 1 0 2-.2 2.9-.5"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="pt-1">
                    <div class="flex items-start gap-3">
                        <input
                            id="terms"
                            name="terms"
                            type="checkbox"
                            required
                            value="1"
                            {{ old('terms') ? 'checked' : '' }}
                            class="mt-0.5 w-4 h-4 shrink-0 rounded border-[#D4D4D8] text-[#F97316] focus:ring-[#F97316]">

                        <label for="terms" class="text-xs text-[#71717A] leading-relaxed">
                            I agree to the
                            <a href="{{ route('legal.terms') }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#EA580C] hover:underline">
                                Terms of Service
                            </a>
                            and
                            <a href="{{ route('legal.privacy') }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#EA580C] hover:underline">
                                Privacy Policy
                            </a>.
                            I consent to the processing of my personal data in accordance with applicable Kenyan data protection laws.
                        </label>
                    </div>

                    @error('terms')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl bg-[#F97316] hover:bg-[#EA580C] text-white text-sm font-bold shadow-sm transition-all duration-200 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#F97316]/30 focus:ring-offset-2">

                    Create account

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-6-6l6 6-6 6"/>
                    </svg>
                </button>

            </form>

            {{-- Sign In --}}
            <div class="mt-7 pt-6 border-t border-[#E4E4E7] text-center">
                <p class="text-sm text-[#71717A]">
                    Already have an account?
                    <a href="{{ route('login') }}" class="ml-1 font-bold text-[#EA580C] hover:text-[#F97316] transition-colors">
                        Sign in
                    </a>
                </p>
            </div>

        </div>

        {{-- Footer --}}
        <p class="mt-6 text-center text-xs text-[#A1A1AA]">
            Secure registration · {{ config('app.name') }}
        </p>

    </div>
</div>
@endsection
