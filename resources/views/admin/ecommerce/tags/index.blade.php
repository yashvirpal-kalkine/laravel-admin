@extends('layouts.admin')

@section('content')
    @php
        $title = 'Product Tags';
        $breadcrumbs = ['Home' => route('admin.dashboard'), 'Product Tags' => ''];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.product-tags.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or slug"
                    value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
            </form>
            <a href="{{ route('admin.product-tags.create') }}" class="btn btn-primary btn-sm">+ Add Tag</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
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
                    @forelse($tags as $tag)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tag->title }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                @if($tag->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($tag->status === 'draft')
                                    <span class="badge bg-secondary">Draft</span>
                                @else
                                    <span class="badge bg-warning">Archived</span>
                                @endif
                            </td>
                            <td>{{ $tag->author?->name ?? '-' }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.product-tags.edit', $tag->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.product-tags.destroy', $tag->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this tag?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No tags found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $tags->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection