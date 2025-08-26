{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Hello {{ $order->customer_name }},</h2>
    <p>Thank you for your order. Please find your invoice attached.</p>
    <p><strong>Invoice ID:</strong> {{ $invoice->invoice_number }}</p>
    <p><strong>Total Amount:</strong> {{ number_format($invoice->order->net_total) }} MMK</p>
    <p>We appreciate your business!</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LUXE Order Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #000;">Hello {{ $order->customer_name }},</h2>

    <p>Thank you for shopping with <strong>LUXE</strong>! We are excited to confirm your order.</p>

    <h3>Order Summary</h3>
    <p>
        <strong>Order Number:</strong> {{ $order->order_number }}<br>
        <strong>Order Date:</strong> {{ $order->created_at->format('F d, Y') }}<br>
        <strong>Total Amount:</strong> {{ number_format($order->total_amount) }} MMK
    </p>

    <h3>Shipping Address</h3>
    <p>
        {{ $order->customerAddress->name }}<br>
        {{ $order->customerAddress->address_detail }}<br>
        {{ $order->customerAddress->phone_number }}
    </p>

    <h3>Order Items</h3>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>
                {{ $item->stock->product->product_name }} - {{ $item->quantity }} x
                {{ number_format($item->sale_price) }} =
                {{ number_format($item->quantity * $item->sale_price) }} MMK
            </li>
        @endforeach
    </ul>

    <p>Your invoice is attached to this email for your records.</p>

    <p>We hope you enjoy your purchase! If you have any questions, please contact our support team at <a
            href="mailto:support@luxe.com">support@luxe.com</a>.</p>

    <p style="margin-top: 30px;">Best regards,<br>
        <strong>LUXE Team</strong>
    </p>
</body>

</html>
