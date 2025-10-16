@extends('layouts.admin')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Search by order or transaction" value="{{ $search ?? '' }}">
                <button class="btn btn-sm btn-primary ms-2">Search</button>
            </form>
            <a href="{{ route('admin.transactions.create') }}" class="btn btn-sm btn-primary">+ Add Transaction</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->order?->order_number ?? '—' }}</td>
                            <td>{{ $transaction->transaction_id ?? '—' }}</td>
                            <td>₹{{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ ucfirst($transaction->payment_method) ?? 'N/A' }}</td>
                            <td><span
                                    class="badge bg-{{ $transaction->status == 'success' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($transaction->status) }}</span>
                            </td>
                            <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.transactions.edit', $transaction->id) }}"
                                    class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
                                <a href="{{ route('admin.transactions.invoice', $transaction->id) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                                <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this transaction?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash text-white"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $transactions->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection