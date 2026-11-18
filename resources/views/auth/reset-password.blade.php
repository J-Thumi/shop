
@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center px-4 sm:px-6 py-12 bg-[#FAFAFA]">

    <div class="w-full max-w-[480px] bg-white border border-[#E4E4E7] rounded-2xl shadow-xl shadow-black/5 p-8 sm:p-10">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-[#F97316] mb-5">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    <path d="M12 15v3"/>
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#18181B]">
                Create a new password
            </h1>

            <p class="text-sm text-[#71717A] mt-3 leading-6">
                Choose a strong password for your {{ config('app.name') }} account.
            </p>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm p-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-[#18181B]">
                    Email address
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $email) }}"
                    required
                    autocomplete="email"
                    class="w-full rounded-xl border border-[#E4E4E7] bg-white px-4 py-3 text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-orange-100"
                >
            </div>

            {{-- New Password --}}
            <div class="space-y-2">
                <label for="password" class="block text-sm font-semibold text-[#18181B]">
                    New password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your new password"
                    class="w-full rounded-xl border border-[#E4E4E7] bg-white px-4 py-3 text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-orange-100"
                >
            </div>

            {{-- Confirm Password --}}
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-semibold text-[#18181B]">
                    Confirm new password
                </label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Re-enter your new password"
                    class="w-full rounded-xl border border-[#E4E4E7] bg-white px-4 py-3 text-sm text-[#18181B] placeholder:text-[#A1A1AA] outline-none transition focus:border-[#F97316] focus:ring-2 focus:ring-orange-100"
                >
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full mt-2 rounded-xl bg-[#F97316] hover:bg-[#EA580C] text-white font-semibold text-sm py-3.5 transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#F97316] focus:ring-offset-2">
                Reset password
            </button>
        </form>

        <div class="border-t border-[#E4E4E7] mt-7 pt-5 text-center">
            <a href="{{ route('login') }}" class="text-sm font-medium text-[#71717A] hover:text-[#F97316] transition">
                Return to login
            </a>
        </div>

    </div>
</div>
@endsection
