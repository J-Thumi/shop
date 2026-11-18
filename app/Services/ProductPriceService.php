<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Validation\ValidationException;

class ProductPriceService
{
    public function getPrice(Product $product): float
    {
        $regular = $this->toAmount($product->regular_price);

        $sale = $product->sale_price !== null
            ? $this->toAmount($product->sale_price)
            : null;

        if ($regular < 0 || ($sale !== null && $sale < 0)) {
            throw ValidationException::withMessages([
                'product' => 'This product has an invalid price.',
            ]);
        }

        if ($sale !== null && $sale > 0 && $sale < $regular) {
            return $sale;
        }

        return $regular;
    }

    private function toAmount(mixed $value): float
    {
        if (!is_numeric($value)) {
            throw ValidationException::withMessages([
                'product' => 'This product has an invalid price.',
            ]);
        }

        return round((float) $value, 2);
    }
}