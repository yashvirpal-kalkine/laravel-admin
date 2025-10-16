@extends('layouts.admin')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Coupons</h5>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm">+ Add Coupon</a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.coupons.index') }}" method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or code"
                    value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
            </form>

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Valid From</th>
                        <th>Valid Until</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $coupon->title }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ ucfirst($coupon->type) }}</td>
                            <td>{{ $coupon->type == 'percentage' ? $coupon->value . '%' : '₹' . $coupon->value }}</td>
                            <td><span class="badge bg-{{ $coupon->status_badge }}">{{ ucfirst($coupon->status) }}</span></td>
                            <td>{{ $coupon->valid_from?->format('Y-m-d') ?? '-' }}</td>
                            <td>{{ $coupon->valid_until?->format('Y-m-d') ?? '-' }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this coupon?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No coupons found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $coupons->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection