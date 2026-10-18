@extends('layouts.app')

@section('title', $product->title)

@section('content')

<div class="bg-white">

{{-- Breadcrumbs --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5">
    <nav class="flex items-center gap-2 text-sm text-gray-500 overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
        <a href="{{ route('products.index') }}" class="hover:text-brand-600 transition-colors">
            Products
        </a>

        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>

        @if($product->category)
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
               class="hover:text-brand-600 transition-colors">
                {{ $product->category->name }}
            </a>

            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        @endif

        <span class="text-gray-800 font-medium truncate">
            {{ $product->title }}
        </span>
    </nav>
</div>


{{-- Product --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    <div class="grid grid-cols-1 lg:grid-cols-[1.05fr_0.95fr] gap-8 lg:gap-14">

        {{-- ========================================= --}}
        {{-- PRODUCT IMAGE --}}
        {{-- ========================================= --}}
        <div>

            <div class="relative bg-gray-50 border border-gray-200 overflow-hidden min-h-[360px] sm:min-h-[460px] lg:min-h-[540px] flex items-center justify-center">

                @if($product->local_image_path && file_exists(public_path($product->local_image_path)))

                    <img
                        src="{{ asset($product->local_image_path) }}"
                        alt="{{ $product->title }}"
                        class="w-full h-full max-h-[540px] object-contain p-8 sm:p-12 transition-transform duration-500 hover:scale-[1.03]"
                    >

                @elseif($product->image_url)

                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->title }}"
                        class="w-full h-full max-h-[540px] object-contain p-8 sm:p-12 transition-transform duration-500 hover:scale-[1.03]"
                    >

                @else

                    <div class="flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>

                        <span class="text-sm font-medium">
                            Product image unavailable
                        </span>
                    </div>

                @endif

            </div>

            {{-- Image note --}}
            <div class="flex items-center justify-center gap-2 mt-3 text-xs text-gray-500">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Product availability and pricing may vary
            </div>

        </div>


        {{-- ========================================= --}}
        {{-- PRODUCT INFORMATION --}}
        {{-- ========================================= --}}
        <div class="flex flex-col">

            {{-- Category --}}
            @if($product->category)
                <div class="mb-4">
                    <a
                        href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                        class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-brand-600 hover:text-brand-700 transition-colors"
                    >
                        {{ $product->category->name }}
                    </a>
                </div>
            @endif


            {{-- Product title --}}
            <h1 class="text-2xl sm:text-3xl lg:text-[2.15rem] font-bold tracking-tight text-gray-950 leading-tight">
                {{ $product->title }}
            </h1>


            {{-- Short description --}}
            @if($product->short_description)
                <p class="mt-4 text-[15px] leading-7 text-gray-600 max-w-2xl">
                    {{ $product->short_description }}
                </p>
            @endif


            {{-- Price --}}
            <div class="mt-7 pb-6 border-b border-gray-200">

                @if($product->sale_price)

                    <div class="flex flex-wrap items-end gap-x-3 gap-y-1">

                        <span class="text-3xl sm:text-4xl font-extrabold text-gray-950 tracking-tight">
                            KSh {{ number_format($product->sale_price, 2) }}
                        </span>

                        @if($product->regular_price)
                            <span class="text-base sm:text-lg text-gray-400 line-through mb-1">
                                KSh {{ number_format($product->regular_price, 2) }}
                            </span>
                        @endif

                    </div>

                    <span class="inline-flex mt-2 text-xs font-bold uppercase tracking-wide text-brand-600">
                        Special price
                    </span>

                @elseif($product->regular_price)

                    <span class="text-3xl sm:text-4xl font-extrabold text-gray-950 tracking-tight">
                        KSh {{ number_format($product->regular_price, 2) }}
                    </span>

                @else

                    <span class="text-2xl font-bold text-gray-950">
                        Contact for pricing
                    </span>

                @endif

            </div>


            {{-- Purchase / enquiry area --}}
            <div class="py-6 border-b border-gray-200">

                <p class="text-sm font-semibold text-gray-900 mb-3">
                    Interested in this product?
                </p>

                <div class="flex flex-col sm:flex-row gap-3">

                    @if($product->whatsapp_order_link)

                        <a
                            href="{{ $product->whatsapp_order_link }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex-1 inline-flex items-center justify-center gap-2.5 bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold px-6 py-3.5 transition-colors duration-200"
                        >
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.04 2C6.54 2 2.07 6.47 2.07 11.97c0 1.76.46 3.48 1.33 5L2 22l5.18-1.36a9.93 9.93 0 004.86 1.27h.01c5.5 0 9.97-4.47 9.97-9.97C22.02 6.47 17.54 2 12.04 2zm0 18.12h-.01a8.2 8.2 0 01-4.18-1.15l-.3-.18-3.07.8.82-2.99-.2-.31a8.2 8.2 0 01-1.26-4.32c0-4.52 3.68-8.2 8.2-8.2 2.19 0 4.25.85 5.8 2.4a8.15 8.15 0 012.4 5.81c0 4.52-3.68 8.2-8.2 8.2zm4.5-6.14c-.25-.13-1.47-.73-1.7-.81-.23-.08-.39-.13-.55.13-.16.25-.63.81-.77.97-.14.17-.28.19-.52.06-.25-.13-1.03-.38-1.96-1.21-.73-.65-1.22-1.45-1.36-1.69-.14-.25-.01-.38.11-.5.11-.11.25-.28.37-.42.13-.15.17-.25.25-.41.08-.17.04-.31-.02-.44-.06-.13-.55-1.33-.76-1.82-.2-.48-.4-.42-.55-.43h-.47c-.16 0-.42.06-.64.31-.22.25-.84.82-.84 2s.86 2.32.98 2.48c.12.17 1.69 2.58 4.09 3.62.57.25 1.01.4 1.35.51.57.18 1.09.15 1.5.09.46-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.22-.16-.47-.29z"/>
                            </svg>

                            Order via WhatsApp
                        </a>

                    @endif

                    <!-- @if($product->product_link)

                        <a
                            href="{{ $product->product_link }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="sm:w-auto inline-flex items-center justify-center gap-2 border border-gray-300 bg-white text-gray-800 font-semibold px-5 py-3.5 hover:border-gray-500 hover:bg-gray-50 transition-colors"
                        >
                            View source
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>

                    @endif -->

                </div>

                <p class="mt-3 text-xs text-gray-500">
                    Contact us on WhatsApp for availability, quantity, delivery and product enquiries.
                </p>

            </div>


            {{-- Trust / service information --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 border-b border-gray-200">

                <div class="py-5 sm:pr-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M20 7l-8 4-8-4m16 0l-8-4-8 4m16 0v10l-8 4-8-4V7"/>
                        </svg>

                        <div>
                            <p class="text-sm font-semibold text-gray-900">Product enquiries</p>
                            <p class="text-xs text-gray-500 mt-1">Get product information before ordering.</p>
                        </div>
                    </div>
                </div>

                <div class="py-5 sm:px-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M3 10h18M7 15h.01M11 15h.01M15 15h.01M19 15h.01M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>

                        <div>
                            <p class="text-sm font-semibold text-gray-900">Competitive pricing</p>
                            <p class="text-xs text-gray-500 mt-1">Request a quote for your requirements.</p>
                        </div>
                    </div>
                </div>

                <div class="py-5 sm:pl-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2l-4 3v-3H9a2 2 0 01-2-2v-1m0-8H5a2 2 0 00-2 2v6a2 2 0 002 2h2l4 3v-3h1"/>
                        </svg>

                        <div>
                            <p class="text-sm font-semibold text-gray-900">Direct support</p>
                            <p class="text-xs text-gray-500 mt-1">Talk to us directly about your order.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


{{-- ========================================= --}}
{{-- PRODUCT SPECIFICATIONS --}}
{{-- ========================================= --}}
@if(!empty($product->features) && is_array($product->features))

    <section class="border-t border-gray-200 bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

            <div class="max-w-3xl">

                <span class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
                    Product details
                </span>

                <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-950">
                    Specifications & Features
                </h2>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Technical information and key details for this product.
                </p>

            </div>


            <div class="mt-8 max-w-5xl border border-gray-200 bg-white">

                @foreach($product->features as $key => $value)

                    <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] border-b border-gray-200 last:border-b-0">

                        <div class="px-5 py-4 bg-gray-50 border-b md:border-b-0 md:border-r border-gray-200">
                            <span class="text-xs font-bold uppercase tracking-wide text-gray-700">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="px-5 py-4">

                            @if(is_array($value))

                                <ul class="space-y-2">

                                    @foreach($value as $item)

                                        <li class="flex items-start gap-2 text-sm leading-6 text-gray-600">
                                            <span class="w-1.5 h-1.5 bg-brand-600 rounded-full mt-2.5 flex-shrink-0"></span>
                                            <span>{{ $item }}</span>
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <span class="text-sm leading-6 text-gray-800">
                                    {{ $value }}
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>

@endif


{{-- ========================================= --}}
{{-- DESCRIPTION --}}
{{-- ========================================= --}}
@if($product->description)

    <section class="bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

            <div class="max-w-4xl">

                <span class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
                    About this product
                </span>

                <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-950">
                    Product Overview
                </h2>

                <div class="mt-6 prose prose-gray max-w-none text-[15px] leading-7">
                    {!! $product->description !!}
                </div>

            </div>

        </div>

    </section>

@endif


{{-- ========================================= --}}
{{-- RELATED PRODUCTS --}}
{{-- ========================================= --}}
@if(isset($relatedProducts) && $relatedProducts->isNotEmpty())

    <section class="border-t border-gray-200 bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

            <div class="flex items-end justify-between gap-4 mb-7">

                <div>
                    <span class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
                        You may also need
                    </span>

                    <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-950">
                        Related Products
                    </h2>
                </div>

                @if($product->category)
                    <a
                        href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                        class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-gray-700 hover:text-brand-600 transition-colors"
                    >
                        View category

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 12h14m-5-5l5 5-5 5"/>
                        </svg>
                    </a>
                @endif

            </div>


            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">

                @foreach($relatedProducts as $related)

                    <article class="group bg-white border border-gray-200 hover:border-gray-300 transition-colors">

                        <a
                            href="{{ route('products.show', $related) }}"
                            class="block aspect-square bg-gray-50 overflow-hidden"
                        >

                            @if($related->local_image_path && file_exists(public_path($related->local_image_path)))

                                <img
                                    src="{{ asset($related->local_image_path) }}"
                                    alt="{{ $related->title }}"
                                    loading="lazy"
                                    class="w-full h-full object-contain p-4 sm:p-6 group-hover:scale-105 transition-transform duration-300"
                                >

                            @elseif($related->image_url)

                                <img
                                    src="{{ $related->image_url }}"
                                    alt="{{ $related->title }}"
                                    loading="lazy"
                                    class="w-full h-full object-contain p-4 sm:p-6 group-hover:scale-105 transition-transform duration-300"
                                >

                            @else

                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                            @endif

                        </a>


                        <div class="p-4">

                            @if($related->category)
                                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">
                                    {{ $related->category->name }}
                                </p>
                            @endif

                            <h3 class="text-sm font-semibold text-gray-900 leading-5 line-clamp-2 min-h-[40px]">
                                <a
                                    href="{{ route('products.show', $related) }}"
                                    class="hover:text-brand-600 transition-colors"
                                >
                                    {{ $related->title }}
                                </a>
                            </h3>


                            <div class="mt-3">

                                @if($related->sale_price)

                                    <span class="text-sm font-bold text-gray-950">
                                        KSh {{ number_format($related->sale_price, 2) }}
                                    </span>

                                    @if($related->regular_price)
                                        <span class="ml-1 text-xs text-gray-400 line-through">
                                            KSh {{ number_format($related->regular_price, 2) }}
                                        </span>
                                    @endif

                                @elseif($related->regular_price)

                                    <span class="text-sm font-bold text-gray-950">
                                        KSh {{ number_format($related->regular_price, 2) }}
                                    </span>

                                @else

                                    <span class="text-xs font-semibold text-gray-500">
                                        Contact for price
                                    </span>

                                @endif

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        </div>

    </section>

@endif

</div>

@endsection