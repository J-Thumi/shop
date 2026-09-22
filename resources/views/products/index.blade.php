@extends('layouts.app')

@section('meta_title', 'Products | Security, Networking & Technical Equipment | JosTech Kenya')

@section('meta_description', 'Browse JosTech Kenya products including CCTV cameras, access control, electric fencing, networking equipment, fire alarm systems, gate automation and more.')

@section('content')

@php
    $hasFilters = request()->filled('search')
        || request()->filled('category')
        || request()->filled('min_price')
        || request()->filled('max_price');

    $resultCount = $products->total();

    $sortOptions = [
        '' => 'Featured',
        'newest' => 'Newest',
        'price_low' => 'Price: Low to High',
        'price_high' => 'Price: High to Low',
        'name' => 'Name: A-Z',
    ];
@endphp

<div
    x-data="{ filtersOpen: false }"
    class="bg-slate-50"
>

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <section class="border-b border-zinc-200 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                class="flex items-center gap-2 text-xs text-zinc-500 mb-5"
            >
                <a
                    href="#"
                    class="hover:text-brand-600 transition-colors"
                >
                    Home
                </a>

                <svg
                    class="w-3.5 h-3.5 text-zinc-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="m9 18 6-6-6-6"
                    />
                </svg>

                <span class="text-zinc-900 font-medium">
                    Products
                </span>
            </nav>


            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600 mb-2">
                        Product Catalogue
                    </p>

                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-950">
                        Products
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm sm:text-base text-zinc-500 leading-6">
                        Browse security, networking, access control, electrical
                        and professional technical equipment available from JosTech.
                    </p>

                </div>


                {{-- Result count --}}
                <div class="text-sm text-zinc-500 lg:text-right shrink-0">

                    <span class="font-semibold text-zinc-900">
                        {{ number_format($resultCount) }}
                    </span>

                    {{ $resultCount === 1 ? 'product' : 'products' }}

                    @if(request('search'))
                        <span class="hidden sm:inline">
                            matching
                            <span class="font-semibold text-zinc-800">
                                "{{ request('search') }}"
                            </span>
                        </span>
                    @endif

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        SEARCH / QUICK CATEGORY BAR
    ========================================================== --}}
    <section class="bg-white border-b border-zinc-200">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

            <div class="flex flex-col lg:flex-row gap-3">

                {{-- Search --}}
                <form
                    action="{{ route('products.index') }}"
                    method="GET"
                    class="relative flex-1"
                >

                    {{-- Preserve filters --}}
                    @if(request('category'))
                        <input
                            type="hidden"
                            name="category"
                            value="{{ request('category') }}"
                        >
                    @endif

                    @if(request('min_price'))
                        <input
                            type="hidden"
                            name="min_price"
                            value="{{ request('min_price') }}"
                        >
                    @endif

                    @if(request('max_price'))
                        <input
                            type="hidden"
                            name="max_price"
                            value="{{ request('max_price') }}"
                        >
                    @endif

                    <label for="catalog-search" class="sr-only">
                        Search products
                    </label>

                    <input
                        id="catalog-search"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products, brands, models or equipment..."
                        class="w-full h-11 pl-11 pr-24 bg-zinc-50 border border-zinc-300 rounded-lg text-sm outline-none transition focus:bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10"
                    >

                    <svg
                        class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-400 pointer-events-none"
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

                    <button
                        type="submit"
                        class="absolute right-1.5 top-1.5 h-8 px-4 rounded-md bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold transition-colors"
                    >
                        Search
                    </button>

                </form>


                {{-- Mobile filters --}}
                <button
                    type="button"
                    @click="filtersOpen = true"
                    class="lg:hidden h-11 px-4 inline-flex items-center justify-center gap-2 border border-zinc-300 bg-white rounded-lg text-sm font-semibold text-zinc-700 hover:bg-zinc-50"
                >

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M4 6h16M7 12h10m-7 6h4"
                        />
                    </svg>

                    Filters

                    @if($hasFilters)
                        <span class="w-5 h-5 rounded-full bg-brand-600 text-white text-[10px] flex items-center justify-center">
                            !
                        </span>
                    @endif

                </button>


                {{-- Sort --}}
                <form
                    action="{{ route('products.index') }}"
                    method="GET"
                    class="shrink-0"
                >

                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    @if(request('min_price'))
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                    @endif

                    @if(request('max_price'))
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    @endif

                    <label for="sort" class="sr-only">
                        Sort products
                    </label>

                    <select
                        id="sort"
                        name="sort"
                        onchange="this.form.submit()"
                        class="h-11 w-full lg:w-48 px-3 border border-zinc-300 bg-white rounded-lg text-sm text-zinc-700 font-medium outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10"
                    >

                        @foreach($sortOptions as $value => $label)

                            <option
                                value="{{ $value }}"
                                @selected(request('sort') === $value)
                            >
                                {{ $label }}
                            </option>

                        @endforeach

                    </select>

                </form>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CATALOGUE
    ========================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-7 lg:py-9">

        <div class="lg:grid lg:grid-cols-[230px_minmax(0,1fr)] lg:gap-8">


            {{-- =====================================================
                DESKTOP FILTER SIDEBAR
            ====================================================== --}}
            <aside class="hidden lg:block">

                <div class="sticky top-28">

                    <div class="flex items-center justify-between mb-4">

                        <h2 class="text-sm font-bold text-zinc-950">
                            Filter Products
                        </h2>

                        @if($hasFilters)

                            <a
                                href="{{ route('products.index') }}"
                                class="text-xs font-semibold text-brand-600 hover:text-brand-700"
                            >
                                Clear all
                            </a>

                        @endif

                    </div>


                    <form
                        action="{{ route('products.index') }}"
                        method="GET"
                        class="bg-white border border-zinc-200 rounded-xl"
                    >

                        {{-- Preserve search --}}
                        @if(request('search'))
                            <input
                                type="hidden"
                                name="search"
                                value="{{ request('search') }}"
                            >
                        @endif


                        {{-- Categories --}}
                        <div class="p-5 border-b border-zinc-200">

                            <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-4">
                                Category
                            </h3>

                            <div class="space-y-2.5">

                                <label class="flex items-center gap-3 cursor-pointer group">

                                    <input
                                        type="radio"
                                        name="category"
                                        value=""
                                        @checked(!request('category'))
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm text-zinc-700 group-hover:text-brand-600">
                                        All products
                                    </span>

                                </label>


                                @if(isset($categories))

                                    @foreach($categories as $cat)

                                        <label class="flex items-start gap-3 cursor-pointer group">

                                            <input
                                                type="radio"
                                                name="category"
                                                value="{{ $cat->slug }}"
                                                @checked(request('category') === $cat->slug)
                                                class="w-4 h-4 mt-0.5 accent-brand-600"
                                            >

                                            <span class="flex-1 text-sm leading-5 text-zinc-600 group-hover:text-brand-600">
                                                {{ $cat->name }}
                                            </span>

                                            @if(isset($cat->products_count))
                                                <span class="text-[11px] text-zinc-400">
                                                    {{ $cat->products_count }}
                                                </span>
                                            @endif

                                        </label>

                                    @endforeach

                                @endif

                            </div>

                        </div>


                        {{-- Price --}}
                        <div class="p-5 border-b border-zinc-200">

                            <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-4">
                                Price range
                            </h3>

                            <div class="space-y-2">

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="price_range"
                                        value="0-5000"
                                        @checked(request('min_price') == '0' && request('max_price') == '5000')
                                        onchange="applyPriceRange(this)"
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm text-zinc-600">
                                        Under KSh 5,000
                                    </span>

                                </label>


                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="price_range"
                                        value="5000-10000"
                                        @checked(request('min_price') == '5000' && request('max_price') == '10000')
                                        onchange="applyPriceRange(this)"
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm text-zinc-600">
                                        KSh 5,000 – 10,000
                                    </span>

                                </label>


                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="price_range"
                                        value="10000-25000"
                                        @checked(request('min_price') == '10000' && request('max_price') == '25000')
                                        onchange="applyPriceRange(this)"
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm text-zinc-600">
                                        KSh 10,000 – 25,000
                                    </span>

                                </label>


                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="price_range"
                                        value="25000-50000"
                                        @checked(request('min_price') == '25000' && request('max_price') == '50000')
                                        onchange="applyPriceRange(this)"
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm text-zinc-600">
                                        KSh 25,000 – 50,000
                                    </span>

                                </label>


                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="price_range"
                                        value="50000-"
                                        @checked(request('min_price') == '50000' && !request('max_price'))
                                        onchange="applyPriceRange(this)"
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm text-zinc-600">
                                        Above KSh 50,000
                                    </span>

                                </label>

                            </div>

                        </div>


                        <div class="p-4">

                            <button
                                type="submit"
                                class="w-full h-10 bg-zinc-950 hover:bg-brand-600 text-white rounded-lg text-sm font-bold transition-colors"
                            >
                                Apply Filters
                            </button>

                        </div>

                    </form>


                    {{-- Need help block --}}
                    <div class="mt-5 p-5 bg-brand-50 border border-brand-100 rounded-xl">

                        <div class="w-9 h-9 rounded-lg bg-white border border-brand-100 flex items-center justify-center text-brand-600 mb-3">

                            <svg
                                class="w-4.5 h-4.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.8"
                                    d="M8.5 9a3.5 3.5 0 0 1 7 0c0 2.5-3.5 2.5-3.5 5m0 3.5v.01M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"
                                />
                            </svg>

                        </div>

                        <h3 class="text-sm font-bold text-zinc-900">
                            Not sure what you need?
                        </h3>

                        <p class="text-xs text-zinc-600 leading-5 mt-1">
                            Contact JosTech and get help finding the right equipment.
                        </p>

                        <a
                            href="#"
                            class="inline-flex mt-3 text-xs font-bold text-brand-700 hover:text-brand-800"
                        >
                            Contact us →
                        </a>

                    </div>

                </div>

            </aside>


            {{-- =====================================================
                PRODUCTS
            ====================================================== --}}
            <div class="min-w-0">


                {{-- Active filters --}}
                @if($hasFilters)

                    <div class="flex flex-wrap items-center gap-2 mb-5">

                        <span class="text-xs font-semibold text-zinc-500 mr-1">
                            Active:
                        </span>

                        @if(request('search'))

                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 bg-white border border-zinc-200 rounded-md text-xs font-medium text-zinc-700">

                                Search:
                                <strong class="text-zinc-900">
                                    {{ request('search') }}
                                </strong>

                            </span>

                        @endif


                        @if(request('category'))

                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 bg-white border border-zinc-200 rounded-md text-xs font-medium text-zinc-700">

                                Category:
                                <strong class="text-zinc-900">
                                    {{ optional($categories->firstWhere('slug', request('category')))->name ?? request('category') }}
                                </strong>

                            </span>

                        @endif


                        <a
                            href="{{ route('products.index') }}"
                            class="text-xs font-semibold text-brand-600 hover:text-brand-700 ml-1"
                        >
                            Clear filters
                        </a>

                    </div>

                @endif


                {{-- No results --}}
                @if($products->isEmpty())

                    <div class="bg-white border border-zinc-200 rounded-xl py-20 px-6 text-center">

                        <div class="mx-auto w-14 h-14 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-400">

                            <svg
                                class="w-7 h-7"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    d="m21 21-4.5-4.5m2-5.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                                />
                            </svg>

                        </div>

                        <h2 class="mt-5 text-lg font-bold text-zinc-950">
                            No products found
                        </h2>

                        <p class="mt-2 max-w-md mx-auto text-sm text-zinc-500 leading-6">
                            We couldn't find products matching your current search or filters.
                            Try a broader search or browse the complete catalogue.
                        </p>

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center mt-6 h-10 px-5 bg-zinc-950 hover:bg-brand-600 text-white rounded-lg text-sm font-bold transition-colors"
                        >
                            View all products
                        </a>

                    </div>


                @else

                    {{-- Product toolbar --}}
                    <div class="flex items-center justify-between gap-4 mb-5">

                        <p class="text-xs sm:text-sm text-zinc-500">

                            Showing

                            <span class="font-semibold text-zinc-800">
                                {{ $products->firstItem() }}–{{ $products->lastItem() }}
                            </span>

                            of

                            <span class="font-semibold text-zinc-800">
                                {{ number_format($products->total()) }}
                            </span>

                        </p>


                        <div class="hidden sm:flex items-center gap-2 text-xs text-zinc-400">

                            <span>
                                Sort:
                            </span>

                            <span class="font-semibold text-zinc-700">
                                {{ $sortOptions[request('sort', '')] ?? 'Featured' }}
                            </span>

                        </div>

                    </div>


                    {{-- Product grid --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-6">

                        @foreach($products as $product)

                            @php

                                $salePrice = is_numeric($product->sale_price)
                                    ? (float) $product->sale_price
                                    : null;

                                $regularPrice = is_numeric($product->regular_price)
                                    ? (float) $product->regular_price
                                    : null;

                                $hasSale = $salePrice !== null
                                    && $regularPrice !== null
                                    && $salePrice < $regularPrice;

                                $discount = $hasSale
                                    ? round((($regularPrice - $salePrice) / $regularPrice) * 100)
                                    : null;

                            @endphp


                            <article
                                class="group bg-white border border-zinc-200 rounded-xl overflow-hidden flex flex-col min-w-0 hover:border-zinc-300 hover:shadow-card transition-all duration-200"
                            >

                                {{-- Product image --}}
                                <div class="relative bg-white">

                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        class="block aspect-square overflow-hidden bg-zinc-50"
                                    >

                                        @if($product->local_image_path && file_exists(public_path($product->local_image_path)))

                                            <img
                                                src="{{ asset($product->local_image_path) }}"
                                                alt="{{ $product->title }} in Kenya"
                                                width="600"
                                                height="600"
                                                loading="lazy"
                                                class="w-full h-full object-contain p-4 sm:p-6 group-hover:scale-[1.035] transition-transform duration-300"
                                            >

                                        @elseif($product->image_url)

                                            <img
                                                src="{{ $product->image_url }}"
                                                alt="{{ $product->title }} in Kenya"
                                                width="600"
                                                height="600"
                                                loading="lazy"
                                                class="w-full h-full object-contain p-4 sm:p-6 group-hover:scale-[1.035] transition-transform duration-300"
                                            >

                                        @else

                                            <div class="w-full h-full flex items-center justify-center">

                                                <div class="w-12 h-12 rounded-lg bg-zinc-100 flex items-center justify-center text-zinc-400">

                                                    <svg
                                                        class="w-6 h-6"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-width="1.5"
                                                            d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2 1.586-1.586a2 2 0 0 1 2.828 0L20 14M14 8h.01M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"
                                                        />
                                                    </svg>

                                                </div>

                                            </div>

                                        @endif

                                    </a>


                                    {{-- Sale badge --}}
                                    @if($hasSale)

                                        <span class="absolute top-3 left-3 px-2 py-1 bg-brand-600 text-white text-[10px] font-extrabold uppercase tracking-wide rounded-md">
                                            Sale
                                        </span>

                                    @endif

                                </div>


                                {{-- Product content --}}
                                <div class="p-4 flex flex-col flex-1">

                                    {{-- Category --}}
                                    @if($product->category)

                                        <a
                                            href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                                            class="inline-flex self-start max-w-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wide text-brand-700 hover:text-brand-800 mb-2 truncate"
                                        >
                                            {{ $product->category->name }}
                                        </a>

                                    @endif


                                    {{-- Title --}}
                                    <h2 class="text-sm font-bold text-zinc-900 leading-5 line-clamp-2 min-h-[40px]">

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="hover:text-brand-600 transition-colors"
                                        >
                                            {{ $product->title }}
                                        </a>

                                    </h2>


                                    {{-- Description --}}
                                    <p class="mt-2 text-xs text-zinc-500 leading-5 line-clamp-2 min-h-[40px]">
                                        {{ $product->short_description ?? Str::limit(strip_tags($product->description), 90) }}
                                    </p>


                                    {{-- Price --}}
                                    <div class="mt-4">

                                        @if($hasSale)

                                            <div class="flex items-baseline gap-2 flex-wrap">

                                                <span class="text-base sm:text-lg font-extrabold text-zinc-950">
                                                    KSh {{ number_format($salePrice, 0) }}
                                                </span>

                                                <span class="text-xs text-zinc-400 line-through">
                                                    KSh {{ number_format($regularPrice, 0) }}
                                                </span>

                                            </div>

                                            @if($discount)
                                                <span class="text-[10px] font-bold text-brand-700">
                                                    Save {{ $discount }}%
                                                </span>
                                            @endif

                                        @elseif($regularPrice !== null)

                                            <span class="text-base sm:text-lg font-extrabold text-zinc-950">
                                                KSh {{ number_format($regularPrice, 0) }}
                                            </span>

                                        @else

                                            <span class="text-sm font-bold text-zinc-700">
                                                Contact for price
                                            </span>

                                        @endif

                                    </div>


                                    {{-- Actions --}}
                                    <div class="mt-4 pt-3 border-t border-zinc-100 flex items-center gap-2">

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="flex-1 h-9 inline-flex items-center justify-center rounded-md bg-zinc-950 hover:bg-brand-600 text-white text-xs font-bold transition-colors"
                                        >
                                            View product
                                        </a>

                                        <a
                                            href="https://wa.me/{{ config('services.whatsapp.number') }}?text={{ urlencode('Hello JosTech, I am interested in ' . $product->title . '. ' . route('products.show', $product)) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            aria-label="Ask about {{ $product->title }} on WhatsApp"
                                            class="w-9 h-9 shrink-0 inline-flex items-center justify-center rounded-md border border-zinc-300 text-zinc-600 hover:border-brand-500 hover:text-brand-600 hover:bg-brand-50 transition-colors"
                                        >
                                            <svg
                                                class="w-4 h-4"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path d="M20.52 3.48A11.87 11.87 0 0 0 12.04 0C5.49 0 .16 5.33.16 11.88c0 2.09.55 4.13 1.6 5.93L.05 24l6.34-1.66a11.88 11.88 0 0 0 5.65 1.43h.01c6.55 0 11.88-5.33 11.88-11.88 0-3.18-1.24-6.17-3.41-8.41ZM12.05 21.7h-.01a9.82 9.82 0 0 1-5.01-1.37l-.36-.21-3.76.99 1-3.67-.23-.38a9.84 9.84 0 1 1 8.37 4.64Zm5.39-7.38c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15-.2.3-.78.98-.96 1.18-.18.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.47-.89-.79-1.49-1.76-1.67-2.06-.17-.3-.02-.46.13-.61.14-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.68-1.63-.93-2.23-.24-.58-.49-.5-.68-.51h-.58c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.21 5.08 4.5.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.78-.73 2.03-1.43.25-.7.25-1.3.17-1.43-.07-.12-.27-.2-.57-.35Z"/>
                                            </svg>
                                        </a>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>


                    {{-- Pagination --}}
                    @if($products->hasPages())

                        <div class="mt-9 pt-6 border-t border-zinc-200">

                            {{ $products->withQueryString()->links() }}

                        </div>

                    @endif

                @endif

            </div>

        </div>

    </section>


    {{-- =========================================================
        MOBILE FILTER DRAWER
    ========================================================== --}}
    <div
        x-show="filtersOpen"
        x-cloak
        class="fixed inset-0 z-[70] lg:hidden"
        role="dialog"
        aria-modal="true"
        aria-label="Product filters"
    >

        {{-- Overlay --}}
        <div
            class="absolute inset-0 bg-zinc-950/40"
            @click="filtersOpen = false"
        ></div>


        {{-- Drawer --}}
        <div
            x-show="filtersOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full"
            class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl max-h-[85vh] overflow-y-auto"
        >

            <div class="sticky top-0 bg-white border-b border-zinc-200 px-5 py-4 flex items-center justify-between">

                <div>
                    <h2 class="font-bold text-zinc-950">
                        Filter products
                    </h2>

                    <p class="text-xs text-zinc-500 mt-0.5">
                        Narrow down the catalogue
                    </p>
                </div>

                <button
                    type="button"
                    @click="filtersOpen = false"
                    class="w-9 h-9 rounded-lg bg-zinc-100 text-zinc-600 flex items-center justify-center"
                    aria-label="Close filters"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M6 6l12 12M18 6 6 18"
                        />
                    </svg>
                </button>

            </div>


            <form
                action="{{ route('products.index') }}"
                method="GET"
                class="p-5"
            >

                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif


                {{-- Categories --}}
                <div class="pb-6">

                    <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-4">
                        Category
                    </h3>

                    <div class="grid grid-cols-1 gap-2">

                        <label class="flex items-center gap-3 p-3 border border-zinc-200 rounded-lg">

                            <input
                                type="radio"
                                name="category"
                                value=""
                                @checked(!request('category'))
                                class="w-4 h-4 accent-brand-600"
                            >

                            <span class="text-sm font-medium">
                                All products
                            </span>

                        </label>


                        @if(isset($categories))

                            @foreach($categories as $cat)

                                <label class="flex items-center gap-3 p-3 border border-zinc-200 rounded-lg">

                                    <input
                                        type="radio"
                                        name="category"
                                        value="{{ $cat->slug }}"
                                        @checked(request('category') === $cat->slug)
                                        class="w-4 h-4 accent-brand-600"
                                    >

                                    <span class="text-sm font-medium flex-1">
                                        {{ $cat->name }}
                                    </span>

                                    @if(isset($cat->products_count))
                                        <span class="text-xs text-zinc-400">
                                            {{ $cat->products_count }}
                                        </span>
                                    @endif

                                </label>

                            @endforeach

                        @endif

                    </div>

                </div>


                {{-- Price --}}
                <div class="pb-6">

                    <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-4">
                        Price range
                    </h3>

                    <div class="grid grid-cols-2 gap-2">

                        <label class="p-3 border border-zinc-200 rounded-lg">

                            <input
                                type="radio"
                                name="price_range"
                                value="0-5000"
                                onchange="applyPriceRange(this)"
                                class="mr-2 accent-brand-600"
                            >

                            <span class="text-xs">
                                Under 5K
                            </span>

                        </label>

                        <label class="p-3 border border-zinc-200 rounded-lg">

                            <input
                                type="radio"
                                name="price_range"
                                value="5000-10000"
                                onchange="applyPriceRange(this)"
                                class="mr-2 accent-brand-600"
                            >

                            <span class="text-xs">
                                5K – 10K
                            </span>

                        </label>

                        <label class="p-3 border border-zinc-200 rounded-lg">

                            <input
                                type="radio"
                                name="price_range"
                                value="10000-25000"
                                onchange="applyPriceRange(this)"
                                class="mr-2 accent-brand-600"
                            >

                            <span class="text-xs">
                                10K – 25K
                            </span>

                        </label>

                        <label class="p-3 border border-zinc-200 rounded-lg">

                            <input
                                type="radio"
                                name="price_range"
                                value="25000-50000"
                                onchange="applyPriceRange(this)"
                                class="mr-2 accent-brand-600"
                            >

                            <span class="text-xs">
                                25K – 50K
                            </span>

                        </label>

                        <label class="col-span-2 p-3 border border-zinc-200 rounded-lg">

                            <input
                                type="radio"
                                name="price_range"
                                value="50000-"
                                onchange="applyPriceRange(this)"
                                class="mr-2 accent-brand-600"
                            >

                            <span class="text-xs">
                                Above KSh 50,000
                            </span>

                        </label>

                    </div>

                </div>


                <div class="sticky bottom-0 bg-white pt-4 border-t border-zinc-200 flex gap-3">

                    <a
                        href="{{ route('products.index') }}"
                        class="flex-1 h-11 inline-flex items-center justify-center border border-zinc-300 rounded-lg text-sm font-semibold text-zinc-700"
                    >
                        Clear
                    </a>

                    <button
                        type="submit"
                        class="flex-1 h-11 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-sm font-bold"
                    >
                        Apply filters
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
    PRICE RANGE HELPER
============================================================= --}}
@push('scripts')

<script>
    function applyPriceRange(input) {
        const form = input.closest('form');

        const [min, max] = input.value.split('-');

        let minInput = form.querySelector('[name="min_price"]');
        let maxInput = form.querySelector('[name="max_price"]');

        if (!minInput) {
            minInput = document.createElement('input');
            minInput.type = 'hidden';
            minInput.name = 'min_price';
            form.appendChild(minInput);
        }

        if (!maxInput) {
            maxInput = document.createElement('input');
            maxInput.type = 'hidden';
            maxInput.name = 'max_price';
            form.appendChild(maxInput);
        }

        minInput.value = min || '';
        maxInput.value = max || '';
    }
</script>

@endpush

@endsection