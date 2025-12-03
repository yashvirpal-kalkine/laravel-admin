@extends('layouts.admin')

@section('content')
    @php
        $title = 'Sliders List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Sliders' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Slider
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="slidersTable" class="table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Status</th>
                            <th>Position</th>
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
            $('#slidersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.sliders.index") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'subtitle', name: 'subtitle' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'position', name: 'position' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[5, 'asc']]
            });
        });
    </script>
@endpush