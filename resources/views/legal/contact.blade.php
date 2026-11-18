
@extends('layouts.app')

@section('title', 'Contact Us — ' . config('app.name'))

@section('content')
<div class="bg-[#FAFAFA] min-h-screen py-12 md:py-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="max-w-3xl mb-12">

            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-50 border border-orange-100 text-xs font-semibold text-[#EA580C] mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#F97316]"></span>
                Customer Support
            </div>

            <h1 class="font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight text-[#18181B] mb-5">
                We're here to help.
            </h1>

            <p class="text-sm sm:text-base text-[#71717A] leading-relaxed max-w-2xl">
                Have a question about a product, an order, delivery, or a payment? Get in touch with our team and we'll be happy to assist you.
            </p>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

            {{-- Left Column: Contact Form --}}
            <div class="lg:col-span-7 bg-white border border-[#E4E4E7] rounded-2xl p-6 sm:p-10 shadow-sm">

                <div class="mb-8">
                    <h2 class="font-bold text-xl text-[#18181B]">
                        Send us a message
                    </h2>

                    <p class="text-sm text-[#71717A] mt-2">
                        Fill in the details below and our team will get back to you.
                    </p>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                        <p class="font-semibold mb-2">Please review the following:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    {{-- Name and Email --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-[#18181B]">
                                Your name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                placeholder="Your full name"
                                class="w-full px-4 py-3 text-sm bg-white border border-[#E4E4E7] rounded-xl text-[#18181B] placeholder:text-[#A1A1AA] focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 transition">
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-[#18181B]">
                                Email address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="name@example.com"
                                class="w-full px-4 py-3 text-sm bg-white border border-[#E4E4E7] rounded-xl text-[#18181B] placeholder:text-[#A1A1AA] focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 transition">
                        </div>

                    </div>

                    {{-- Phone and Topic --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-semibold text-[#18181B]">
                                Phone number
                                <span class="text-[#A1A1AA] font-normal">(Optional)</span>
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                placeholder="+254 700 000000"
                                class="w-full px-4 py-3 text-sm bg-white border border-[#E4E4E7] rounded-xl text-[#18181B] placeholder:text-[#A1A1AA] focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 transition">
                        </div>

                        <div class="space-y-2">
                            <label for="topic" class="block text-sm font-semibold text-[#18181B]">
                                What can we help with?
                            </label>

                            <select
                                id="topic"
                                name="topic"
                                required
                                class="w-full px-4 py-3 text-sm bg-white border border-[#E4E4E7] rounded-xl text-[#18181B] focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 transition">

                                <option value="" disabled {{ old('topic') ? '' : 'selected' }}>
                                    Select a topic
                                </option>

                                <option value="products" {{ old('topic') === 'products' ? 'selected' : '' }}>
                                    Products & Availability
                                </option>

                                <option value="orders" {{ old('topic') === 'orders' ? 'selected' : '' }}>
                                    Orders & Purchases
                                </option>

                                <option value="delivery" {{ old('topic') === 'delivery' ? 'selected' : '' }}>
                                    Shipping & Delivery
                                </option>

                                <option value="payments" {{ old('topic') === 'payments' ? 'selected' : '' }}>
                                    Payments & Refunds
                                </option>

                                <option value="returns" {{ old('topic') === 'returns' ? 'selected' : '' }}>
                                    Returns & Exchanges
                                </option>

                                <option value="privacy" {{ old('topic') === 'privacy' ? 'selected' : '' }}>
                                    Privacy & Data Requests
                                </option>

                                <option value="other" {{ old('topic') === 'other' ? 'selected' : '' }}>
                                    General Inquiry
                                </option>

                            </select>
                        </div>

                    </div>

                    {{-- Message --}}
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-semibold text-[#18181B]">
                            Your message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            placeholder="Tell us how we can help..."
                            class="w-full px-4 py-3 text-sm bg-white border border-[#E4E4E7] rounded-xl text-[#18181B] placeholder:text-[#A1A1AA] focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-orange-100 transition resize-y">{{ old('message') }}</textarea>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 text-sm font-semibold text-white bg-[#F97316] hover:bg-[#EA580C] rounded-xl shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#F97316] focus:ring-offset-2">

                        Send message

                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 2 11 13"/>
                            <path d="m22 2-7 20-4-9-9-4Z"/>
                        </svg>

                    </button>

                </form>

            </div>

            {{-- Right Column: Contact Information --}}
            <div class="lg:col-span-5 space-y-6">

                {{-- Contact Information Card --}}
                <div class="bg-white border border-[#E4E4E7] rounded-2xl p-6 sm:p-8 shadow-sm">

                    <h2 class="font-bold text-lg text-[#18181B] mb-2">
                        Contact information
                    </h2>

                    <p class="text-sm text-[#71717A] leading-relaxed mb-7">
                        Prefer reaching out directly? Use one of the contact channels below.
                    </p>

                    <div class="space-y-6">

                        {{-- Support Email --}}
                        <div class="flex items-start gap-4">

                            <div class="w-11 h-11 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0 text-[#F97316]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="m3 7 9 6 9-6"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs text-[#71717A] font-medium mb-1">
                                    Customer Support
                                </p>

                                <a href="mailto:[SUPPORT EMAIL]" class="text-sm font-semibold text-[#18181B] hover:text-[#F97316] transition break-all">
                                    [SUPPORT EMAIL]
                                </a>
                            </div>

                        </div>

                        {{-- Privacy Email --}}
                        <div class="flex items-start gap-4">

                            <div class="w-11 h-11 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0 text-[#F97316]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs text-[#71717A] font-medium mb-1">
                                    Privacy & Data Requests
                                </p>

                                <a href="mailto:[PRIVACY CONTACT EMAIL]" class="text-sm font-semibold text-[#18181B] hover:text-[#F97316] transition break-all">
                                    [PRIVACY CONTACT EMAIL]
                                </a>
                            </div>

                        </div>

                        {{-- Website --}}
                        <div class="flex items-start gap-4">

                            <div class="w-11 h-11 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0 text-[#F97316]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M2 12h20"/>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10Z"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs text-[#71717A] font-medium mb-1">
                                    Website
                                </p>

                                <span class="text-sm font-semibold text-[#18181B]">
                                    {{ config('app.url') }}
                                </span>
                            </div>

                        </div>

                        {{-- Business Address --}}
                        <div class="flex items-start gap-4">

                            <div class="w-11 h-11 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0 text-[#F97316]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs text-[#71717A] font-medium mb-1">
                                    Business Address
                                </p>

                                <span class="text-sm font-semibold text-[#18181B]">
                                    [BUSINESS ADDRESS, IF APPLICABLE]
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- Legal Information Card --}}
                <div class="bg-[#18181B] rounded-2xl p-6 sm:p-8 text-white">

                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#F97316]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                            <path d="M12 8v4"/>
                            <path d="M12 16h.01"/>
                        </svg>

                        <h3 class="font-bold text-sm">
                            Legal information
                        </h3>
                    </div>

                    <p class="text-sm text-[#A1A1AA] leading-relaxed mb-6">
                        Learn about our terms of service, your rights as a customer, and how we handle your personal information.
                    </p>

                    <div class="grid grid-cols-2 gap-3">

                        <a href="{{ route('legal.terms') }}"
                           class="text-center py-3 px-3 text-xs font-semibold text-white bg-[#27272A] hover:bg-[#3F3F46] border border-[#3F3F46] rounded-xl transition">
                            Terms of Service
                        </a>

                        <a href="{{ route('legal.privacy') }}"
                           class="text-center py-3 px-3 text-xs font-semibold text-white bg-[#27272A] hover:bg-[#3F3F46] border border-[#3F3F46] rounded-xl transition">
                            Privacy Policy
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection
