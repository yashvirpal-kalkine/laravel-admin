@extends('layouts.admin')

@section('content')
    @php
        $title = 'Remedy Calculators List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Remedy Calculators' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.calculators.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Calculator
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            {{-- <th>Author</th>
                            <th>Created At</th> --}}
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
    <!-- DataTables JS -->
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.calculators.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                   // { data: 'author', name: 'author.name', orderable: false, searchable: false },
                   // { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ],
                order: [[1, 'desc']]
            });
        });
    </script>
@endpush