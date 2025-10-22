@extends('layouts.admin')

@section('content')
    @php
        $title = isset($tag) && $tag->exists ? 'Edit Product Tag' : 'Create Product Tag';
        $breadcrumbs = ['Home' => route('admin.dashboard'), 'Product Tags' => route('admin.product-tags.index'), $title => ''];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.product-tags.index') }}" class="btn btn-primary btn-sm">+ Back to List</a>
        </div>

        <div class="card-body">
            <form
                action="{{ isset($tag) && $tag->exists ? route('admin.product-tags.update', $tag->id) : route('admin.product-tags.store') }}"
                method="POST">
                @csrf
                @if(isset($tag) && $tag->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $tag->title ?? '') }}" class="form-control"
                            required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $tag->slug ?? '') }}" class="form-control">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="2">{{ old('short_description', $tag->short_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5">{{ old('description', $tag->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $tag->meta_title ?? '') }}"
                            class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $tag->meta_keywords ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $tag->meta_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Status</label>
                        <input type="hidden" name="status" value="0" />
                        <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" {{ old('status', $tag->status ?? true) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($tag) && $tag->exists ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    </div>
@endsection