@extends('layouts.admin')

@section('content')
    @php
        $title = isset($order) && $order->exists ? 'Edit Order' : 'Create Order';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Orders' => route('admin.orders.index'),
            $title => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>

        <div class="card-body">
            <form
                action="{{ isset($order) && $order->exists ? route('admin.orders.update', $order->id) : route('admin.orders.store') }}"
                method="POST">
                @csrf
                @if(isset($order) && $order->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control"
                            value="{{ old('customer_name', $order->customer_name ?? '') }}" required>
                        @error('customer_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Customer Email</label>
                        <input type="email" name="customer_email" class="form-control"
                            value="{{ old('customer_email', $order->customer_email ?? '') }}" required>
                        @error('customer_email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Customer Phone</label>
                        <input type="text" name="customer_phone" class="form-control"
                            value="{{ old('customer_phone', $order->customer_phone ?? '') }}">
                        @error('customer_phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Shipping Address</label>
                        <textarea name="shipping_address"
                            class="form-control">{{ old('shipping_address', $order->shipping_address ?? '') }}</textarea>
                        @error('shipping_address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Billing Address</label>
                        <textarea name="billing_address"
                            class="form-control">{{ old('billing_address', $order->billing_address ?? '') }}</textarea>
                        @error('billing_address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected(old('status', $order->status ?? '') == $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr>
                <h5>Order Items</h5>
                <div id="order-items">
                    @php
                        $oldItems = old('items');

                        if (!$oldItems) {
                            // If editing, use order items, else default
                            $oldItems = isset($order) && $order->exists ? $order->items->toArray() : [['product_id' => '', 'quantity' => 1]];
                        }
                    @endphp
                    {{-- @php
                    $oldItems = old('items', $order->items->toArray() ?? [['product_id' => '', 'quantity' => 1]]);
                    @endphp --}}

                    @foreach($oldItems as $index => $item)
                        <div class="row mb-2 order-item-row">
                            <div class="col-md-6">
                                <label>Product</label>
                                <select name="items[{{ $index }}][product_id]" class="form-select" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $id => $title)
                                        <option value="{{ $id }}" @selected($item['product_id'] == $id)>{{ $title }}</option>
                                    @endforeach
                                </select>
                                @error("items.$index.product_id") <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Quantity</label>
                                <input type="number" name="items[{{ $index }}][quantity]" class="form-control"
                                    value="{{ $item['quantity'] ?? 1 }}" min="1" required>
                                @error("items.$index.quantity") <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm mb-3" id="add-item">+ Add Item</button>

                <hr>
                <h5>Transaction</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Transaction ID</label>
                        <input type="text" name="transaction[transaction_id]" class="form-control"
                            value="{{ old('transaction.transaction_id', $order->transaction->transaction_id ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Amount</label>
                        <input type="number" step="0.01" name="transaction[amount]" class="form-control"
                            value="{{ old('transaction.amount', $order->transaction->amount ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Payment Method</label>
                        <select name="transaction[payment_method]" class="form-select">
                            @foreach(['cash', 'card', 'upi', 'wallet'] as $pm)
                                <option value="{{ $pm }}" @selected(old('transaction.payment_method', $order->transaction->payment_method ?? '') == $pm)>{{ ucfirst($pm) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($order) && $order->exists ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let itemIndex = {{ count($oldItems) }};
            document.getElementById('add-item').addEventListener('click', function () {
                const container = document.getElementById('order-items');
                const row = document.createElement('div');
                row.classList.add('row', 'mb-2', 'order-item-row');
                row.innerHTML = `
                                    <div class="col-md-6">
                                        <label>Product</label>
                                        <select name="items[${itemIndex}][product_id]" class="form-select" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $id => $title)
                                                <option value="{{ $id }}">{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Quantity</label>
                                        <input type="number" name="items[${itemIndex}][quantity]" class="form-control" value="1" min="1" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                                    </div>
                                `;
                container.appendChild(row);
                itemIndex++;
            });

            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-item')) {
                    e.target.closest('.order-item-row').remove();
                }
            });
        </script>
    @endpush

@endsection