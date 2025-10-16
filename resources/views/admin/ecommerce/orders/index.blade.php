@extends('layouts.admin')

@section('content')
    @php
        $title = 'Orders List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Orders' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>{{ $title }}</h5>
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary btn-sm">+ Add Order</a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Search by order no or customer" value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
            </form>

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No.</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>
                                {{ $order->customer_name }}<br>
                                <small>{{ $order->customer_email }}</small>
                            </td>
                            <td>₹{{ number_format($order->total, 2) }}</td>
                            <td><span class="badge bg-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection