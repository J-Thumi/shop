<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use App\Services\ProductPriceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly ProductPriceService $prices
    ) {}

    public function index(Request $request): View
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id,
        ])->load('items.product');

        $subtotal = 0;

        foreach ($cart->items as $item) {
            if ($item->product) {
                $subtotal += $this->prices->getPrice($item->product)
                    * $item->quantity;
            }
        }

        return view('cart.index', [
            'cart' => $cart,
            'subtotal' => round($subtotal, 2),
            'prices' => $this->prices,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        $this->cartService->add(
            $request->user(),
            $data['product_id'],
            $data['quantity']
        );

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to your cart.');
    }

    public function update(Request $request, int $item): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        $this->cartService->update(
            $request->user(),
            $item,
            $data['quantity']
        );

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Request $request, int $item): RedirectResponse
    {
        $this->cartService->remove($request->user(), $item);

        return back()->with('success', 'Item removed from your cart.');
    }
}