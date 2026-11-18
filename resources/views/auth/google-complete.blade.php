
@extends('layouts.app')

@section('content')

<div class="min-h-[85vh] flex flex-col justify-center items-center px-4 sm:px-6 py-12">

    <div class="w-full max-w-[480px] space-y-8 bg-white p-8 sm:p-10 rounded-2xl border border-[#E4E4E7] shadow-xl shadow-black/5">

        {{-- Header --}}
        <div class="text-center space-y-2">
            <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 border border-orange-100">
                <svg class="h-7 w-7 text-[#F97316]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                    <path d="m17 11 2 2 4-4"/>
                </svg>
            </div>

            <h2 class="text-3xl font-extrabold tracking-tight text-[#18181B]">
                Complete your account
            </h2>

            <p class="text-sm text-[#71717A]">
                Just a few more details to get started with {{ config('app.name') }}.
            </p>
        </div>

        {{-- Google Account Details --}}
        <div class="flex items-center gap-3 p-4 rounded-xl bg-[#FAFAFA] border border-[#E4E4E7]">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white border border-[#E4E4E7]">
                <svg class="h-5 w-5" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.02 13.22l7.98 6.19C11.91 13.72 17.48 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.73 7.18l7.73 6C44.45 37.94 46.98 31.7 46.98 24.55z"/>
                    <path fill="#FBBC05" d="M10.53 28.59A14.4 14.4 0 0 1 9.75 24c0-1.59.27-3.13.76-4.59l-8.49-6.6A23.9 23.9 0 0 0 0 24c0 3.87.93 7.55 2.58 10.79l7.95-6.2z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.91-5.8l-7.73-6c-2.15 1.45-4.92 2.3-8.18 2.3-6.52 0-12.09-4.22-14.08-10.09l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                </svg>
            </div>

            <div class="min-w-0">
                <p class="text-sm font-semibold text-[#18181B] truncate">
                    {{ $googleData['name'] }}
                </p>

                <p class="text-xs text-[#71717A] mt-0.5 truncate">
                    {{ $googleData['email'] }}
                </p>
            </div>

            <span class="ml-auto shrink-0 text-[10px] font-semibold uppercase tracking-wide text-green-700 bg-green-50 border border-green-100 px-2 py-1 rounded-full">
                Verified
            </span>
        </div>

        {{-- Registration Form --}}
        <form action="{{ route('google.complete.store') }}"
              method="POST"
              class="space-y-5">

            @csrf

            {{-- Phone Number --}}
            <div class="space-y-2">
                <label for="phone" class="block text-sm font-semibold text-[#18181B]">
                    Phone number
                </label>

                <p class="text-xs text-[#71717A]">
                    Enter your Kenyan mobile number for account and payment updates.
                </p>

                <div class="flex">
                    <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-[#E4E4E7] bg-[#FAFAFA] text-sm font-semibold text-[#18181B]">
                        +254
                    </span>

                    <input
                        id="phone"
                        name="phone"
                        type="tel"
                        required
                        value="{{ old('phone') }}"
                        placeholder="712345678"
                        autocomplete="tel-national"
                        class="block w-full px-4 py-3 bg-white border border-[#E4E4E7] rounded-r-xl text-sm text-[#18181B] placeholder:text-[#A1A1AA] focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 outline-none transition">
                </div>

                @error('phone')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Terms & Privacy Consent --}}
            <div class="pt-2">
                <div class="flex items-start gap-3">
                    <input
                        id="google_terms"
                        name="terms"
                        type="checkbox"
                        required
                        value="1"
                        {{ old('terms') ? 'checked' : '' }}
                        class="mt-0.5 h-4 w-4 shrink-0 rounded border-[#D4D4D8] text-[#F97316] focus:ring-[#F97316]">

                    <label for="google_terms" class="text-xs text-[#71717A] leading-relaxed">
                        I have read and agree to the
                        <a href="{{ route('legal.terms') }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#F97316] hover:text-[#EA580C] hover:underline">
                            Terms of Service
                        </a>
                        and
                        <a href="{{ route('legal.privacy') }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#F97316] hover:text-[#EA580C] hover:underline">
                            Privacy Policy
                        </a>.
                    </label>
                </div>

                @error('terms')
                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 py-3.5 px-4 text-sm font-semibold rounded-xl text-white bg-[#F97316] hover:bg-[#EA580C] focus:outline-none focus:ring-2 focus:ring-[#F97316] focus:ring-offset-2 transition duration-200">

                Complete registration

                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="m12 5 7 7-7 7"/>
                </svg>
            </button>

        </form>

        <p class="text-center text-xs text-[#A1A1AA]">
            Your account details are handled securely.
        </p>

    </div>

</div>

@endsection
