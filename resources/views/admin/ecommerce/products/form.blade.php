@extends('layouts.admin')

@section('content')
@php
    $isEdit = isset($product) && $product->exists;
    $title = $isEdit ? 'Edit Product' : 'Create Product';
    $breadcrumbs = [
        'Home' => route('admin.dashboard'),
        'Products' => route('admin.products.index'),
        $title => ''
    ];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back To List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ $isEdit ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="row">

                <div class="mb-3 col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="form-control">
                    @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Brand --}}
                {{-- <div class="mb-3 col-md-6">
                    <label class="form-label">Brand</label>
                    <select name="brand_id" class="form-select">
                        <option value="">-- Select Brand --</option>
                        @foreach($brands as $id => $name)
                            <option value="{{ $id }}" @selected(old('brand_id', $product->brand_id ?? '') == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <div class="mb-3 col-md-6">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control">
                    @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Regular Price</label>
                    <input type="number" step="0.01" name="regular_price" value="{{ old('regular_price', $product->regular_price ?? 0) }}" class="form-control">
                    @error('regular_price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Sale Price</label>
                    <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}" class="form-control">
                    @error('sale_price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control">
                    @if($isEdit && $product->banner)
                        <img src="{{ image_url('banner', $product->banner, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Alt</label>
                    <input type="text" name="banner_alt" value="{{ old('banner_alt', $product->banner_alt ?? '') }}" class="form-control">
                    @error('banner_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($isEdit && $product->image)
                        <img src="{{ image_url('product', $product->image, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Image Alt</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $product->image_alt ?? '') }}" class="form-control">
                    @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Gallery Images</label>
                    <input type="file" name="gallery[]" class="form-control" multiple>
                    @error('gallery') <small class="text-danger d-block">{{ $message }}</small> @enderror
                    @error('gallery.*') <small class="text-danger d-block">{{ $message }}</small> @enderror

                    @if($isEdit && $product->galleries->count())
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($product->galleries as $img)
                                <div class="text-center">
                                    <img src="{{ image_url('product_gallery', $img->image, 'small') }}" width="80" class="img-thumbnail mb-1">
                                    <div>
                                        <label class="small text-muted">
                                            <input type="checkbox" name="remove_gallery[]" value="{{ $img->id }}"> Remove
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @php
                function renderCategoryOptions($categories, $selectedIds = [], $prefix = '') {
                    foreach ($categories as $category) {
                        $isSelected = in_array($category->id, $selectedIds) ? 'selected' : '';
                        echo "<option value='{$category->id}' {$isSelected}>{$prefix}{$category->title}</option>";

                        if ($category->children->isNotEmpty()) {
                            renderCategoryOptions($category->children, $selectedIds, $prefix . '— ');
                        }
                    }
                }
                @endphp

                @php
                $selectedCategories = old('product_category_ids', isset($product) ? $product->categories->pluck('id')->toArray() : []);
                @endphp

                <div class="mb-3 col-md-6">
                    <label class="form-label">Categories</label>
                    <select name="product_category_ids[]" class="form-select select2" multiple>
                        @php renderCategoryOptions($categories, $selectedCategories); @endphp
                    </select>
                    @error('product_category_ids') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label">Tags</label>
                    <select name="product_tag_ids[]" class="form-select select2" multiple>
                        @foreach($tags as $id => $title)
                            <option value="{{ $id }}" @selected(in_array($id, old('product_tag_ids', $isEdit ? $product->tags->pluck('id')->toArray() : [])))>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_tag_ids') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}" class="form-control">
                    @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" class="form-control">
                    @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                    @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- <div class="mb-3 col-md-6">
                    <label class="form-label">SEO Image</label>
                    <input type="file" name="seo_image" class="form-control">
                    @if($isEdit && $product->seo_image)
                        <img src="{{ image_url('seo', $product->seo_image, 'small') }}" class="mt-2" width="60">
                    @endif
                    @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="text" name="canonical_url" value="{{ old('canonical_url', $product->canonical_url ?? '') }}" class="form-control">
                    @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Custom Field</label>
                    <input type="text" name="custom_field" value="{{ old('custom_field', $product->custom_field ?? '') }}" class="form-control">
                    @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1" id="is_featured"
                               {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                        <label for="is_featured" class="form-check-label">Featured Product</label>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch"
                               {{ old('status', $product->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Update Product' : 'Create Product' }}
            </button>
        </form>
    </div>
</div>
@endsection

@include('components.admin.select2')
