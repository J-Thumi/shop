
@extends('layouts.app')

@section('title', 'Verify Your Email')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center px-4 sm:px-6 py-12 bg-[#FAFAFA]">

    <div class="w-full max-w-[480px] bg-white rounded-2xl border border-[#E4E4E7] shadow-xl shadow-black/5 p-8 sm:p-10">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-[#F97316] mb-5">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path d="m3 7 9 6 9-6"/>
                    <path d="m9 16 2 2 4-4"/>
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#18181B]">
                Verify your email
            </h1>

            <p class="text-sm text-[#71717A] mt-3 leading-6">
                We've sent a six-digit verification code to your email address. Enter it below to continue to your {{ config('app.name') }} account.
            </p>
        </div>

        {{-- Success Message --}}
        @if(session('status'))
            <div class="mb-5 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm p-4">
                {{ session('status') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm p-4">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Verification Form --}}
        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <div class="space-y-2">
                <label for="code" class="block text-sm font-semibold text-[#18181B]">
                    Verification code
                </label>

                <input
                    id="code"
                    name="code"
                    type="text"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    maxlength="6"
                    pattern="[0-9]{6}"
                    required
                    autofocus
                    placeholder="000000"
                    class="w-full text-center text-2xl tracking-[0.6em] font-bold rounded-xl border border-[#E4E4E7] bg-white text-[#18181B] px-4 py-4 focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 outline-none transition placeholder:text-[#D4D4D8]"
                >
            </div>

            <button
                type="submit"
                class="w-full mt-6 rounded-xl bg-[#F97316] hover:bg-[#EA580C] text-white font-semibold text-sm py-3.5 transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#F97316] focus:ring-offset-2">
                Verify and continue
            </button>
        </form>

        {{-- Resend Code --}}
        <div class="text-center mt-7">
            <p class="text-sm text-[#71717A] mb-3">
                Didn't receive your code?
            </p>

            <form method="POST" action="{{ route('otp.resend') }}">
                @csrf

                <button
                    type="submit"
                    class="text-sm font-semibold text-[#F97316] hover:text-[#EA580C] transition">
                    Resend verification code
                </button>
            </form>
        </div>

        {{-- Login Link --}}
        <div class="border-t border-[#E4E4E7] mt-7 pt-5 text-center">
            <a href="{{ route('login') }}" class="text-sm font-medium text-[#71717A] hover:text-[#18181B] transition">
                Return to login
            </a>
        </div>

    </div>
</div>
@endsection
