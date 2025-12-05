@extends('layouts.admin')

@section('content')
@php
    $title = isset($category) && $category->exists ? 'Edit Product Category' : 'Create Product Category';
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.product-categories.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back To List
        </a>
    </div>

    <div class="card-body">
        <form
            action="{{ isset($category) && $category->exists ? route('admin.product-categories.update', $category->id) : route('admin.product-categories.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($category) && $category->exists)
                @method('PUT')
            @endif

            <div class="row">

                <div class="mb-3 col-md-12">
                    <label class="form-label">Parent Category</label>
                    <select name="parent_id" class="form-select select2">
                        <option value="">None</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $category->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" class="form-control">
                </div>


                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $category->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

               <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control">
                    @if(isset($category) && $category->banner)
                        <img src="{{ image_url('banner', $category->banner, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

              
                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Alt Text</label>
                    <input type="text" name="banner_alt" value="{{ old('banner_alt', $category->banner_alt ?? '') }}"
                        class="form-control">
                    @error('banner_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

               
                <div class="mb-3 col-md-6">
                    <label class="form-label"> Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($category) && $category->image)
                        <img src="{{ image_url('productcategory', $category->image, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label"> Alt Text</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $category->image_alt ?? '') }}"
                        class="form-control">
                    @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                {{-- <div class="mb-3 col-md-6">
                    <label class="form-label">SEO Image</label>
                    <input type="file" name="seo_image" class="form-control">
                    @if(isset($category) && $category->seo_image)
                        <img src="{{ image_url('seo_image', $category->seo_image, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="text" name="canonical_url" value="{{ old('canonical_url', $category->canonical_url ?? '') }}"
                        class="form-control">
                    @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Custom Field</label>
                    <input type="text" name="custom_field" value="{{ old('custom_field', $category->custom_field ?? '') }}"
                        class="form-control">
                    @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

               
                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}" class="form-control">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}" class="form-control">
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1" id="is_featured"
                               {{ old('is_featured', $category->is_featured ?? false) ? 'checked' : '' }}>
                        <label for="is_featured" class="form-check-label">Featured Category</label>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="status" value="0" />
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                            {{ old('status', $category->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($category) && $category->exists ? 'Update' : 'Create' }}
            </button>
        </form>
    </div>
</div>
@endsection

@include('components.admin.select2')
