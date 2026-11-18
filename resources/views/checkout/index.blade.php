@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <p class="text-sm font-semibold text-orange-600">FINAL STEP</p>
            <h1 class="text-3xl font-bold text-zinc-900 mt-2">Checkout</h1>
            <p class="text-sm text-zinc-500 mt-2">
                Confirm your details and select where you would like to collect your order.
            </p>
        </div>

        @if($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <section class="bg-white border border-zinc-200 rounded-2xl p-6">
                        <h2 class="font-bold text-lg text-zinc-900">Customer information</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                            <div class="sm:col-span-2">
                                <label for="customer_name"
                                       class="block text-sm font-semibold text-zinc-700 mb-2">
                                    Full name
                                </label>

                                <input id="customer_name"
                                       name="customer_name"
                                       type="text"
                                       required
                                       maxlength="150"
                                       value="{{ old('customer_name', auth()->user()->name) }}"
                                       class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm focus:border-orange-500 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">
                                    Email address
                                </label>

                                <input type="email"
                                       value="{{ auth()->user()->email }}"
                                       disabled
                                       class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-500">
                                <p class="text-xs text-zinc-500 mt-1">
                                    Your order confirmation will be sent here.
                                </p>
                            </div>

                            <div>
                                <label for="customer_phone"
                                       class="block text-sm font-semibold text-zinc-700 mb-2">
                                    Phone number
                                </label>

                                <input id="customer_phone"
                                       name="customer_phone"
                                       type="tel"
                                       maxlength="30"
                                       value="{{ old('customer_phone') }}"
                                       placeholder="e.g. 07XXXXXXXX"
                                       class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm focus:border-orange-500 focus:ring-orange-500">
                            </div>
                        </div>
                    </section>

                    <section class="bg-white border border-zinc-200 rounded-2xl p-6">
                        <h2 class="font-bold text-lg text-zinc-900">Choose a pickup location</h2>

                        <p class="text-sm text-zinc-500 mt-1">
                            Select the location where you will collect your items.
                        </p>

                        <div class="space-y-3 mt-5">
                            @foreach($locations as $location)
                                <label class="flex gap-4 p-4 rounded-xl border border-zinc-200 cursor-pointer hover:border-orange-400 transition">
                                    <input type="radio"
                                           name="pickup_location_id"
                                           value="{{ $location->id }}"
                                           required
                                           @checked(old('pickup_location_id') == $location->id)
                                           class="mt-1 text-orange-500 focus:ring-orange-500">

                                    <div>
                                        <p class="font-semibold text-zinc-900">
                                            {{ $location->name }}
                                        </p>

                                        <p class="text-sm text-zinc-600 mt-1">
                                            {{ $location->address }}
                                        </p>

                                        @if($location->description)
                                            <p class="text-xs text-zinc-500 mt-2">
                                                {{ $location->description }}
                                            </p>
                                        @endif

                                        @if($location->opening_hours)
                                            <p class="text-xs text-zinc-500 mt-1">
                                                Opening hours: {{ $location->opening_hours }}
                                            </p>
                                        @endif

                                        @if($location->phone)
                                            <p class="text-xs text-zinc-500 mt-1">
                                                Contact: {{ $location->phone }}
                                            </p>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="bg-white border border-zinc-200 rounded-2xl p-6">
                        <h2 class="font-bold text-lg text-zinc-900">Payment method</h2>

                        <div class="mt-4 p-4 rounded-xl border border-orange-200 bg-orange-50">
                            <p class="font-semibold text-zinc-900">
                                Pay when collecting your order
                            </p>
                            <p class="text-sm text-zinc-600 mt-1">
                                You will pay at the selected pickup location when collecting your items.
                            </p>
                        </div>
                    </section>

                    <section class="bg-white border border-zinc-200 rounded-2xl p-6">
                        <label for="customer_note"
                               class="block text-sm font-semibold text-zinc-700 mb-2">
                            Additional instructions (optional)
                        </label>

                        <textarea id="customer_note"
                                  name="customer_note"
                                  rows="3"
                                  maxlength="1000"
                                  placeholder="Anything we should know about your order?"
                                  class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm focus:border-orange-500 focus:ring-orange-500">{{ old('customer_note') }}</textarea>
                    </section>
                </div>

                <div>
                    <div class="bg-white border border-zinc-200 rounded-2xl p-6 sticky top-6">
                        <h2 class="font-bold text-lg text-zinc-900">Your order</h2>

                        <div class="space-y-4 mt-5">
                            @foreach($cart->items as $item)
                                @if($item->product)
                                    @php
                                        $regular = is_numeric($item->product->regular_price)
                                            ? (float) $item->product->regular_price
                                            : 0;

                                        $sale = is_numeric($item->product->sale_price)
                                            ? (float) $item->product->sale_price
                                            : null;

                                        $price = ($sale && $sale > 0 && $sale < $regular)
                                            ? $sale
                                            : $regular;
                                    @endphp

                                    <div class="flex justify-between gap-3 text-sm">
                                        <div>
                                            <p class="font-medium text-zinc-900">
                                                {{ $item->product->title }}
                                            </p>
                                            <p class="text-zinc-500">
                                                Quantity: {{ $item->quantity }}
                                            </p>
                                            <p class="text-zinc-500">
                                                Price of One: {{ ($sale && $sale > 0 && $sale < $regular)
                                            ? $sale
                                            : $regular}}
                                            </p>
                                        </div>

                                        <p class="font-semibold text-zinc-900 whitespace-nowrap">
                                            KES {{ number_format($price * $item->quantity, 2) }}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="border-t border-zinc-200 mt-5 pt-5 flex justify-between">
                            <span class="font-bold text-zinc-900">Total</span>
                            <span class="font-bold text-xl text-zinc-900">
                                KES
                                {{ number_format(
                                    $cart->items->sum(function ($item) {
                                        if (!$item->product) return 0;

                                        $regular = is_numeric($item->product->regular_price)
                                            ? (float) $item->product->regular_price : 0;

                                        $sale = is_numeric($item->product->sale_price)
                                            ? (float) $item->product->sale_price : null;

                                        $price = ($sale && $sale > 0 && $sale < $regular)
                                            ? $sale : $regular;

                                        return $price * $item->quantity;
                                    }), 2
                                ) }}
                            </span>
                        </div>

                        <button type="submit"
                                class="mt-6 w-full rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3.5 text-sm font-bold text-white transition">
                            Place order
                        </button>

                        <p class="text-xs text-zinc-500 text-center mt-4">
                            You will not be charged online.
                        </p>

                        <a href="{{ route('cart.index') }}"
                           class="block text-center text-sm text-zinc-500 hover:text-orange-600 mt-4">
                            Return to cart
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection