@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="text-sm font-semibold text-orange-600">YOUR ACCOUNT</p>
            <h1 class="text-3xl font-bold text-zinc-900 mt-2">My orders</h1>
        </div>

        @if(session('success'))
            <div class="mb-5 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @forelse($orders as $order)
            <div class="bg-white border border-zinc-200 rounded-2xl p-5 mb-4">
                <div class="flex flex-wrap justify-between gap-4">
                    <div>
                        <p class="font-bold text-zinc-900">{{ $order->order_number }}</p>
                        <p class="text-xs text-zinc-500 mt-1">
                            Placed {{ $order->placed_at?->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-zinc-900">
                            KES {{ number_format((float) $order->total, 2) }}
                        </p>
                        <span class="inline-flex mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-zinc-100 mt-4 pt-4 flex flex-wrap justify-between gap-3">
                    <p class="text-sm text-zinc-500">
                        Tracking: <span class="font-medium text-zinc-800">{{ $order->tracking_number }}</span>
                    </p>

                    <a href="{{ route('orders.show', $order) }}"
                       class="text-sm font-semibold text-orange-600 hover:text-orange-700">
                        View order →
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white border border-zinc-200 rounded-2xl p-12 text-center">
                <h2 class="font-bold text-xl text-zinc-900">No orders yet</h2>
                <p class="text-sm text-zinc-500 mt-2">Your orders will appear here after checkout.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex mt-6 px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold text-sm">
                    Browse products
                </a>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection