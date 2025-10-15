@extends('layouts.admin')

@section('content')
@php
$title = isset($page) && $page->exists ? 'Edit Page' : 'Create Page';
$breadcrumbs = [
    'Home' => route('admin.dashboard'),
    'Pages' => route('admin.pages.index'),
    $title => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary btn-sm">+ Back to List</a>
    </div>
    <div class="card-body">
        <form action="{{ isset($page) && $page->exists ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($page) && $page->exists)
            @method('PUT')
            @endif

            <div class="row">
                <!-- Title -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Short Description -->
                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $page->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $page->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Banner -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control">
                    @if(isset($page) && $page->banner)
                        <img src="{{ asset('storage/' . $page->banner) }}" alt="{{ $page->alt ?? '' }}" class="img-thumbnail mt-2" width="150">
                    @endif
                    @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Alt text -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Alt Text</label>
                    <input type="text" name="alt" value="{{ old('alt', $page->alt ?? '') }}" class="form-control">
                    @error('alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- SEO Fields -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" class="form-control">
                    @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}" class="form-control">
                    @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                    @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- SEO Image -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">SEO Image</label>
                    <input type="file" name="seo_image" class="form-control">
                    @if(isset($page) && $page->seo_image)
                        <img src="{{ asset('storage/' . $page->seo_image) }}" alt="{{ $page->meta_title ?? '' }}" class="img-thumbnail mt-2" width="150">
                    @endif
                    @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Canonical URL -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="url" name="canonical_url" value="{{ old('canonical_url', $page->canonical_url ?? '') }}" class="form-control">
                    @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Status -->
                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="status" value="published" id="statusSwitch"
                            {{ old('status', $page->status ?? 'draft') === 'published' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Published</label>
                    </div>
                </div>

                <!-- Published At -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($page->published_at) ? $page->published_at->format('Y-m-d\TH:i') : '') }}" class="form-control">
                    @error('published_at') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary">{{ isset($page) && $page->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
