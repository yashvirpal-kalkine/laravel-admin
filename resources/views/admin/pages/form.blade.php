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
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-circle me-1"></i> Back to List</a>
    </div>
    <div class="card-body">
        <form action="{{ isset($page) && $page->exists ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($page) && $page->exists)
            @method('PUT')
            @endif

            <div class="row">
                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="parent_id">Parent Page</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">-- No Parent (Top Level) --</option>
                        <x-admin.tree-select :items="$parents" :selected="old('parent_id', $page->parent_id)" />
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="template">Template</label>
                    <select name="template" id="template" class="form-control">
                        <option value="">Select</option>
                        @foreach(config('settings.templates') as $key => $label)
                            <option value="{{ $key }}" {{ isset($page) && $page->template === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                
                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $page->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

               
                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $page->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control">
                    @if(isset($page) && $page->banner)
                        <img src="{{ image_url('banner' , $page->banner, 'small') }}" alt="Image" class="mt-2" width="50">
                    @endif
                    @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

               
                <div class="mb-3 col-md-6">
                    <label class="form-label">Alt Text</label>
                    <input type="text" name="alt" value="{{ old('alt', $page->alt ?? '') }}" class="form-control">
                    @error('alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
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

                
                {{-- <div class="mb-3 col-md-6">
                    <label class="form-label">SEO Image</label>
                    <input type="file" name="seo_image" class="form-control">
                    @if(isset($page) && $page->seo_image)
                        <img src="{{ asset('storage/' . $page->seo_image) }}" alt="{{ $page->meta_title ?? '' }}" class="img-thumbnail mt-2" width="150">
                    @endif
                    @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

               
                <div class="mb-3 col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="url" name="canonical_url" value="{{ old('canonical_url', $page->canonical_url ?? '') }}" class="form-control">
                    @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}
                 
                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="status" value="0"/>
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                            id="statusSwitch" {{ old('status', $page->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">{{ isset($page) && $page->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
@include('components.admin.datetimepicker')