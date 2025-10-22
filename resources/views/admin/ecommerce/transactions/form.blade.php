@extends('layouts.admin')

@section('content')
    @php
        $title = isset($transaction) ? 'Edit Transaction' : 'Add Transaction';
    @endphp

    <div class="card card-outline card-primary">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary btn-sm">← Back</a>
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ isset($transaction) ? route('admin.transactions.update', $transaction->id) : route('admin.transactions.store') }}">
                @csrf
                @isset($transaction) @method('PUT') @endisset

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Order</label>
                        <select name="order_id" class="form-control" required>
                            <option value="">Select Order</option>
                            @foreach($orders as $id => $orderNo)
                                <option value="{{ $id }}" {{ old('order_id', $transaction->order_id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $orderNo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Transaction ID</label>
                        <input type="text" name="transaction_id"
                            value="{{ old('transaction_id', $transaction->transaction_id ?? '') }}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Amount</label>
                        <input type="number" step="0.01" name="amount"
                            value="{{ old('amount', $transaction->amount ?? '') }}" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Payment Method</label>
                        <input type="text" name="payment_method"
                            value="{{ old('payment_method', $transaction->payment_method ?? '') }}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @foreach(['pending', 'success', 'failed', 'refunded'] as $status)
                                <option value="{{ $status }}" {{ old('status', $transaction->status ?? '') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Response (JSON / Notes)</label>
                        <textarea name="response" rows="3"
                            class="form-control">{{ old('response', $transaction->response ?? '') }}</textarea>
                    </div>
                </div>

                <button class="btn btn-primary">{{ isset($transaction) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection