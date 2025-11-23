@extends('layouts.admin')

@section('content')
@php
$title = isset($slider) && $slider->exists ? 'Edit Slider' : 'Create Slider';
$breadcrumbs = [
    'Home' => route('admin.dashboard'),
    'Sliders' => route('admin.sliders.index'),
    $title => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ isset($slider) && $slider->exists ? route('admin.sliders.update', $slider->id) : route('admin.sliders.store') }}"
              method="POST" enctype="multipart/form-data">

            @csrf
            @if(isset($slider) && $slider->exists)
                @method('PUT')
            @endif

            <div class="row">

                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $slider->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle ?? '') }}" class="form-control">
                    @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $slider->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $slider->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Slider Image</label>
                    <input type="file" name="image" class="form-control">

                    @if(isset($slider) && $slider->image)
                        <img src="{{ image_url('slider', $slider->image, 'small') }}" class="mt-2" width="80" alt="Image">
                    @endif

                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Image Alt Text</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $slider->image_alt ?? '') }}" class="form-control">
                    @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text ?? '') }}" class="form-control">
                    @error('button_text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $slider->button_link ?? '') }}" class="form-control">
                    @error('button_link') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Position</label>
                    <input type="number" name="position" value="{{ old('position', $slider->position ?? 0) }}" class="form-control">
                    @error('position') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Custom Field</label>
                    <input type="text" name="custom_field" value="{{ old('custom_field', $slider->custom_field ?? '') }}" class="form-control">
                    @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                            id="statusSwitch" {{ old('status', $slider->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($slider) && $slider->exists ? 'Update' : 'Create' }}
            </button>

            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>
    </div>
</div>
@endsection

@include('components.admin.datetimepicker')
