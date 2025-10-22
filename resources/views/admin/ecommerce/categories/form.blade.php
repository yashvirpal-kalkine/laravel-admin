@extends('layouts.admin')

@section('content')
    @php
        $title = isset($category) && $category->exists ? 'Edit Product Category' : 'Create Product Category';
        $breadcrumbs = ['Home' => route('admin.dashboard'), 'Product Categories' => route('admin.product-categories.index'), $title => ''];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.product-categories.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-circle me-1"></i> Back To List</a>
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
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $category->title ?? '') }}"
                            class="form-control" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}"
                            class="form-control">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Parent Category</label>
                        <select name="parent_id" class="form-select select2">
                            <option value="">None</option>
                            @foreach($parents as $id => $title)
                                <option value="{{ $id }}" {{ old('parent_id', $category->parent_id ?? '') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="2">{{ old('short_description', $category->short_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5">{{ old('description', $category->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Banner</label>
                        <input type="file" name="banner" class="form-control">
                        @if(isset($category) && $category->banner)
                            <img src="{{ asset('storage/' . $category->banner) }}" alt="{{ $category->alt ?? '' }}"
                                class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Alt Text</label>
                        <input type="text" name="alt" value="{{ old('alt', $category->alt ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}"
                            class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-check form-switch mb-3">
                            <input type="hidden" name="status" value="0" />
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" {{ old('status', $category->status ?? true) ? 'checked' : '' }} />
                            <label class="form-check-label" for="statusSwitch">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($category) && $category->exists ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    </div>
@endsection
@include('components.admin.select2')
