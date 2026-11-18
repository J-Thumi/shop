<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdatedMail;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class AdminOrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with('user')
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load([
            'items',
            'user',
            'statusHistories.user',
            'cancellation.requester',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(
        Request $request,
        Order $order,
        OrderService $service
    ): RedirectResponse {
        $data = $request->validate([
            'status' => [
                'required',
                'in:confirmed,processing,ready_for_collection,completed',
            ],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $service->updateStatus(
            $order,
            $data['status'],
            $request->user(),
            $data['note'] ?? null
        );

        $order->refresh();

        try {
            Mail::to($order->customer_email)
                ->send(new OrderStatusUpdatedMail($order));
        } catch (Throwable $e) {
            Log::error('Order status email failed.', [
                'order_id' => $order->id,
                'exception' => $e->getMessage(),
            ]);
        }

        return back()->with('success', 'Order status updated.');
    }

    public function reviewCancellation(
        Request $request,
        Order $order,
        OrderService $service
    ): RedirectResponse {
        $data = $request->validate([
            'decision' => ['required', 'in:approve,reject'],
            'admin_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $service->reviewCancellation(
            $order,
            $request->user(),
            $data['decision'] === 'approve',
            $data['admin_note'] ?? null
        );

        $order->refresh();

        try {
            Mail::to($order->customer_email)
                ->send(new OrderStatusUpdatedMail($order));
        } catch (Throwable $e) {
            Log::error('Cancellation decision email failed.', [
                'order_id' => $order->id,
                'exception' => $e->getMessage(),
            ]);
        }

        return back()->with('success', 'Cancellation decision saved.');
    }
}