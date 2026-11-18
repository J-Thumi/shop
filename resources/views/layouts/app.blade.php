<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('meta_title', config('app.name', 'JosTech') . ' | Security, Networking & Technical Equipment in Kenya')</title>

    <meta name="description" content="@yield('meta_description', 'Browse security, CCTV, access control, electric fencing, networking, fire safety and technical equipment from ' . config('app.name') . ' Kenya.')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name', 'JosTech') }}">
    <meta property="og:title" content="@yield('meta_title', config('app.name', 'JosTech'))">
    <meta property="og:description" content="@yield('meta_description', 'Security, networking and technical equipment in Kenya.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', config('app.name', 'JosTech'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Security, networking and technical equipment in Kenya.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
                        soft: '0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.04)',
                        card: '0 1px 2px rgba(0,0,0,.04), 0 4px 12px rgba(0,0,0,.04)',
                    },
                },
            },
        }
    </script>

    @stack('head')
</head>

<body class="min-h-full bg-slate-50 text-zinc-900 antialiased font-sans flex flex-col">

@php
    $whatsapp = config('services.whatsapp.number');

    /*
    |--------------------------------------------------------------------------
    | Cart count
    |--------------------------------------------------------------------------
    | This assumes the authenticated user's cart has an items relationship
    | and each cart item has a quantity column.
    */
    $cartCount = 0;

    if (auth()->check()) {
        $cartCount = auth()->user()
            ->cart()
            ->with('items')
            ->first()?->items
            ->sum('quantity') ?? 0;
    }

    $isHome = request()->routeIs('home') || request()->is('/');
    $isProducts = request()->routeIs('products.*');
    $isCart = request()->routeIs('cart.*');
    $isOrders = request()->routeIs('orders.*');
@endphp

{{-- TOP INFORMATION BAR --}}
<div class="bg-zinc-950 text-zinc-300 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-9 flex items-center justify-between gap-4">
            <p class="hidden sm:block">
                Security, networking & technical equipment in Kenya
            </p>

            <div class="flex items-center gap-4 ml-auto">
                <a href="{{ url('/contact') }}" class="hover:text-white transition">
                    Customer Support
                </a>

                <span class="text-zinc-700">|</span>

                <a href="https://wa.me/{{ $whatsapp }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="text-zinc-200 hover:text-brand-400 transition">
                    WhatsApp Us
                </a>
            </div>
        </div>
    </div>
</div>

{{-- MAIN HEADER --}}
<header
    class="bg-white border-b border-zinc-200 sticky top-0 z-50"
    x-data="{ mobileOpen: false, searchOpen: false, accountOpen: false }"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- PRIMARY HEADER --}}
        <div class="min-h-[76px] flex items-center gap-5">

            {{-- LOGO --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0">
                <div class="w-10 h-10 rounded-xl bg-zinc-950 text-white flex items-center justify-center font-extrabold text-lg">
                    J
                </div>

                <div class="leading-none">
                    <div class="text-xl font-extrabold tracking-tight text-zinc-950">
                        {{ config('app.name', 'JosTech') }}
                    </div>
                    <div class="text-[9px] uppercase tracking-[0.18em] text-zinc-400 mt-1">
                        Technology & Equipment
                    </div>
                </div>
            </a>

            {{-- DESKTOP SEARCH --}}
            <div class="hidden md:block flex-1 max-w-xl mx-auto">
                <form action="{{ route('products.index') }}" method="GET" role="search" class="relative">
                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products, brands and equipment..."
                        autocomplete="off"
                        class="w-full h-11 pl-11 pr-24 rounded-lg border border-zinc-200 bg-zinc-50 text-sm outline-none transition focus:bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10"
                    >

                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-400"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8"/>
                        <path d="m16 16 4 4" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>

                    <button type="submit"
                            class="absolute right-1.5 top-1.5 h-8 px-4 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-xs font-semibold transition">
                        Search
                    </button>
                </form>
            </div>

            {{-- DESKTOP ACTIONS --}}
            <div class="hidden lg:flex items-center gap-3 shrink-0">

                {{-- Products --}}
                <a href="{{ route('products.index') }}"
                   class="text-sm font-semibold transition {{ $isProducts ? 'text-brand-600' : 'text-zinc-700 hover:text-brand-600' }}">
                    Products
                </a>

                {{-- Cart --}}
                <a href="{{ route('cart.index') }}"
                   class="relative inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold transition {{ $isCart ? 'text-brand-600 bg-brand-50' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h2l2.4 12.4a2 2 0 0 0 2 1.6h8.7a2 2 0 0 0 2-1.6L22 7H6"
                              stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="10" cy="21" r="1"/>
                        <circle cx="19" cy="21" r="1"/>
                    </svg>
                    Cart

                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 min-w-5 h-5 px-1 rounded-full bg-brand-600 text-white text-[10px] flex items-center justify-center font-bold">
                            {{ $cartCount > 99 ? '99+' : $cartCount }}
                        </span>
                    @endif
                </a>

                @guest
                    <a href="{{ route('login') }}"
                       class="px-3 py-2 text-sm font-semibold text-zinc-700 hover:text-brand-600 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2.5 rounded-lg border border-zinc-200 text-sm font-semibold text-zinc-800 hover:bg-zinc-50 transition">
                        Create Account
                    </a>
                @else

                    {{-- MY ORDERS --}}
                    <a href="{{ route('orders.index') }}"
                       class="text-sm font-semibold transition {{ $isOrders ? 'text-brand-600' : 'text-zinc-700 hover:text-brand-600' }}">
                        My Orders
                    </a>

                    {{-- ACCOUNT MENU --}}
                    <div class="relative" @click.outside="accountOpen = false">
                        <button
                            type="button"
                            @click="accountOpen = !accountOpen"
                            :aria-expanded="accountOpen"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-zinc-50 transition"
                        >
                            <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <span class="text-sm font-semibold text-zinc-800 max-w-28 truncate">
                                {{ auth()->user()->name }}
                            </span>

                            <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="m6 9 6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div x-show="accountOpen" x-cloak x-transition
                             class="absolute right-0 mt-2 w-60 bg-white border border-zinc-200 rounded-xl shadow-soft p-2">

                            <div class="px-3 py-3 border-b border-zinc-100">
                                <p class="text-xs text-zinc-400">Signed in as</p>
                                <p class="text-sm font-semibold text-zinc-900 truncate">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-zinc-500 truncate">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>

                            <a href="{{ route('orders.index') }}"
                               class="block px-3 py-2.5 mt-1 rounded-lg text-sm text-zinc-700 hover:bg-zinc-50">
                                My orders
                            </a>

                            <a href="{{ route('cart.index') }}"
                               class="block px-3 py-2.5 rounded-lg text-sm text-zinc-700 hover:bg-zinc-50">
                                Shopping cart
                            </a>

                            <a href="{{ url('/contact') }}"
                               class="block px-3 py-2.5 rounded-lg text-sm text-zinc-700 hover:bg-zinc-50">
                                Help & support
                            </a>

                            <div class="border-t border-zinc-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

                {{-- QUOTE CTA --}}
                <a href="https://wa.me/{{ $whatsapp }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-sm font-semibold transition shadow-sm">
                    Get a Quote
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M7 17 17 7M7 7h10v10" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            {{-- MOBILE ACTIONS --}}
            <div class="ml-auto flex items-center gap-1 lg:hidden">

                {{-- Mobile cart --}}
                <a href="{{ route('cart.index') }}"
                   aria-label="Shopping cart"
                   class="relative w-10 h-10 flex items-center justify-center rounded-lg text-zinc-700 hover:bg-zinc-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h2l2.4 12.4a2 2 0 0 0 2 1.6h8.7a2 2 0 0 0 2-1.6L22 7H6"
                              stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="10" cy="21" r="1"/>
                        <circle cx="19" cy="21" r="1"/>
                    </svg>

                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 min-w-4 h-4 px-1 rounded-full bg-brand-600 text-white text-[9px] flex items-center justify-center font-bold">
                            {{ $cartCount > 99 ? '99+' : $cartCount }}
                        </span>
                    @endif
                </a>

                <button type="button"
                        @click="searchOpen = !searchOpen"
                        aria-label="Toggle search"
                        :aria-expanded="searchOpen"
                        class="w-10 h-10 flex items-center justify-center rounded-lg text-zinc-600 hover:bg-zinc-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8"/>
                        <path d="m16 16 4 4" stroke-width="1.8"/>
                    </svg>
                </button>

                <button type="button"
                        @click="mobileOpen = !mobileOpen"
                        aria-label="Toggle navigation"
                        :aria-expanded="mobileOpen"
                        class="w-10 h-10 flex items-center justify-center rounded-lg text-zinc-600 hover:bg-zinc-100">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>

                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="m6 6 12 12M18 6 6 18" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- MOBILE SEARCH --}}
        <div x-show="searchOpen" x-cloak x-transition class="pb-4 md:hidden">
            <form action="{{ route('products.index') }}" method="GET" role="search">
                <div class="relative">
                    <input type="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search products..."
                           class="w-full h-11 pl-4 pr-16 rounded-lg border border-zinc-200 bg-zinc-50 text-sm focus:bg-white focus:border-brand-500 outline-none">

                    <button type="submit"
                            class="absolute right-1 top-1 h-9 px-3 bg-brand-600 text-white rounded-md text-xs font-semibold">
                        Search
                    </button>
                </div>
            </form>
        </div>

        {{-- MOBILE NAVIGATION --}}
        <div x-show="mobileOpen" x-cloak x-transition class="lg:hidden border-t border-zinc-100 py-4">
            <nav class="space-y-1">

                <a href="{{ url('/') }}"
                   class="block px-3 py-3 rounded-lg text-sm font-semibold {{ $isHome ? 'bg-brand-50 text-brand-700' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    Home
                </a>

                <a href="{{ route('products.index') }}"
                   class="block px-3 py-3 rounded-lg text-sm font-semibold {{ $isProducts ? 'bg-brand-50 text-brand-700' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    All Products
                </a>

                <a href="{{ route('cart.index') }}"
                   class="flex items-center justify-between px-3 py-3 rounded-lg text-sm font-semibold {{ $isCart ? 'bg-brand-50 text-brand-700' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    <span>Shopping Cart</span>
                    @if($cartCount > 0)
                        <span class="rounded-full bg-brand-100 text-brand-700 px-2 py-1 text-xs">
                            {{ $cartCount }} items
                        </span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('orders.index') }}"
                       class="block px-3 py-3 rounded-lg text-sm font-semibold {{ $isOrders ? 'bg-brand-50 text-brand-700' : 'text-zinc-700 hover:bg-zinc-50' }}">
                        My Orders & Tracking
                    </a>
                @endauth

                <a href="{{ url('/contact') }}"
                   class="block px-3 py-3 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                    Contact & Support
                </a>

                <a href="https://wa.me/{{ $whatsapp }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="block px-3 py-3 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                    WhatsApp Us
                </a>

                <div class="border-t border-zinc-100 my-3"></div>

                @guest
                    <a href="{{ route('login') }}"
                       class="block px-3 py-3 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                        Login to your account
                    </a>

                    <a href="{{ route('register') }}"
                       class="block px-3 py-3 rounded-lg text-sm font-semibold text-brand-700 hover:bg-brand-50">
                        Create an account
                    </a>
                @else
                    <div class="px-3 py-2">
                        <p class="text-xs text-zinc-400">Signed in as</p>
                        <p class="text-sm font-bold text-zinc-900">{{ auth()->user()->name }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-3 py-3 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50">
                            Sign out
                        </button>
                    </form>
                @endguest

                <a href="https://wa.me/{{ $whatsapp }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mt-3 flex items-center justify-center px-4 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-sm font-bold">
                    Request a Quote
                </a>
            </nav>
        </div>
    </div>

    {{-- PRODUCT CATEGORY NAVIGATION --}}
    @if(isset($categories) && $categories->isNotEmpty())
        <div class="hidden lg:block border-t border-zinc-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="h-11 flex items-center gap-7 overflow-x-auto scrollbar-hide"
                     aria-label="Product categories">

                    <a href="{{ route('products.index') }}"
                       class="shrink-0 text-xs font-semibold {{ !request('category') ? 'text-brand-600' : 'text-zinc-600 hover:text-brand-600' }}">
                        All Products
                    </a>

                    @foreach($categories as $category)
                        @php
                            $categoryName = is_string($category)
                                ? $category
                                : ($category->name ?? $category->title ?? '');

                            $categoryValue = is_string($category)
                                ? $category
                                : ($category->slug ?? $categoryName);
                        @endphp

                        @if($categoryName)
                            <a href="{{ route('products.index', ['category' => $categoryValue]) }}"
                               class="shrink-0 text-xs font-medium transition-colors {{ request('category') == $categoryValue ? 'text-brand-600' : 'text-zinc-600 hover:text-brand-600' }}">
                                {{ $categoryName }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    @endif
</header>

{{-- FLASH MESSAGES --}}
@if(session('success') || session('error'))
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4">
        @if(session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endif

{{-- MAIN CONTENT --}}
<main class="flex-1">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-zinc-950 text-zinc-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-16">

            {{-- BRAND --}}
            <div>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-5">
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
                    Browse security, networking, access control, electrical and professional technical equipment available in Kenya.
                </p>

                <a href="https://wa.me/{{ $whatsapp }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-white hover:text-brand-400 transition">
                    Talk to {{ config('app.name', 'JosTech') }}
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            {{-- SHOPPING --}}
            <div>
                <h2 class="text-sm font-bold text-white mb-5">Shopping</h2>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-brand-400 transition">
                            All Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="hover:text-brand-400 transition">
                            Shopping Cart
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('orders.index') }}" class="hover:text-brand-400 transition">
                                My Orders
                            </a>
                        </li>
                    @endauth
                    <li>
                        <a href="{{ url('/contact') }}" class="hover:text-brand-400 transition">
                            Request a Quote
                        </a>
                    </li>
                </ul>
            </div>

            {{-- CUSTOMER SERVICE --}}
            <div>
                <h2 class="text-sm font-bold text-white mb-5">Customer Service</h2>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url('/contact') }}" class="hover:text-brand-400 transition">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/{{ $whatsapp }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-brand-400 transition">
                            WhatsApp Support
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('legal.terms') }}" class="hover:text-brand-400 transition">
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('legal.privacy') }}" class="hover:text-brand-400 transition">
                            Privacy Policy
                        </a>
                    </li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div>
                <h2 class="text-sm font-bold text-white mb-5">Get in Touch</h2>

                <div class="space-y-4 text-sm">
                    @if(config('mail.from.address'))
                        <div>
                            <div class="text-xs uppercase tracking-wider text-zinc-600 mb-1">
                                Email
                            </div>
                            <a href="mailto:{{ config('mail.from.address') }}"
                               class="text-zinc-200 hover:text-brand-400 transition break-all">
                                {{ config('mail.from.address') }}
                            </a>
                        </div>
                    @endif

                    <div>
                        <div class="text-xs uppercase tracking-wider text-zinc-600 mb-1">
                            WhatsApp
                        </div>
                        <a href="https://wa.me/{{ $whatsapp }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-zinc-200 hover:text-brand-400 transition">
                            Chat with {{ config('app.name', 'JosTech') }}
                        </a>
                    </div>

                    <div>
                        <div class="text-xs uppercase tracking-wider text-zinc-600 mb-1">
                            Location
                        </div>
                        <span class="text-zinc-400">Kenya</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- FOOTER BOTTOM --}}
    <div class="border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="min-h-16 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-zinc-500">
                <p>
                    © {{ date('Y') }} {{ config('app.name', 'JosTech') }}. All rights reserved.
                </p>
                <p>
                    Security, networking & technical equipment in Kenya.
                </p>
            </div>
        </div>
    </div>
</footer>

{{-- ALPINE.JS --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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