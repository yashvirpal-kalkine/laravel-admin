@extends('layouts.admin')

@section('content')
    @php
        $title = isset($coupon) && $coupon->exists ? 'Edit Coupon' : 'Create Coupon';
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary btn-sm"><i
                    class="bi bi-arrow-left-circle me-1"></i> Back To List</a>
        </div>

        <div class="card-body">
            <form
                action="{{ isset($coupon) && $coupon->exists ? route('admin.coupons.update', $coupon->id) : route('admin.coupons.store') }}"
                method="POST">
                @csrf
                @if(isset($coupon) && $coupon->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $coupon->title ?? '') }}" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code ?? '') }}"
                            required>
                        @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            @foreach(['fixed', 'percentage'] as $type)
                                <option value="{{ $type }}" @selected(old('type', $coupon->type ?? '') == $type)>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Value</label>
                        <input type="number" step="0.01" name="value" class="form-control"
                            value="{{ old('value', $coupon->value ?? '') }}" required>
                        @error('value') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Valid From</label>
                        <input type="text" name="valid_from" class="form-control datetime"
                            value="{{ old('valid_from', isset($coupon->valid_from) ? $coupon->valid_from : '') }}">
                        @error('valid_from') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Valid Until</label>
                        <input type="text" name="valid_until" class="form-control datetime"
                            value="{{ old('valid_until', isset($coupon->valid_until) ? $coupon->valid_until : '') }}">
                        @error('valid_until') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-check form-switch mb-3">
                            <input type="hidden" name="status" value="0" />
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" {{ old('status', $coupon->status ?? true) ? 'checked' : '' }} />
                            <label class="form-check-label" for="statusSwitch">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($coupon) && $coupon->exists ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
@include('components.admin.datetimepicker')