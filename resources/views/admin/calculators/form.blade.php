@extends('layouts.admin')

@section('content')
@php
$title = isset($calculator) && $calculator->exists ? 'Edit Remedy Calculator' : 'Create Remedy Calculator';
$breadcrumbs = [
    'Home' => route('admin.dashboard'),
    'Remedy Calculators' => route('admin.calculators.index'),
    $title => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.calculators.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ isset($calculator) && $calculator->exists 
                            ? route('admin.calculators.update', $calculator->id) 
                            : route('admin.calculators.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($calculator) && $calculator->exists)
                @method('PUT')
            @endif

            <div class="row">

                <div class="mb-3 col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $calculator->title ?? '') }}" class="form-control" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $calculator->slug ?? '') }}" class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="form_type" class="form-label">Form Type</label>
                    <select name="form_type" id="form_type" class="form-select">
                        <option value="">-- Select Form Type --</option>
                        @foreach ($formTypes as $key => $label)
                            <option value="{{ $key }}" @selected(old('form_type') == $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $calculator->short_description ?? '') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $calculator->description ?? '') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control">
                    @if(isset($calculator) && $calculator->banner)
                        <img src="{{ image_url('banner', $calculator->banner, 'small') }}" 
                             alt="{{ $calculator->banner_alt ?? 'Banner' }}" class="mt-2 rounded" width="60">
                    @endif
                    @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Banner Alt</label>
                    <input type="text" name="banner_alt" value="{{ old('banner_alt', $calculator->banner_alt ?? '') }}" class="form-control">
                    @error('banner_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($calculator) && $calculator->image)
                        <img src="{{ image_url('calculator', $calculator->image, 'small') }}" 
                             alt="{{ $calculator->image_alt ?? 'Image' }}" class="mt-2 rounded" width="60">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Image Alt</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $calculator->image_alt ?? '') }}" class="form-control">
                    @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <h5 class="border-bottom pb-2">SEO Details</h5>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $calculator->meta_title ?? '') }}" class="form-control">
                    @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $calculator->meta_keywords ?? '') }}" class="form-control">
                    @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $calculator->meta_description ?? '') }}</textarea>
                    @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- <div class="mb-3 col-md-6">
                    <label class="form-label">SEO Image</label>
                    <input type="file" name="seo_image" class="form-control">
                    @if(isset($calculator) && $calculator->seo_image)
                        <img src="{{ image_url('seo', $calculator->seo_image, 'small') }}" 
                             alt="SEO" class="mt-2 rounded" width="60">
                    @endif
                    @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="text" name="canonical_url" value="{{ old('canonical_url', $calculator->canonical_url ?? '') }}" class="form-control">
                    @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Custom Field</label>
                    <input type="text" name="custom_field" value="{{ old('custom_field', $calculator->custom_field ?? '') }}" class="form-control">
                    @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <div class="mb-3 col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="status" value="0"/>
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                               id="statusSwitch" {{ old('status', $calculator->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>

            </div>

            <div class="mb-3 col-md-12">
                <div class="card m-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                         <h4 class="p-2">FAQs</h4>
                        
                    </div>
                    <div class="card-body" id="faqContainer">
                        @php
                            $faqs = old('faqs', $calculator->faqs ?? []);
                        @endphp

                        @forelse ($faqs as $index => $faq)
                            <div class="faq-item border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Question</label>
                                    <input type="text" name="faqs[{{ $index }}][question]" class="form-control"
                                        value="{{ $faq['question'] ?? '' }}" placeholder="Enter question" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Answer</label>
                                    <textarea name="faqs[{{ $index }}][answer]" class="form-control" rows="3" placeholder="Enter answer">{{ $faq['answer'] ?? '' }}</textarea>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-faq">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                    <button type="button" id="addFaq" class="btn btn-sm btn-primary ms-auto col-md-1 m-1">
                        <i class="bi bi-plus-circle me-1"></i> Add FAQ
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($calculator) && $calculator->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.calculators.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

@include('components.admin.datetimepicker')
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let faqIndex = {{ isset($faqs) ? count($faqs) : 0 }};

    document.getElementById('addFaq').addEventListener('click', function () {
        const container = document.getElementById('faqContainer');

        const html = `
            <div class="faq-item border rounded p-3 mb-3">
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" name="faqs[${faqIndex}][question]" class="form-control" placeholder="Enter question" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea name="faqs[${faqIndex}][answer]" class="form-control" rows="3" placeholder="Enter answer"></textarea>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-faq">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        faqIndex++;
    });

    // Remove FAQ item
    document.getElementById('faqContainer').addEventListener('click', function (e) {
        if (e.target.closest('.remove-faq')) {
            e.target.closest('.faq-item').remove();
        }
    });
});
</script>
@endpush
