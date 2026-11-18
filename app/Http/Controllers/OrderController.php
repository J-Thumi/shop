<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = $request->user()
            ->orders()
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, int $order): View
    {
        $order = $request->user()
            ->orders()
            ->with(['items', 'statusHistories', 'cancellation'])
            ->findOrFail($order);

        return view('orders.show', compact('order'));
    }

    public function cancel(
        Request $request,
        int $order,
        OrderService $service
    ): RedirectResponse {
        $data = $request->validate([
            'reason' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $order = $request->user()
            ->orders()
            ->findOrFail($order);

        $result = $service->cancelByCustomer(
            $order,
            $request->user(),
            $data['reason']
        );

        if ($result === 'cancelled') {
            return back()->with(
                'success',
                'Your order has been cancelled.'
            );
        }

        return back()->with(
            'success',
            'Your cancellation request has been submitted for review.'
        );
    }
}