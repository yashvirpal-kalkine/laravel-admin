@extends('layouts.admin')

@section('content')
    @php
        $title = 'Blog Posts List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Blog Posts' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary btn-sm">+ Add Post</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="postsTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Categories</th>
                            <th>Tags</th>
                            <th>Status</th>
                            {{-- <th>Published At</th> --}}
                            {{-- <th>Author</th> --}}
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
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function () {
            $('#postsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.blog-posts.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },
                    { data: 'categories', name: 'categories.title', orderable: false, searchable: false },
                    { data: 'tags', name: 'tags.title', orderable: false, searchable: false },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                   // { data: 'published_at', name: 'published_at' },
                    //{ data: 'author', name: 'author.name' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ],
                order: [[6, 'desc']]
            });
        });
    </script>
@endpush