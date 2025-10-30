@extends('layouts.admin')

@section('content')
@php
    $title = isset($blogcategory) && $blogcategory->exists ? 'Edit Blog Category' : 'Create Blog Category';
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back To List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ isset($blogcategory) && $blogcategory->exists ? route('admin.blog-categories.update', $blogcategory->id) : route('admin.blog-categories.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($blogcategory) && $blogcategory->exists)
                @method('PUT')
            @endif

            <div class="row">
                
                <div class="mb-3 col-md-12">
                    <label class="form-label">Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- None (Root Category) --</option>
                        <x-admin.tree-select :items="$parents" :selected="old('parent_id', $blogcategory->parent_id)" />


                    </select>
                    @error('parent_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $blogcategory->title ?? '') }}"
                        class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $blogcategory->slug ?? '') }}"
                        class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

               
                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $blogcategory->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $blogcategory->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control">
                    @if(isset($blogcategory) && $blogcategory->banner)
                        <img src="{{ image_url('banner', $blogcategory->banner, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

              
                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Alt Text</label>
                    <input type="text" name="banner_alt" value="{{ old('banner_alt', $blogcategory->banner_alt ?? '') }}"
                        class="form-control">
                    @error('banner_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

               
                <div class="mb-3 col-md-6">
                    <label class="form-label"> Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($blogcategory) && $blogcategory->image)
                        <img src="{{ image_url('blogcategory', $blogcategory->image, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label"> Alt Text</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $blogcategory->image_alt ?? '') }}"
                        class="form-control">
                    @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                {{-- <div class="mb-3 col-md-6">
                    <label class="form-label">SEO Image</label>
                    <input type="file" name="seo_image" class="form-control">
                    @if(isset($blogcategory) && $blogcategory->seo_image)
                        <img src="{{ image_url('seo_image', $blogcategory->seo_image, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="text" name="canonical_url" value="{{ old('canonical_url', $blogcategory->canonical_url ?? '') }}"
                        class="form-control">
                    @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Custom Field</label>
                    <input type="text" name="custom_field" value="{{ old('custom_field', $blogcategory->custom_field ?? '') }}"
                        class="form-control">
                    @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

               
                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $blogcategory->meta_title ?? '') }}" class="form-control">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $blogcategory->meta_keywords ?? '') }}" class="form-control">
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $blogcategory->meta_description ?? '') }}</textarea>
                </div>

               
                <div class="mb-3 col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label><br>
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch"
                        {{ old('status', $blogcategory->status ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusSwitch">Active</label>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">{{ isset($blogcategory) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
@endsection
