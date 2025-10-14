@extends('layouts.admin')

@section('content')
@php
$title = isset($user) && $user->exists ? 'Edit User' : 'Create User';
$breadcrumbs = [
'Home' => route('admin.dashboard'),
'Users' => route('admin.users.index'),
$title => ''
];
@endphp

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($user) && $user->exists ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
            @csrf
            @if(isset($user) && $user->exists)
            @method('PUT')
            @endif
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control" required>
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="{{ isset($user) ? 'Leave blank to keep current password' : '' }}">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($user) && $user->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection