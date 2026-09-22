<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- =========================================================
        SEO
    ========================================================== --}}
    <title>@yield('meta_title', config('app.name', 'JosTech') . ' | Security, Networking & Technical Equipment in Kenya')</title>

    <meta
        name="description"
        content="@yield('meta_description', 'Browse security, CCTV, access control, electric fencing, networking, fire safety and technical equipment from JosTech Kenya.')"
    >

    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    {{-- =========================================================
        Open Graph
    ========================================================== --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name', 'JosTech') }}">
    <meta property="og:title" content="@yield('meta_title', config('app.name', 'JosTech'))">
    <meta
        property="og:description"
        content="@yield('meta_description', 'Security, networking and technical equipment in Kenya.')"
    >
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- =========================================================
        Twitter
    ========================================================== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', config('app.name', 'JosTech'))">
    <meta
        name="twitter:description"
        content="@yield('meta_description', 'Security, networking and technical equipment in Kenya.')"
    >
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- =========================================================
        Favicon
    ========================================================== --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    {{-- =========================================================
        Fonts
    ========================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- =========================================================
        Tailwind
    ========================================================== --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },

                    colors: {
                        brand: {
                            50: '#FFF7ED',
                            100: '#FFEDD5',
                            200: '#FED7AA',
                            300: '#FDBA74',
                            400: '#FB923C',
                            500: '#F97316',
                            600: '#EA580C',
                            700: '#C2410C',
                            800: '#9A3412',
                            900: '#7C2D12',
                        },

                        ink: '#18181B',
                        muted: '#71717A',
                        line: '#E4E4E7',
                    },

                    boxShadow: {
                        'soft': '0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.04)',
                        'card': '0 1px 2px rgba(0,0,0,.04), 0 4px 12px rgba(0,0,0,.04)',
                    },
                },
            },
        }
    </script>

    @stack('head')
</head>

<body class="min-h-full bg-slate-50 text-zinc-900 antialiased font-sans flex flex-col">

{{-- =============================================================
    TOP INFORMATION BAR
============================================================= --}}
<div class="bg-zinc-950 text-zinc-300 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-9 flex items-center justify-between gap-4">

            <p class="hidden sm:block">
                Security, networking & technical equipment in Kenya
            </p>

            <div class="flex items-center gap-4 ml-auto">
                <a
                    href="#"
                    class="hover:text-white transition-colors"
                >
                    Need help?
                </a>

                <span class="text-zinc-700">|</span>

                <a
                    href="https://wa.me/{{ config('services.whatsapp.number') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 text-zinc-200 hover:text-brand-400 transition-colors"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M20.52 3.48A11.87 11.87 0 0 0 12.04 0C5.49 0 .16 5.33.16 11.88c0 2.09.55 4.13 1.6 5.93L.05 24l6.34-1.66a11.88 11.88 0 0 0 5.65 1.43h.01c6.55 0 11.88-5.33 11.88-11.88 0-3.18-1.24-6.17-3.41-8.41ZM12.05 21.7h-.01a9.82 9.82 0 0 1-5.01-1.37l-.36-.21-3.76.99 1-3.67-.23-.38a9.84 9.84 0 1 1 8.37 4.64Zm5.39-7.38c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15-.2.3-.78.98-.96 1.18-.18.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.47-.89-.79-1.49-1.76-1.67-2.06-.17-.3-.02-.46.13-.61.14-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.68-1.63-.93-2.23-.24-.58-.49-.5-.68-.51h-.58c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.21 5.08 4.5.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.78-.73 2.03-1.43.25-.7.25-1.3.17-1.43-.07-.12-.27-.2-.57-.35Z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>

        </div>
    </div>
</div>


{{-- =============================================================
    MAIN HEADER
============================================================= --}}
<header
    class="bg-white border-b border-zinc-200 sticky top-0 z-50"
    x-data="{ mobileOpen: false, searchOpen: false }"
>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Main header row --}}
        <div class="h-[72px] flex items-center gap-5">

            {{-- Logo --}}
            <a
                href="#"
                class="flex items-center gap-3 shrink-0 group"
                aria-label="JosTech Home"
            >

                <div class="w-10 h-10 rounded-xl bg-zinc-950 text-white flex items-center justify-center font-extrabold text-lg group-hover:bg-brand-600 transition-colors">
                    J
                </div>

                <div class="leading-none">
                    <div class="text-[19px] font-extrabold tracking-tight text-zinc-950">
                        Jos<span class="text-brand-600">Tech</span>
                    </div>

                    <div class="text-[9px] uppercase tracking-[0.18em] text-zinc-400 mt-1">
                        Technology & Equipment
                    </div>
                </div>

            </a>


            {{-- Desktop search --}}
            <div class="hidden md:block flex-1 max-w-2xl mx-auto">

                <form
                    action="{{ route('products.index') }}"
                    method="GET"
                    role="search"
                    class="relative"
                >

                    <label for="header-search" class="sr-only">
                        Search products
                    </label>

                    <input
                        id="header-search"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search CCTV, access control, networking equipment..."
                        autocomplete="off"
                        class="w-full h-11 pl-11 pr-24 rounded-lg border border-zinc-300 bg-zinc-50 text-sm text-zinc-900 placeholder-zinc-500 outline-none transition focus:bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10"
                    >

                    <svg
                        class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-400 pointer-events-none"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                        />
                    </svg>

                    <button
                        type="submit"
                        class="absolute right-1.5 top-1.5 h-8 px-4 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-xs font-semibold transition-colors"
                    >
                        Search
                    </button>

                </form>

            </div>


            {{-- Desktop actions --}}
            <div class="hidden lg:flex items-center gap-3 shrink-0">

                <a
                    href="{{ route('products.index') }}"
                    class="px-3 py-2 text-sm font-semibold text-zinc-700 hover:text-brand-600 transition-colors"
                >
                    Products
                </a>

                <a
                    href="#"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-sm font-semibold transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M21 11.5a8.38 8.38 0 0 1-9 8.5 8.8 8.8 0 0 1-4.1-1l-4.4 1.4 1.4-4.2A8.2 8.2 0 0 1 3 11.5C3 6.8 7 3 12 3s9 3.8 9 8.5Z"
                        />
                    </svg>
                    Get a Quote
                </a>

            </div>


            {{-- Mobile controls --}}
            <div class="ml-auto flex items-center gap-2 lg:hidden">

                <button
                    type="button"
                    @click="searchOpen = !searchOpen"
                    class="w-10 h-10 inline-flex items-center justify-center rounded-lg text-zinc-600 hover:bg-zinc-100"
                    aria-label="Toggle search"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                        />
                    </svg>
                </button>

                <button
                    type="button"
                    @click="mobileOpen = !mobileOpen"
                    class="w-10 h-10 inline-flex items-center justify-center rounded-lg text-zinc-600 hover:bg-zinc-100"
                    aria-label="Toggle navigation"
                >
                    <svg
                        x-show="!mobileOpen"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        x-show="mobileOpen"
                        x-cloak
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 6l12 12M18 6 6 18"
                        />
                    </svg>
                </button>

            </div>

        </div>


        {{-- Mobile search --}}
        <div
            x-show="searchOpen"
            x-cloak
            x-transition
            class="pb-4 md:hidden"
        >
            <form action="{{ route('products.index') }}" method="GET">

                <div class="relative">

                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="w-full h-11 pl-10 pr-4 border border-zinc-300 rounded-lg bg-zinc-50 text-sm focus:bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 outline-none"
                    >

                    <svg
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                        />
                    </svg>

                </div>

            </form>
        </div>


        {{-- Mobile navigation --}}
        <div
            x-show="mobileOpen"
            x-cloak
            x-transition
            class="lg:hidden border-t border-zinc-100 py-4"
        >

            <nav class="space-y-1">

                <a
                    href="#"
                    class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-brand-50 hover:text-brand-700"
                >
                    Home
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-brand-50 hover:text-brand-700"
                >
                    All Products
                </a>

                <a
                    href="#"
                    class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-brand-50 hover:text-brand-700"
                >
                    About JosTech
                </a>

                <a
                    href="#"
                    class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-brand-50 hover:text-brand-700"
                >
                    Contact
                </a>

                <a
                    href="https://wa.me/{{ config('services.whatsapp.number') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-3 flex items-center justify-center gap-2 px-4 py-3 bg-brand-600 text-white rounded-lg text-sm font-bold"
                >
                    WhatsApp JosTech
                </a>

            </nav>

        </div>

    </div>


    {{-- =========================================================
        CATEGORY NAVIGATION
    ========================================================== --}}
    @if(isset($categories) && $categories->isNotEmpty())

        <div class="hidden lg:block border-t border-zinc-100 bg-white">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <nav
                    class="h-11 flex items-center gap-7 overflow-x-auto scrollbar-hide"
                    aria-label="Product categories"
                >

                    <a
                        href="{{ route('products.index') }}"
                        class="shrink-0 text-xs font-semibold transition-colors
                        {{ !request('category')
                            ? 'text-brand-600'
                            : 'text-zinc-600 hover:text-brand-600' }}"
                    >
                        All Products
                    </a>

                    @foreach($categories as $category)

                        @php
                            $categoryName = is_string($category)
                                ? $category
                                : ($category->name ?? $category->title ?? '');
                        @endphp

                        @if($categoryName)

                            <a
                                href="#}"
                                class="shrink-0 text-xs font-medium text-zinc-600 hover:text-brand-600 transition-colors"
                            >
                                {{ $categoryName }}
                            </a>

                        @endif

                    @endforeach

                </nav>

            </div>

        </div>

    @endif

</header>


{{-- =============================================================
    MAIN
============================================================= --}}
<main class="flex-1">

    @yield('content')

</main>


{{-- =============================================================
    FOOTER
============================================================= --}}
<footer class="bg-zinc-950 text-zinc-300 mt-20">

    {{-- Main footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-16">

            {{-- Brand --}}
            <div class="lg:col-span-1">

                <a
                    href="#"
                    class="inline-flex items-center gap-3 mb-5"
                >

                    <div class="w-10 h-10 rounded-xl bg-white text-zinc-950 flex items-center justify-center font-extrabold text-lg">
                        J
                    </div>

                    <div>
                        <div class="text-lg font-extrabold text-white">
                            Jos<span class="text-brand-500">Tech</span>
                        </div>

                        <div class="text-[9px] uppercase tracking-[0.16em] text-zinc-500">
                            Technology & Equipment
                        </div>
                    </div>

                </a>

                <p class="text-sm leading-6 text-zinc-400 max-w-sm">
                    Browse security, networking, access control, electrical
                    and professional technical equipment available in Kenya.
                </p>

                <a
                    href="https://wa.me/{{ config('services.whatsapp.number') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-white hover:text-brand-400 transition-colors"
                >
                    Talk to JosTech
                    <span aria-hidden="true">→</span>
                </a>

            </div>


            {{-- Products --}}
            <div>

                <h2 class="text-sm font-bold text-white mb-5">
                    Products
                </h2>

                <ul class="space-y-3 text-sm">

                    <li>
                        <a
                            href="{{ route('products.index') }}"
                            class="hover:text-brand-400 transition-colors"
                        >
                            All Products
                        </a>
                    </li>

                    @if(isset($categories))

                        @foreach($categories->take(6) as $category)

                            @php
                                $categoryName = is_string($category)
                                    ? $category
                                    : ($category->name ?? $category->title ?? '');
                            @endphp

                            @if($categoryName)

                                <li>
                                    <a
                                        href="#"
                                        class="hover:text-brand-400 transition-colors"
                                    >
                                        {{ $categoryName }}
                                    </a>
                                </li>

                            @endif

                        @endforeach

                    @endif

                </ul>

            </div>


            {{-- Company --}}
            <div>

                <h2 class="text-sm font-bold text-white mb-5">
                    Company
                </h2>

                <ul class="space-y-3 text-sm">

                    <li>
                        <a
                            href="#"
                            class="hover:text-brand-400 transition-colors"
                        >
                            About JosTech
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-brand-400 transition-colors"
                        >
                            Contact
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('products.index') }}"
                            class="hover:text-brand-400 transition-colors"
                        >
                            Product Catalogue
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-brand-400 transition-colors"
                        >
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-brand-400 transition-colors"
                        >
                            Terms & Conditions
                        </a>
                    </li>

                </ul>

            </div>


            {{-- Contact --}}
            <div>

                <h2 class="text-sm font-bold text-white mb-5">
                    Get in touch
                </h2>

                <div class="space-y-4 text-sm">

                    <div>
                        <div class="text-xs uppercase tracking-wider text-zinc-600 mb-1">
                            WhatsApp
                        </div>

                        <a
                            href="https://wa.me/{{ config('services.whatsapp.number') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-zinc-200 hover:text-brand-400 transition-colors"
                        >
                            Chat with JosTech
                        </a>
                    </div>

                    @if(config('mail.from.address'))

                        <div>
                            <div class="text-xs uppercase tracking-wider text-zinc-600 mb-1">
                                Email
                            </div>

                            <a
                                href="mailto:{{ config('mail.from.address') }}"
                                class="text-zinc-200 hover:text-brand-400 transition-colors break-all"
                            >
                                {{ config('mail.from.address') }}
                            </a>
                        </div>

                    @endif

                    <div>
                        <div class="text-xs uppercase tracking-wider text-zinc-600 mb-1">
                            Location
                        </div>

                        <span class="text-zinc-400">
                            Kenya
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Bottom footer --}}
    <div class="border-t border-zinc-800">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="min-h-16 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-zinc-500">

                <p>
                    © {{ date('Y') }} JosTech. All rights reserved.
                </p>

                <p>
                    Security, networking & technical equipment in Kenya.
                </p>

            </div>

        </div>

    </div>

</footer>


{{-- =============================================================
    ALPINE.JS
============================================================= --}}
<script
    defer
    src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
></script>

<style>
    [x-cloak] {
        display: none !important;
    }

    .scrollbar-hide {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

@stack('scripts')

</body>
</html>