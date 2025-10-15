@extends('layouts.admin')

@section('content')
    @php
        $title = isset($blogpost) && $blogpost->exists ? 'Edit Blog Post' : 'Create Blog Post';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Blog Posts' => route('admin.blog-posts.index'),
            $title => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-primary btn-sm">+ Back to List</a>
        </div>

        <div class="card-body">
            <form
                action="{{ isset($blogpost) && $blogpost->exists ? route('admin.blog-posts.update', $blogpost->id) : route('admin.blog-posts.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogpost) && $blogpost->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <!-- Title & Slug -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blogpost->title ?? '') }}"
                            class="form-control" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blogpost->slug ?? '') }}"
                            class="form-control">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Categories & Tags -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Categories</label>
                        <select name="categories[]" class="form-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($blogpost) && $blogpost->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Tags</label>
                        <select name="tags[]" class="form-select" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ isset($blogpost) && $blogpost->tags->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Short Description & Description -->
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="2">{{ old('short_description', $blogpost->short_description ?? '') }}</textarea>
                        @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5">{{ old('description', $blogpost->description ?? '') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Banner & Alt -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Banner</label>
                        <input type="file" name="banner" class="form-control">
                        @if(isset($blogpost) && $blogpost->banner)
                            <img src="{{ asset('storage/' . $blogpost->banner) }}" alt="{{ $blogpost->alt ?? '' }}"
                                class="img-thumbnail mt-2" width="150">
                        @endif
                        @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Alt Text</label>
                        <input type="text" name="alt" value="{{ old('alt', $blogpost->alt ?? '') }}" class="form-control">
                        @error('alt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- SEO Fields -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $blogpost->meta_title ?? '') }}"
                            class="form-control">
                        @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $blogpost->meta_keywords ?? '') }}" class="form-control">
                        @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $blogpost->meta_description ?? '') }}</textarea>
                        @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Status & Published At -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" {{ old('status', $blogpost->status ?? '') === 'draft' ? 'selected' : '' }}>
                                Draft</option>
                            <option value="published" {{ old('status', $blogpost->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $blogpost->status ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', isset($blogpost->published_at) ? $blogpost->published_at->format('Y-m-d\TH:i') : '') }}"
                            class="form-control">
                        @error('published_at') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($blogpost) && $blogpost->exists ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection