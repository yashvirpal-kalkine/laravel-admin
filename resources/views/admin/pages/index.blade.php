@extends('layouts.admin')

@section('content')
    @php
        $title = 'Pages List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Pages' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">+ Add Page</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="pagesTable" class="table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            {{-- <th>Published At</th> --}}
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
        $('#pagesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.pages.index") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'slug', name: 'slug' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
               // { data: 'published_at', name: 'published_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[4, 'desc']]
        });
    });
</script>
@endpush