<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PickupLocation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function __construct(
        private readonly ProductPriceService $prices
    ) {}

    public function placeOrder(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {
            $cart = $user->cart()
                ->with('items.product')
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Your cart is empty.',
                ]);
            }

            $location = PickupLocation::query()
                ->where('is_active', true)
                ->find($data['pickup_location_id']);

            if (!$location) {
                throw ValidationException::withMessages([
                    'pickup_location_id' => 'Please select a valid pickup location.',
                ]);
            }

            $preparedItems = [];
            $subtotal = 0;

            foreach ($cart->items as $cartItem) {
                $product = $cartItem->product;

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'One of the products in your cart is no longer available.',
                    ]);
                }

                $unitPrice = $this->prices->getPrice($product);
                $lineTotal = round($unitPrice * $cartItem->quantity, 2);

                $subtotal += $lineTotal;

                $preparedItems[] = [
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'product_image' => $product->image_path,
                    'unit_price' => $unitPrice,
                    'quantity' => $cartItem->quantity,
                    'line_total' => $lineTotal,
                ];
            }

            $subtotal = round($subtotal, 2);

            $order = Order::create([
                'user_id' => $user->id,
                'pickup_location_id' => $location->id,

                'customer_name' => $data['customer_name'],
                'customer_email' => $user->email,
                'customer_phone' => $data['customer_phone'] ?? null,

                'pickup_location_name' => $location->name,
                'pickup_location_address' => $location->address,
                'pickup_location_phone' => $location->phone,

                'order_number' => $this->uniqueReference('ORD'),
                'tracking_number' => $this->uniqueReference('TRK'),

                'status' => 'pending',
                'payment_method' => 'pay_on_collection',
                'payment_status' => 'unpaid',

                'subtotal' => $subtotal,
                'total' => $subtotal,

                'customer_note' => $data['customer_note'] ?? null,
                'placed_at' => now(),
            ]);

            $order->items()->createMany($preparedItems);

            $order->statusHistories()->create([
                'user_id' => $user->id,
                'status' => 'pending',
                'note' => 'Order placed successfully.',
            ]);

            $cart->items()->delete();

            return $order->load(['items', 'pickupLocation']);
        });
    }

    private function uniqueReference(string $prefix): string
    {
        do {
            $reference = $prefix . '-' . now()->format('ymd') . '-' .
                Str::upper(Str::random(8));
        } while (
            Order::where('order_number', $reference)->exists() ||
            Order::where('tracking_number', $reference)->exists()
        );

        return $reference;
    }
}