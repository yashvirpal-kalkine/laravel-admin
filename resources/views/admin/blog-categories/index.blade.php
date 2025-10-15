@extends('layouts.admin')

@section('content')
    @php
        $title = 'Blog Categories List';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Blog Categories' => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.blog-categories.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or slug"
                    value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
            </form>
            <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary btn-sm">+ Add Category</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if($category->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($category->status === 'draft')
                                    <span class="badge bg-secondary">Draft</span>
                                @else
                                    <span class="badge bg-warning">Archived</span>
                                @endif
                            </td>
                            <td>{{ $category->author?->name ?? '-' }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.blog-categories.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil text-white"></i>
                                </a>
                                <form action="{{ route('admin.blog-categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this category?');">
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
                            <td colspan="6" class="text-center">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection