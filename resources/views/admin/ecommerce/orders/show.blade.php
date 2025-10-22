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
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-circle me-1"></i> Back To List</a>
        </div>

        <div class="card-body">
            <h4>Order Information</h4>
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
                    <td>
                        @php
                            $color = match ($order->status) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{  $color }} text-capitalize px-3 py-2">{{ $order->status }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td>{{ currencyformat($order->subtotal) }}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>{{ currencyformat($order->tax) }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{ currencyformat($order->total) }}</td>
                </tr>
            </table>

            <h4>Order Items</h4>
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
                            <td>{{ currencyformat($item->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ currencyformat($item->total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Transaction</h4>
            @if($order->transaction)
                <table class="table table-bordered">
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $order->transaction->transaction_id }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ currencyformat($order->transaction->amount) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ ucfirst($order->transaction->payment_method) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @php
                                $color = match ($order->status) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp

                            <span class="badge bg-{{  $color }} text-capitalize px-3 py-2">
                                {{ ucfirst($order->transaction->status) }}
                            </span>

                        </td>
                    </tr>
                </table>
            @else
                <p>No transaction recorded.</p>
            @endif
        </div>
    </div>
@endsection