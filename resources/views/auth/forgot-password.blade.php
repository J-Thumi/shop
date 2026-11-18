
@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center px-4 sm:px-6 py-12 bg-[#FAFAFA]">

    <div class="w-full max-w-[480px]">

        {{-- Forgot Password Card --}}
        <div class="bg-white border border-[#E4E4E7] rounded-2xl shadow-sm p-6 sm:p-9">

            {{-- Header --}}
            <div class="text-center mb-8">

                <div class="mx-auto mb-5 flex items-center justify-center w-12 h-12 rounded-2xl bg-orange-50 text-[#F97316]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#18181B]">
                    Forgot your password?
                </h1>

                <p class="mt-3 text-sm text-[#71717A] leading-relaxed">
                    No worries. Enter the email address associated with your
                    <span class="font-semibold text-[#18181B]">{{ config('app.name') }}</span>
                    account and we'll send you a link to reset your password.
                </p>
            </div>

            {{-- Success Message --}}
            @if(session('status'))
                <div class="flex items-start gap-3 p-4 mb-6 text-sm text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            {{-- Error Message --}}
            @if($errors->any())
                <div class="flex items-start gap-3 p-4 mb-6 text-sm text-red-700 bg-red-50 border border-red-200 rounded-xl">
                    <svg class="w-5 h-5 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Reset Link Form --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-[#18181B] mb-2">
                        Email address
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="you@example.com"
                        class="w-full px-4 py-3 bg-white border border-[#E4E4E7] rounded-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316]/10 @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl bg-[#F97316] hover:bg-[#EA580C] text-white text-sm font-bold shadow-sm transition-all duration-200 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#F97316]/30 focus:ring-offset-2">

                    Send password reset link

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-6-6l6 6-6 6"/>
                    </svg>
                </button>

            </form>

            {{-- Back to Login --}}
            <div class="mt-7 pt-6 border-t border-[#E4E4E7] text-center">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-[#EA580C] hover:text-[#F97316] transition-colors">

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m7 7l-7-7 7-7"/>
                    </svg>

                    Back to sign in
                </a>
            </div>

        </div>

        {{-- Footer --}}
        <p class="mt-6 text-center text-xs text-[#A1A1AA]">
            Secure account recovery · {{ config('app.name') }}
        </p>

    </div>
</div>
@endsection
