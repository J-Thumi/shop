@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-5 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <a href="{{ route('orders.index') }}"
           class="text-sm text-zinc-500 hover:text-orange-600">
            ← Back to my orders
        </a>

        <div class="mt-5 bg-white border border-zinc-200 rounded-2xl p-6">
            <div class="flex flex-wrap justify-between gap-4">
                <div>
                    <p class="text-sm text-zinc-500">Order number</p>
                    <h1 class="text-2xl font-bold text-zinc-900 mt-1">
                        {{ $order->order_number }}
                    </h1>
                </div>

                <div>
                    <span class="inline-flex px-3 py-2 rounded-full bg-orange-50 text-orange-700 text-sm font-semibold">
                        {{ str_replace('_', ' ', ucfirst($order->status)) }}
                    </span>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5 mt-6 border-t border-zinc-100 pt-6">
                <div>
                    <p class="text-xs text-zinc-500">Tracking number</p>
                    <p class="font-semibold text-zinc-900 mt-1">{{ $order->tracking_number }}</p>
                    <a href="{{ route('orders.track', $order->tracking_number) }}"
                       class="text-sm text-orange-600 hover:text-orange-700 mt-2 inline-block">
                        Track this order →
                    </a>
                </div>

                <div>
                    <p class="text-xs text-zinc-500">Payment</p>
                    <p class="font-semibold text-zinc-900 mt-1">Pay on collection</p>
                    <p class="text-sm text-zinc-500 mt-1">
                        {{ ucfirst($order->payment_status) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <div class="lg:col-span-2 bg-white border border-zinc-200 rounded-2xl p-6">
                <h2 class="font-bold text-lg text-zinc-900">Order items</h2>

                <div class="divide-y divide-zinc-100 mt-4">
                    @foreach($order->items as $item)
                        <div class="py-4 flex justify-between gap-4">
                            <div>
                                <p class="font-semibold text-zinc-900">{{ $item->product_title }}</p>
                                <p class="text-sm text-zinc-500 mt-1">
                                    KES {{ number_format((float) $item->unit_price, 2) }}
                                    × {{ $item->quantity }}
                                </p>
                            </div>

                            <p class="font-semibold text-zinc-900 whitespace-nowrap">
                                KES {{ number_format((float) $item->line_total, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-zinc-200 pt-4 flex justify-between">
                    <span class="font-bold text-zinc-900">Total</span>
                    <span class="font-bold text-xl text-zinc-900">
                        KES {{ number_format((float) $order->total, 2) }}
                    </span>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white border border-zinc-200 rounded-2xl p-6">
                    <h2 class="font-bold text-lg text-zinc-900">Pickup location</h2>
                    <p class="font-semibold text-zinc-900 mt-4">
                        {{ $order->pickup_location_name }}
                    </p>
                    <p class="text-sm text-zinc-500 mt-2">
                        {{ $order->pickup_location_address }}
                    </p>

                    @if($order->pickup_location_phone)
                        <p class="text-sm text-zinc-500 mt-2">
                            {{ $order->pickup_location_phone }}
                        </p>
                    @endif
                </div>

                <div class="bg-white border border-zinc-200 rounded-2xl p-6">
                    <h2 class="font-bold text-lg text-zinc-900">Order activity</h2>

                    <div class="mt-4 space-y-4">
                        @foreach($order->statusHistories as $history)
                            <div class="border-l-2 border-orange-400 pl-4">
                                <p class="text-sm font-semibold text-zinc-900">
                                    {{ str_replace('_', ' ', ucfirst($history->status)) }}
                                </p>
                                @if($history->note)
                                    <p class="text-xs text-zinc-500 mt-1">{{ $history->note }}</p>
                                @endif
                                <p class="text-xs text-zinc-400 mt-1">
                                    {{ $history->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if($order->cancellation)
            <div class="mt-6 bg-white border border-zinc-200 rounded-2xl p-6">
                <h2 class="font-bold text-zinc-900">Cancellation request</h2>
                <p class="text-sm text-zinc-600 mt-2">
                    {{ $order->cancellation->reason }}
                </p>
                <p class="text-sm mt-2">
                    Status:
                    <span class="font-semibold">
                        {{ ucfirst($order->cancellation->status) }}
                    </span>
                </p>
                @if($order->cancellation->admin_note)
                    <p class="text-sm text-zinc-500 mt-2">
                        Shop response: {{ $order->cancellation->admin_note }}
                    </p>
                @endif
            </div>
        @endif

        @if($order->canBeCancelledImmediately() || $order->canRequestCancellation())
            <div class="mt-6 bg-white border border-zinc-200 rounded-2xl p-6">
                <h2 class="font-bold text-zinc-900">Cancel this order</h2>

                <p class="text-sm text-zinc-500 mt-2">
                    @if($order->canBeCancelledImmediately())
                        This order can still be cancelled immediately.
                    @else
                        This order has progressed. Your cancellation request will need shop approval.
                    @endif
                </p>

                <form action="{{ route('orders.cancel', $order) }}"
                      method="POST"
                      class="mt-4">
                    @csrf

                    <label for="reason" class="block text-sm font-semibold text-zinc-700 mb-2">
                        Reason for cancellation
                    </label>

                    <textarea name="reason"
                              id="reason"
                              rows="3"
                              required
                              minlength="5"
                              maxlength="1000"
                              class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm"
                              placeholder="Tell us why you want to cancel this order."></textarea>

                    <button type="submit"
                            onclick="return confirm('Are you sure you want to submit this cancellation?')"
                            class="mt-4 rounded-xl bg-red-600 hover:bg-red-700 px-5 py-3 text-sm font-semibold text-white">
                        Submit cancellation
                    </button>
                </form>
            </div>
        @endif

    </div>
</div>
@endsection