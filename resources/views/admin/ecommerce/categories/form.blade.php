@extends('layouts.admin')

@section('content')
    @php
        $title = isset($blogcategory) && $blogcategory->exists ? 'Edit Blog Category' : 'Create Blog Category';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Blog Categories' => route('admin.blog-categories.index'),
            $title => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-primary btn-sm">+ Back to List</a>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($blogcategory) && $blogcategory->exists ? route('admin.blog-categories.update', $blogcategory->id) : route('admin.blog-categories.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogcategory) && $blogcategory->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <!-- Title -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blogcategory->title ?? '') }}"
                            class="form-control" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blogcategory->slug ?? '') }}"
                            class="form-control">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="2">{{ old('short_description', $blogcategory->short_description ?? '') }}</textarea>
                        @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5">{{ old('description', $blogcategory->description ?? '') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Banner -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner" class="form-control">
                        @if(isset($blogcategory) && $blogcategory->banner)
                            <img src="{{ asset('storage/' . $blogcategory->banner) }}" alt="{{ $blogcategory->alt ?? '' }}"
                                class="img-thumbnail mt-2" width="150">
                        @endif
                        @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Alt text -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Alt Text</label>
                        <input type="text" name="alt" value="{{ old('alt', $blogcategory->alt ?? '') }}"
                            class="form-control">
                        @error('alt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- SEO Fields -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title"
                            value="{{ old('meta_title', $blogcategory->meta_title ?? '') }}" class="form-control">
                        @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $blogcategory->meta_keywords ?? '') }}" class="form-control">
                        @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $blogcategory->meta_description ?? '') }}</textarea>
                        @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3 col-md-6">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="status" value="published"
                                id="statusSwitch" {{ old('status', $blogcategory->status ?? 'draft') === 'published' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusSwitch">Published</label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($blogcategory) && $blogcategory->exists ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection