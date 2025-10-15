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
        <div class="card-header d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.blog-posts.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or slug"
                    value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
            </form>
            <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary btn-sm">+ Add Post</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                @foreach($post->categories as $cat)
                                    <span class="badge bg-info">{{ $cat->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($post->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($post->status === 'draft')
                                    <span class="badge bg-secondary">Draft</span>
                                @else
                                    <span class="badge bg-warning">Archived</span>
                                @endif
                            </td>
                            <td>{{ $post->published_at ? $post->published_at->format('Y-m-d H:i') : '-' }}</td>
                            <td>{{ $post->author?->name ?? '-' }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil text-white"></i>
                                </a>
                                <form action="{{ route('admin.blog-posts.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this post?');">
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
                            <td colspan="9" class="text-center">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection