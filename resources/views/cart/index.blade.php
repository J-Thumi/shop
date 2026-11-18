@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <p class="text-sm font-semibold text-orange-600">YOUR SHOPPING</p>
            <h1 class="text-3xl font-bold text-zinc-900 mt-2">Shopping cart</h1>
            <p class="text-sm text-zinc-500 mt-2">
                Review your items before proceeding to checkout.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-5 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        @if($cart->items->isEmpty())
            <div class="bg-white border border-zinc-200 rounded-2xl p-12 text-center">
                <div class="text-4xl mb-4">🛒</div>
                <h2 class="text-xl font-bold text-zinc-900">Your cart is empty</h2>
                <p class="text-sm text-zinc-500 mt-2">
                    Explore our products and add something to your cart.
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex mt-6 px-6 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm">
                    Browse products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart->items as $item)
                        @if($item->product)
                            @php
                                $unitPrice = $prices->getPrice($item->product);
                                $lineTotal = $unitPrice * $item->quantity;
                            @endphp

                            <div class="bg-white border border-zinc-200 rounded-2xl p-4 sm:p-5 flex gap-4">
                                <div class="w-24 h-24 shrink-0 rounded-xl bg-zinc-100 overflow-hidden">
                                    @if($item->product->image_path)
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                             alt="{{ $item->product->title }}"
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('products.show', $item->product) }}"
                                       class="font-semibold text-zinc-900 hover:text-orange-600">
                                        {{ $item->product->title }}
                                    </a>

                                    <p class="text-sm text-zinc-500 mt-1">
                                        KES {{ number_format($unitPrice, 2) }} each
                                    </p>

                                    <div class="flex flex-wrap items-center justify-between gap-3 mt-4">
                                        <form action="{{ route('cart.update', $item->id) }}"
                                              method="POST"
                                              class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <label for="quantity-{{ $item->id }}"
                                                   class="sr-only">Quantity</label>

                                            <input id="quantity-{{ $item->id }}"
                                                   type="number"
                                                   name="quantity"
                                                   min="1"
                                                   max="50"
                                                   value="{{ $item->quantity }}"
                                                   class="w-20 rounded-lg border border-zinc-300 px-3 py-2 text-sm">

                                            <button type="submit"
                                                    class="text-sm font-semibold text-orange-600 hover:text-orange-700">
                                                Update
                                            </button>
                                        </form>

                                        <div class="flex items-center gap-4">
                                            <p class="font-bold text-zinc-900">
                                                KES {{ number_format($lineTotal, 2) }}
                                            </p>

                                            <form action="{{ route('cart.destroy', $item->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-sm text-red-500 hover:text-red-700">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div>
                    <div class="bg-white border border-zinc-200 rounded-2xl p-6 sticky top-6">
                        <h2 class="font-bold text-lg text-zinc-900">Order summary</h2>

                        <div class="flex justify-between mt-6 text-sm">
                            <span class="text-zinc-500">Subtotal</span>
                            <span class="font-semibold text-zinc-900">
                                KES {{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between mt-3 text-sm">
                            <span class="text-zinc-500">Payment</span>
                            <span class="font-medium text-zinc-900">On collection</span>
                        </div>

                        <div class="border-t border-zinc-200 mt-5 pt-5 flex justify-between">
                            <span class="font-bold text-zinc-900">Total</span>
                            <span class="font-bold text-xl text-zinc-900">
                                KES {{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="mt-6 w-full flex justify-center rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3.5 text-sm font-bold text-white transition">
                            Proceed to checkout
                        </a>

                        <p class="text-xs text-zinc-500 text-center mt-4">
                            You will pay when collecting your order.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection