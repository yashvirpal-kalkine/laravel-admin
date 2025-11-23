@extends('layouts.admin')

@section('content')
    @php
        $title = 'Global Sections List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Global Sections' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.global-sections.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Global Section
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="globalSectionTable" class="table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Page</th>
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
    <link href="{{ asset('backend/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(function () {
            $('#globalSectionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.global-sections.index") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },

                    {
                        data: 'page',
                        name: 'page',
                        render: function (data) {
                            return data ? data.title : '<span class="text-muted">—</span>';
                        }
                    },

                    { data: 'status', name: 'status', orderable: false, searchable: false },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[1, 'asc']]
            });
        });
    </script>
@endpush