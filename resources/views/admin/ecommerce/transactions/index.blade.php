@extends('layouts.admin')

@section('content')
    @php
        $title = 'Transactions';
    @endphp
    <div class="card card-outline card-primary">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.transactions.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Transaction</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered align-middle">
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
                </table>
            </div>
        </div>

    </div>
@endsection



@push('styles')
    <!-- DataTables CSS -->
    <link href="{{ asset('backend/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route("admin.transactions.index") !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'order', name: 'order.order_number' },
                    { data: 'transaction_id', name: 'transaction_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'method', name: 'payment_method' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'date', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush