@extends('layouts.admin')

@section('content')
@php
$title = isset($product) && $product->exists ? 'Edit Product' : 'Create Product';
$breadcrumbs = ['Home' => route('admin.dashboard'), 'Products' => route('admin.products.index'), $title => ''];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-circle me-1"></i> Back To List</a>
    </div>

    <div class="card-body">
        <form action="{{ isset($product) && $product->exists ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST">
            @csrf
            @if(isset($product) && $product->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" class="form-control" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" class="form-control">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="form-control">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? 0) }}" class="form-control">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Discount Price</label>
                    <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $product->discount_price ?? '') }}" class="form-control">
                </div>                

                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Categories</label>
                    <select name="product_category_ids[]" class="form-select select2" multiple>
                        @foreach($categories as $id => $title)
                            <option value="{{ $id }}" @selected(in_array($id, old('product_category_ids', isset($product) ? $product->categories->pluck('id')->toArray() : [])))>{{ $title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Tags</label>
                    <select name="product_tag_ids[]" class="form-select select2" multiple>
                        @foreach($tags as $id => $title)
                            <option value="{{ $id }}" @selected(in_array($id, old('product_tag_ids', isset($product) ? $product->tags->pluck('id')->toArray() : [])))>{{ $title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}"
                            class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                    </div>

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_featured" value="0" />
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1" id="is_featured"
                               {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                        <label for="is_featured" class="form-check-label">Featured Product</label>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="status" value="0" />
                        <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" {{ old('status', $product->status ?? true) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($product) && $product->exists ? 'Update' : 'Create' }}</button>
        </form>
    </div>
</div>
@endsection
@include('components.admin.select2')
