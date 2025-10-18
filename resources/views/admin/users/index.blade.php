@extends('layouts.admin')

@section('content')
    @php
        $title = 'Users List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Users' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ $title }}</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">+ Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Addresses</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
@push('styles')
    <!-- DataTables CSS -->
    <link href="{{ asset('backend/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush
@push('scripts')
    <script>
        <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap5.min.js') }}"></script>



    $(function () {
    $('#usersTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admin.users.index') }}",
    columns: [
    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
    { data: 'name', name: 'name' },
    { data: 'email', name: 'email' },
    { data: 'phone', name: 'phone' },
    { data: 'addresses', name: 'addresses', orderable: false, searchable: false },
    { data: 'status', name: 'status', orderable: false, searchable: false },
    { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    order: [[1, 'asc']]
    });
    });
    </script>
@endpush