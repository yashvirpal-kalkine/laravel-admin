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
    <div class="card-header d-flex justify-content-between align-items-center">
        <form action="{{ route('admin.pages.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or slug" value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
        </form>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">+ Add Page</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        @if($page->status === 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($page->status === 'draft')
                            <span class="badge bg-secondary">Draft</span>
                        @else
                            <span class="badge bg-warning">Archived</span>
                        @endif
                    </td>
                    <td>{{ $page->published_at ? $page->published_at->format('Y-m-d H:i') : '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Delete this page?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No pages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            {{ $pages->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
