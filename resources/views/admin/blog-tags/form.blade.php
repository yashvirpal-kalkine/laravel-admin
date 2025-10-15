@extends('layouts.admin')

@section('content')
    @php
        $title = isset($blogtag) && $blogtag->exists ? 'Edit Blog Tag' : 'Create Blog Tag';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Blog Tags' => route('admin.blog-tags.index'),
            $title => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.blog-tags.index') }}" class="btn btn-primary btn-sm">+ Back to List</a>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($blogtag) && $blogtag->exists ? route('admin.blog-tags.update', $blogtag->id) : route('admin.blog-tags.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogtag) && $blogtag->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <!-- Title -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blogtag->title ?? '') }}"
                            class="form-control" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blogtag->slug ?? '') }}" class="form-control">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="2">{{ old('short_description', $blogtag->short_description ?? '') }}</textarea>
                        @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5">{{ old('description', $blogtag->description ?? '') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Banner -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner" class="form-control">
                        @if(isset($blogtag) && $blogtag->banner)
                            <img src="{{ asset('storage/' . $blogtag->banner) }}" alt="{{ $blogtag->alt ?? '' }}"
                                class="img-thumbnail mt-2" width="150">
                        @endif
                        @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Alt text -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Alt Text</label>
                        <input type="text" name="alt" value="{{ old('alt', $blogtag->alt ?? '') }}" class="form-control">
                        @error('alt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- SEO Fields -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $blogtag->meta_title ?? '') }}"
                            class="form-control">
                        @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $blogtag->meta_keywords ?? '') }}" class="form-control">
                        @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $blogtag->meta_description ?? '') }}</textarea>
                        @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3 col-md-6">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="status" value="published"
                                id="statusSwitch" {{ old('status', $blogtag->status ?? 'draft') === 'published' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusSwitch">Published</label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($blogtag) && $blogtag->exists ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog-tags.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection