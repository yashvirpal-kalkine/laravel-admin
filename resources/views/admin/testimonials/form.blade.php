@extends('layouts.admin')

@section('content')
@php
$title = $testimonial->exists ? 'Edit Testimonial' : 'Create Testimonial';
$breadcrumbs = [
    'Home' => route('admin.dashboard'),
    'Testimonials' => route('admin.testimonials.index'),
    $title => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($testimonial->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="form-control" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Designation</label>
                    <input type="text" name="designation" value="{{ old('designation', $testimonial->designation) }}" class="form-control">
                    @error('designation') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Company</label>
                    <input type="text" name="company" value="{{ old('company', $testimonial->company) }}" class="form-control">
                    @error('company') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($testimonial->image)
                        <img src="{{ image_url('testimonial' , $testimonial->image, 'small') }}" alt="Image" class="mt-2" width="50">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="mb-3 col-md-12">
                    <label class="form-label">Message <span class="text-danger">*</span></label>
                    <textarea name="message" rows="4" class="form-control" required>{{ old('message', $testimonial->message) }}</textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                            id="statusSwitch" {{ old('status', $testimonial->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ $testimonial->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
