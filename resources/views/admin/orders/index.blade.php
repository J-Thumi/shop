@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA] py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <div>
                <p class="text-sm font-semibold text-orange-600">SHOP MANAGEMENT</p>
                <h1 class="text-3xl font-bold text-zinc-900 mt-2">Orders</h1>
            </div>

            <form method="GET" action="{{ route('admin.orders.index') }}">
                <select name="status"
                        onchange="this.form.submit()"
                        class="rounded-xl border border-zinc-300 px-4 py-3 text-sm">
                    <option value="">All statuses</option>
                    @foreach([
                        'pending',
                        'confirmed',
                        'processing',
                        'ready_for_collection',
                        'completed',
                        'cancelled'
                    ] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ str_replace('_', ' ', ucfirst($status)) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-5 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-zinc-200 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-zinc-50 text-zinc-500">
                        <tr>
                            <th class="px-5 py-4">Order</th>
                            <th class="px-5 py-4">Customer</th>
                            <th class="px-5 py-4">Total</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Payment</th>
                            <th class="px-5 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-zinc-900">{{ $order->order_number }}</p>
                                    <p class="text-xs text-zinc-500 mt-1">
                                        {{ $order->created_at->format('d M Y') }}
                                    </p>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-medium text-zinc-900">{{ $order->customer_name }}</p>
                                    <p class="text-xs text-zinc-500">{{ $order->customer_email }}</p>
                                </td>
                                <td class="px-5 py-4 font-semibold">
                                    KES {{ number_format((float) $order->total, 2) }}
                                </td>
                                <td class="px-5 py-4">
                                    {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                </td>
                                <td class="px-5 py-4">
                                    {{ ucfirst($order->payment_status) }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="font-semibold text-orange-600 hover:text-orange-700">
                                        Manage →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-zinc-500">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">{{ $orders->links() }}</div>
    </div>
</div>
@endsection