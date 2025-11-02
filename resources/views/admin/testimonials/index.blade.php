@extends('layouts.admin')

@section('content')
    @php
        $title = 'Testimonial List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Testimonials' => ''
        ];
    @endphp
    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">

            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add New
            </a>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
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
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.testimonials.index') }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'designation', name: 'designation' },
                    { data: 'company', name: 'company' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'actions', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush