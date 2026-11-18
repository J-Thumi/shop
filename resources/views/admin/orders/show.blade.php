@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('admin.orders.index') }}"
           class="text-sm text-zinc-500 hover:text-orange-600">
            ← Back to orders
        </a>

        @if(session('success'))
            <div class="mt-5 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mt-5 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="bg-white border border-zinc-200 rounded-2xl p-6 mt-5">
            <div class="flex flex-wrap justify-between gap-4">
                <div>
                    <p class="text-sm text-zinc-500">Order number</p>
                    <h1 class="text-2xl font-bold text-zinc-900">{{ $order->order_number }}</h1>
                    <p class="text-sm text-zinc-500 mt-2">
                        Tracking: {{ $order->tracking_number }}
                    </p>
                </div>
                <div>
                    <span class="px-3 py-2 rounded-full bg-orange-50 text-orange-700 text-sm font-semibold">
                        {{ str_replace('_', ' ', ucfirst($order->status)) }}
                    </span>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-6 mt-6 border-t border-zinc-100 pt-6">
                <div>
                    <h2 class="font-bold text-zinc-900">Customer</h2>
                    <p class="text-sm text-zinc-600 mt-2">{{ $order->customer_name }}</p>
                    <p class="text-sm text-zinc-600">{{ $order->customer_email }}</p>
                    <p class="text-sm text-zinc-600">{{ $order->customer_phone }}</p>
                </div>

                <div>
                    <h2 class="font-bold text-zinc-900">Pickup location</h2>
                    <p class="text-sm text-zinc-600 mt-2">{{ $order->pickup_location_name }}</p>
                    <p class="text-sm text-zinc-600">{{ $order->pickup_location_address }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white border border-zinc-200 rounded-2xl p-6 mt-6">
            <h2 class="font-bold text-lg text-zinc-900">Items</h2>

            <div class="divide-y divide-zinc-100 mt-4">
                @foreach($order->items as $item)
                    <div class="py-4 flex justify-between gap-4">
                        <div>
                            <p class="font-semibold text-zinc-900">{{ $item->product_title }}</p>
                            <p class="text-sm text-zinc-500">
                                {{ $item->quantity }} × KES {{ number_format((float) $item->unit_price, 2) }}
                            </p>
                        </div>
                        <p class="font-semibold text-zinc-900">
                            KES {{ number_format((float) $item->line_total, 2) }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-zinc-200 pt-4 flex justify-between">
                <span class="font-bold">Total</span>
                <span class="font-bold text-xl">
                    KES {{ number_format((float) $order->total, 2) }}
                </span>
            </div>
        </div>

        @if(!$order->isTerminal())
            <div class="bg-white border border-zinc-200 rounded-2xl p-6 mt-6">
                <h2 class="font-bold text-lg text-zinc-900">Update order status</h2>

                <form action="{{ route('admin.orders.status', $order) }}"
                      method="POST"
                      class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="block text-sm font-semibold mb-2">
                            New status
                        </label>

                        <select name="status"
                                id="status"
                                required
                                class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm">
                            @foreach([
                                'confirmed',
                                'processing',
                                'ready_for_collection',
                                'completed'
                            ] as $status)
                                <option value="{{ $status }}">
                                    {{ str_replace('_', ' ', ucfirst($status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="note" class="block text-sm font-semibold mb-2">
                            Internal or customer-facing note
                        </label>
                        <textarea name="note"
                                  id="note"
                                  rows="3"
                                  maxlength="1000"
                                  class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm"></textarea>
                    </div>

                    <button type="submit"
                            class="rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3 text-sm font-semibold text-white">
                        Update status
                    </button>
                </form>
            </div>
        @endif

        @if($order->cancellation && $order->cancellation->status === 'requested')
            <div class="bg-white border border-red-200 rounded-2xl p-6 mt-6">
                <h2 class="font-bold text-lg text-zinc-900">Cancellation request</h2>

                <p class="text-sm text-zinc-600 mt-3">
                    {{ $order->cancellation->reason }}
                </p>

                <form action="{{ route('admin.orders.cancellation', $order) }}"
                      method="POST"
                      class="mt-5 space-y-4">
                    @csrf

                    <div>
                        <label for="admin_note" class="block text-sm font-semibold mb-2">
                            Response note
                        </label>
                        <textarea name="admin_note"
                                  id="admin_note"
                                  rows="3"
                                  maxlength="1000"
                                  class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm"></textarea>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button name="decision"
                                value="approve"
                                class="rounded-xl bg-red-600 hover:bg-red-700 px-5 py-3 text-sm font-semibold text-white">
                            Approve cancellation
                        </button>

                        <button name="decision"
                                value="reject"
                                class="rounded-xl border border-zinc-300 px-5 py-3 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                            Reject request
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div class="bg-white border border-zinc-200 rounded-2xl p-6 mt-6">
            <h2 class="font-bold text-lg text-zinc-900">Order history</h2>

            <div class="space-y-4 mt-4">
                @foreach($order->statusHistories as $history)
                    <div class="border-l-2 border-orange-400 pl-4">
                        <p class="font-semibold text-sm text-zinc-900">
                            {{ str_replace('_', ' ', ucfirst($history->status)) }}
                        </p>
                        <p class="text-xs text-zinc-500 mt-1">
                            {{ $history->note }}
                        </p>
                        <p class="text-xs text-zinc-400 mt-1">
                            {{ $history->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection