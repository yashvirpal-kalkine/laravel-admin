@extends('layouts.admin')

@section('content')
@php
$title = isset($address) && $address->exists ? 'Edit Address' : 'Add Address';
$breadcrumbs = [
    'Home' => route('admin.dashboard'),
    'Users' => route('admin.users.index'),
    $user->name => route('admin.users.edit', $user->id),
    $title => ''
];
@endphp

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($address) && $address->exists ? route('admin.addresses.update', $address->id) : route('admin.users.addresses.store', $user->id) }}" method="POST">
            @csrf
            @if(isset($address) && $address->exists)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="billing" {{ old('type', $address->type ?? '') == 'billing' ? 'selected' : '' }}>Billing</option>
                    <option value="shipping" {{ old('type', $address->type ?? '') == 'shipping' ? 'selected' : '' }}>Shipping</option>
                </select>
                @error('type') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address Line 1</label>
                <input type="text" name="address_line1" value="{{ old('address_line1', $address->address_line1 ?? '') }}" class="form-control" required>
                @error('address_line1') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address Line 2</label>
                <input type="text" name="address_line2" value="{{ old('address_line2', $address->address_line2 ?? '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" value="{{ old('city', $address->city ?? '') }}" class="form-control" required>
                @error('city') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" name="state" value="{{ old('state', $address->state ?? '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" name="country" value="{{ old('country', $address->country ?? '') }}" class="form-control" required>
                @error('country') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $address->phone ?? '') }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($address) && $address->exists ? 'Update' : 'Add' }}</button>
            <a href="{{ route('admin.users.addresses.index', $user->id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
