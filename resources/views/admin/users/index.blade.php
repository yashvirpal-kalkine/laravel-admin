@extends('layouts.admin')

@section('content')
@php
$title = 'Users List';
$breadcrumbs = [
'Home' => route('admin.dashboard'),
'Users' => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name, email, phone" value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
        </form>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">+ Add User</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Addresses</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a href="{{ route('admin.users.addresses.index', $user->id) }}" class="btn btn-info btn-sm">
                            View ({{ $user->addresses->count() }})
                        </a>
                        <a href="{{ route('admin.users.addresses.create', $user->id) }}" class="btn btn-success btn-sm">
                            Add
                        </a>
                    </td>
                    <td>{!! status_badge($user->status) !!}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection