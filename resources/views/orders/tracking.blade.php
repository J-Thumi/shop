@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-zinc-200 rounded-2xl p-7 sm:p-10">

            <p class="text-sm font-semibold text-orange-600">ORDER TRACKING</p>

            <h1 class="text-2xl font-bold text-zinc-900 mt-2">
                Track your order
            </h1>

            <p class="text-sm text-zinc-500 mt-2">
                Tracking number: {{ $order->tracking_number }}
            </p>

            <div class="mt-8">
                @php
                    $steps = [
                        'pending' => 'Order placed',
                        'confirmed' => 'Order confirmed',
                        'processing' => 'Processing',
                        'ready_for_collection' => 'Ready for collection',
                        'completed' => 'Collected',
                    ];

                    $statusOrder = array_keys($steps);
                    $currentIndex = array_search($order->status, $statusOrder, true);
                @endphp

                @if($order->status === 'cancelled')
                    <div class="rounded-xl bg-red-50 border border-red-200 p-5">
                        <p class="font-bold text-red-700">This order has been cancelled.</p>
                        <p class="text-sm text-red-600 mt-1">
                            Order {{ $order->order_number }}
                        </p>
                    </div>
                @else
                    <div class="space-y-5">
                        @foreach($steps as $key => $label)
                            @php
                                $index = array_search($key, $statusOrder, true);
                                $done = $currentIndex !== false && $index <= $currentIndex;
                            @endphp

                            <div class="flex gap-4 items-start">
                                <div class="w-8 h-8 shrink-0 rounded-full flex items-center justify-center
                                    {{ $done ? 'bg-orange-500 text-white' : 'bg-zinc-100 text-zinc-400' }}">
                                    @if($done)
                                        ✓
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </div>

                                <div>
                                    <p class="font-semibold {{ $done ? 'text-zinc-900' : 'text-zinc-400' }}">
                                        {{ $label }}
                                    </p>
                                    @if($key === $order->status)
                                        <p class="text-xs text-orange-600 mt-1">Current status</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="border-t border-zinc-100 mt-8 pt-6">
                <p class="text-sm text-zinc-500">Collection location</p>
                <p class="font-semibold text-zinc-900 mt-1">
                    {{ $order->pickup_location_name }}
                </p>
                <p class="text-sm text-zinc-500 mt-1">
                    {{ $order->pickup_location_address }}
                </p>
            </div>

            <a href="{{ route('orders.show', $order) }}"
               class="inline-flex mt-7 rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3 text-sm font-semibold text-white">
                View full order
            </a>
        </div>
    </div>
</div>
@endsection