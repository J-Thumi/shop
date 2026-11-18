<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderTrackingController extends Controller
{
    public function show(Request $request, string $tracking): View
    {
        $order = $request->user()
            ->orders()
            ->with(['items', 'statusHistories'])
            ->where('tracking_number', $tracking)
            ->firstOrFail();

        return view('orders.tracking', compact('order'));
    }
}