<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        h2 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Invoice #{{ $transaction->transaction_id }}</h2>
    <p><strong>Date:</strong> {{ $transaction->created_at->format('Y-m-d') }}</p>

    <h4>Customer Details</h4>
    <p>
        Name: {{ $transaction->order->customer_name ?? '—' }}<br>
        Email: {{ $transaction->order->customer_email ?? '—' }}<br>
        Phone: {{ $transaction->order->customer_phone ?? '—' }}<br>
    </p>

    <h4>Order Details</h4>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->order->items ?? [] as $item)
                <tr>
                    <td>{{ $item->product->title ?? '—' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Summary</h4>
    <table>
        <tr>
            <th>Subtotal</th>
            <td class="text-right">
                ₹{{ number_format($transaction->order->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</td>
        </tr>

        @if(!empty($transaction->order->discount_amount))
            <tr>
                <th>Discount ({{ $transaction->order->coupon_code ?? '' }})</th>
                <td class="text-right">- ₹{{ number_format($transaction->order->discount_amount, 2) }}</td>
            </tr>
        @endif

        @if(!empty($transaction->order->tax_amount))
            <tr>
                <th>Tax</th>
                <td class="text-right">₹{{ number_format($transaction->order->tax_amount, 2) }}</td>
            </tr>
        @endif

        <tr>
            <th>Total</th>
            <td class="text-right">₹{{ number_format($transaction->order->total ?? $transaction->amount, 2) }}</td>
        </tr>

        <tr>
            <th>Paid Amount</th>
            <td class="text-right">₹{{ number_format($transaction->amount, 2) }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td class="text-right">{{ ucfirst($transaction->status) }}</td>
        </tr>
    </table>

    <p>Thank you for your purchase!</p>
</body>

</html>