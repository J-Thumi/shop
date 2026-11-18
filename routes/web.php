<?php

use App\Http\Controllers\Auth\EmailOtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\Admin\AdminOrderController;


// Guest Routes
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:10,1');

    // Registration
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])
        ->middleware('throttle:5,1');

    // OTP Verification
    Route::get('/verify-otp', [EmailOtpController::class, 'create'])
        ->name('otp.create');

    Route::post('/verify-otp', [EmailOtpController::class, 'store'])
        ->name('otp.verify')
        ->middleware('throttle:10,1');

    Route::post('/verify-otp/resend', [EmailOtpController::class, 'resend'])
        ->name('otp.resend')
        ->middleware('throttle:5,1');

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('password.email')
        ->middleware('throttle:5,1');

    // Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'store'])
        ->name('password.update')
        ->middleware('throttle:5,1');
});
// Google Authentication
Route::prefix('auth/google')->name('google.')->group(function () {

    Route::get('/redirect', [
        \App\Http\Controllers\Auth\GoogleController::class,
        'redirect'
    ])->name('redirect');

    Route::get('/callback', [
        \App\Http\Controllers\Auth\GoogleController::class,
        'callback'
    ])->name('callback');

    // Complete registration for new Google users
    Route::get('/complete', [
        \App\Http\Controllers\Auth\GoogleController::class,
        'complete'
    ])->name('complete');

    Route::post('/complete', [
        \App\Http\Controllers\Auth\GoogleController::class,
        'store'
    ])->name('complete.store')
      ->middleware('throttle:5,1');
});
// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});

Route::view('/terms', 'legal.terms')->name('legal.terms');
Route::view('/privacy', 'legal.privacy')->name('legal.privacy');
Route::view('/contact', 'legal.contact')->name('legal.contact');


// Public storefront routes
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');



// Customer ecommerce routes
Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');

    Route::patch('/cart/{item}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{item}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('checkout.store');

    // Customer orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->whereNumber('order')
        ->name('orders.show');

    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])
        ->whereNumber('order')
        ->name('orders.cancel');

    Route::get('/track-order/{tracking}', [OrderTrackingController::class, 'show'])
        ->name('orders.track');
});

// Administrator routes.
// Define the "manage-orders" authorization ability for your admin users.
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{order}/status', [
            AdminOrderController::class,
            'updateStatus',
        ])->name('orders.status');

        Route::post('/orders/{order}/cancellation', [
            AdminOrderController::class,
            'reviewCancellation',
        ])->name('orders.cancellation');
    });