@extends('layouts.admin')

@section('content')
    @php
        $title = isset($blogpost) && $blogpost->exists ? 'Edit Blog Post' : 'Create Blog Post';
        $breadcrumbs = [
            'Home' => route('admin.dashboard'),
            'Blog Posts' => route('admin.blog-posts.index'),
            $title => ''
        ];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Back To List
            </a>
        </div>

        <div class="card-body">
            <form
                action="{{ isset($blogpost) && $blogpost->exists ? route('admin.blog-posts.update', $blogpost->id) : route('admin.blog-posts.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogpost) && $blogpost->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blogpost->title ?? '') }}"
                            class="form-control" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blogpost->slug ?? '') }}"
                            class="form-control">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    @php
                        function renderCategoryOptions($categories, $selectedIds = [], $prefix = '', $parentId = null)
                        {
                            foreach ($categories as $category) {
                                $isSelected = in_array($category->id, $selectedIds) ? 'selected' : '';

                                // add data-parent ONLY for children
                                $dataParent = $parentId ? "data-parent='{$parentId}'" : '';

                                echo "<option value='{$category->id}' {$isSelected} {$dataParent}>
                                                        {$prefix}{$category->title}
                                                    </option>";

                                if ($category->children->isNotEmpty()) {
                                    renderCategoryOptions(
                                        $category->children,
                                        $selectedIds,
                                        $prefix . '— ',
                                        $category->id // 👈 pass current as parent
                                    );
                                }
                            }
                        }
                    @endphp

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Categories</label>
                        <select name="categories[]" class="form-select select2" multiple>
                            @php
                                $selectedCategories = isset($blogpost)
                                    ? $blogpost->categories->pluck('id')->toArray()
                                    : [];
                                renderCategoryOptions($categories, $selectedCategories);
                            @endphp
                        </select>
                        @error('categories') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Tags</label>
                        <select name="tags[]" class="form-select select2" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ isset($blogpost) && $blogpost->tags->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="mb-3 col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="2">{{ old('short_description', $blogpost->short_description ?? '') }}</textarea>
                        @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5">{{ old('description', $blogpost->description ?? '') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner" class="form-control">
                        @if(isset($blogpost) && $blogpost->banner)
                            <img src="{{ image_url('banner', $blogpost->banner, 'small') }}" class="mt-2" width="80">
                        @endif
                        @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Banner Alt Text</label>
                        <input type="text" name="banner_alt" value="{{ old('banner_alt', $blogpost->banner_alt ?? '') }}"
                            class="form-control">
                        @error('banner_alt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Main Image</label>
                        <input type="file" name="image" class="form-control">
                        @if(isset($blogpost) && $blogpost->image)
                            <img src="{{ image_url('blogpost', $blogpost->image, 'small') }}" class="mt-2" width="80">
                        @endif
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Image Alt Text</label>
                        <input type="text" name="image_alt" value="{{ old('image_alt', $blogpost->image_alt ?? '') }}"
                            class="form-control">
                        @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $blogpost->meta_title ?? '') }}"
                            class="form-control">
                        @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $blogpost->meta_keywords ?? '') }}" class="form-control">
                        @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $blogpost->meta_description ?? '') }}</textarea>
                        @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    {{-- <div class="mb-3 col-md-6">
                        <label class="form-label">SEO Image</label>
                        <input type="file" name="seo_image" class="form-control">
                        @if(isset($blogpost) && $blogpost->seo_image)
                        <img src="{{ image_url('seo', $blogpost->seo_image, 'small') }}" class="mt-2" width="80">
                        @endif
                        @error('seo_image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Canonical URL</label>
                        <input type="url" name="canonical_url"
                            value="{{ old('canonical_url', $blogpost->canonical_url ?? '') }}" class="form-control">
                        @error('canonical_url') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Custom Field</label>
                        <input type="text" name="custom_field"
                            value="{{ old('custom_field', $blogpost->custom_field ?? '') }}" class="form-control">
                        @error('custom_field') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', isset($blogpost->published_at) ? $blogpost->published_at->format('Y-m-d\TH:i') : '') }}"
                            class="form-control">
                        @error('published_at') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    --}}
                    <div class="mb-3 col-md-6">
                        <div class="form-check form-switch mb-3">
                            <input type="hidden" name="status" value="0" />
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" {{ old('status', $blogpost->status ?? true) ? 'checked' : '' }} />
                            <label class="form-check-label" for="statusSwitch">Active</label>
                        </div>
                    </div>

                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($blogpost) && $blogpost->exists ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@include('components.admin.select2')
@include('components.admin.datetimepicker')
@push('scripts')
    <script>

        $('.select2').on('change', function () {
            const $select = $(this);
            let selected = $select.val() || [];

            // Loop through all selected child options
            $select.find('option:selected').each(function () {
                const parentId = $(this).data('parent');

                if (parentId && !selected.includes(parentId.toString())) {
                    selected.push(parentId.toString());
                }
            });

            // Update selection only if changed
            $select.val(selected).trigger('change.select2');
        });

    </script>
@endpush