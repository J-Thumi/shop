<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use App\Models\PickupLocation;
use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;
use App\Services\ProductPriceService;
class CheckoutController extends Controller
{
    

    public function index(
        Request $request,
        ProductPriceService $prices
    ): View|RedirectResponse {
        $cart = $request->user()
            ->cart()
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $locations = PickupLocation::where('is_active', true)
            ->orderBy('name')
            ->get();

        if ($locations->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'No pickup locations are currently available.');
        }

        return view('checkout.index', compact('cart', 'locations', 'prices'));
    }

    public function store(
        Request $request,
        CheckoutService $checkout
    ): RedirectResponse {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['nullable', 'string', 'max:30'],
            'pickup_location_id' => [
                'required',
                'integer',
                'exists:pickup_locations,id',
            ],
            'customer_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = $checkout->placeOrder($request->user(), $data);

        // Email failure must not undo a successfully placed order.
        try {
            Mail::to($order->customer_email)
                ->send(new OrderPlacedMail($order));
        } catch (Throwable $e) {
            Log::error('Order confirmation email failed.', [
                'order_id' => $order->id,
                'exception' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Your order has been placed successfully.');
    }
}