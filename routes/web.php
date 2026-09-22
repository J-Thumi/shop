<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
// Public storefront routes
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');