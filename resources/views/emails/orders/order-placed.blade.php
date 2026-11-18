<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order received</title>
</head>
<body style="font-family: Arial, sans-serif; color: #18181b; line-height: 1.6;">
    <h2>Thank you for your order, {{ $order->customer_name }}.</h2>

    <p>We have received your order and will begin processing it shortly.</p>

    <p><strong>Order number:</strong> {{ $order->order_number }}</p>
    <p><strong>Tracking number:</strong> {{ $order->tracking_number }}</p>
    <p><strong>Status:</strong> {{ str_replace('_', ' ', ucfirst($order->status)) }}</p>

    <h3>Items</h3>

    <table width="100%" cellpadding="8" cellspacing="0" border="1"
           style="border-collapse: collapse; border-color: #e4e4e7;">
        <thead>
            <tr>
                <th align="left">Product</th>
                <th align="center">Quantity</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_title }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="right">KES {{ number_format((float) $item->line_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Collection details</h3>
    <p><strong>{{ $order->pickup_location_name }}</strong></p>
    <p>{{ $order->pickup_location_address }}</p>

    @if ($order->pickup_location_phone)
        <p>Contact: {{ $order->pickup_location_phone }}</p>
    @endif

    <p><strong>Total:</strong> KES {{ number_format((float) $order->total, 2) }}</p>
    <p><strong>Payment:</strong> Pay when collecting your order.</p>

    <p>You can view your order and its progress from your account.</p>

    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>