@extends('layouts.admin')

@section('content')
    @php
        $title = 'Product Categories';
        $breadcrumbs = ['Home' => route('admin.dashboard'), 'Product Categories' => ''];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Category</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                ajax: '{!! route("admin.product-categories.index") !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'parent', name: 'parent.title' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush