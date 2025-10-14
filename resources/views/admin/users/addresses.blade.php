@extends('layouts.admin')

@section('content')
@php
$title = 'Addresses for ' . $user->name;
$breadcrumbs = [
'Home' => route('admin.dashboard'),
'Users' => route('admin.users.index'),
$user->name => route('admin.users.edit', $user->id),
'Addresses' => ''
];
@endphp

<div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.users.addresses.create', $user->id) }}" class="btn btn-primary btn-sm">+ Add Address</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($addresses as $address)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($address->type) }}</td>
                    <td>{{ $address->address_line1 }} {{ $address->address_line2 }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->state }}</td>
                    <td>{{ $address->country }}</td>
                    <td>{{ $address->postal_code }}</td>
                    <td>{{ $address->phone }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.addresses.edit', $address->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Delete this address?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No addresses found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection