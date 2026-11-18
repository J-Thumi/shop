<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function getCart(User $user): Cart
    {
        return Cart::firstOrCreate(['user_id' => $user->id]);
    }

    public function add(User $user, int $productId, int $quantity = 1): void
    {
        $product = Product::find($productId);

        if (!$product) {
            throw ValidationException::withMessages([
                'product_id' => 'The selected product is unavailable.',
            ]);
        }

        $cart = $this->getCart($user);

        $item = $cart->items()->firstOrNew([
            'product_id' => $product->id,
        ]);

        $item->quantity = ($item->exists ? $item->quantity : 0) + $quantity;
        $item->save();
    }

    public function update(User $user, int $itemId, int $quantity): void
    {
        $cart = $this->getCart($user);

        $item = $cart->items()->whereKey($itemId)->firstOrFail();
        $item->update(['quantity' => $quantity]);
    }

    public function remove(User $user, int $itemId): void
    {
        $cart = $this->getCart($user);

        $cart->items()->whereKey($itemId)->delete();
    }

    public function clear(User $user): void
    {
        DB::transaction(function () use ($user) {
            $cart = $this->getCart($user);
            $cart->items()->delete();
        });
    }
}