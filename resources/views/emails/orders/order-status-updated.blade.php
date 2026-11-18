<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order update</title>
</head>
<body style="font-family: Arial, sans-serif; color: #18181b; line-height: 1.6;">
    <h2>Your order has been updated.</h2>

    <p>Hello {{ $order->customer_name }},</p>

    <p>There is an update to your order.</p>

    <p><strong>Order number:</strong> {{ $order->order_number }}</p>
    <p><strong>Tracking number:</strong> {{ $order->tracking_number }}</p>
    <p><strong>Current status:</strong> {{ str_replace('_', ' ', ucfirst($order->status)) }}</p>
    <p><strong>Payment status:</strong> {{ ucfirst($order->payment_status) }}</p>

    <p>Collection location: {{ $order->pickup_location_name }}</p>

    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>