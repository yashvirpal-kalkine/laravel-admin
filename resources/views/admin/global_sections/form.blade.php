@extends('layouts.admin')

@section('content')
@php
$title = isset($section) && $section->exists ? 'Edit Global Section' : 'Create Global Section';
$breadcrumbs = [
    'Home' => route('admin.dashboard'),
    'Global Sections' => route('admin.global-sections.index'),
    $title => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.global-sections.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ isset($section) && $section->exists 
                ? route('admin.global-sections.update', $section->id) 
                : route('admin.global-sections.store') }}"
            method="POST" enctype="multipart/form-data">

            @csrf
            @if(isset($section) && $section->exists)
                @method('PUT')
            @endif

            <div class="row">

                {{-- Title --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Slug --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $section->slug ?? '') }}" class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Page Dropdown --}}
                <div class="mb-3 col-md-12">
                    <label class="form-label">Select Page</label>
                    <select name="page_id" class="form-control">
                        <option value="">-- Select Page --</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id', $section->page_id ?? '') == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('page_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $section->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $section->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($section) && $section->image)
                        <img src="{{ image_url('global-sections', $section->image, 'small') }}" class="mt-2" width="70">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Image Alt --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Image Alt</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $section->image_alt ?? '') }}" class="form-control">
                    @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Button Text --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $section->button_text ?? '') }}" class="form-control">
                    @error('button_text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Button Link --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Button Link (Domain / URL)</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $section->button_link ?? '') }}" class="form-control">
                    @error('button_link') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Template --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Template Name</label>
                    <input type="text" name="template" value="{{ old('template', $section->template ?? '') }}" class="form-control">
                    @error('template') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Custom Field --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Custom Field</label>
                    <input type="text" name="custom_field" value="{{ old('custom_field', $section->custom_field ?? '') }}" class="form-control">
                    @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="status" value="0"/>
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                            id="statusSwitch" {{ old('status', $section->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($section) && $section->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.global-sections.index') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
@endsection
