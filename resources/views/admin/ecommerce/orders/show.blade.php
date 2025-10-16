@extends('layouts.admin')

@section('content')
    @php
        $title = 'Order Details';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Orders' => route('admin.orders.index'),
            $title => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>{{ $title }}</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>

        <div class="card-body">
            <h6>Order Information</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th>Order Number</th>
                    <td>{{ $order->order_number }}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $order->customer_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $order->customer_email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $order->customer_phone }}</td>
                </tr>
                <tr>
                    <th>Shipping Address</th>
                    <td>{{ $order->shipping_address }}</td>
                </tr>
                <tr>
                    <th>Billing Address</th>
                    <td>{{ $order->billing_address }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><span class="badge bg-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td>₹{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>₹{{ number_format($order->tax, 2) }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>₹{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>

            <h6>Order Items</h6>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->title ?? '-' }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h6>Transaction</h6>
            @if($order->transaction)
                <table class="table table-bordered">
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $order->transaction->transaction_id }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>₹{{ number_format($order->transaction->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ ucfirst($order->transaction->payment_method) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($order->transaction->status) }}</td>
                    </tr>
                </table>
            @else
                <p>No transaction recorded.</p>
            @endif
        </div>
    </div>
@endsection