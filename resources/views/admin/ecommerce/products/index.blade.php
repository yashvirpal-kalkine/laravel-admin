@extends('layouts.admin')

@section('content')
    @php
        $title = 'Products';
        $breadcrumbs = ['Home' => route('admin.dashboard'), 'Products' => ''];
    @endphp

    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or slug"
                    value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
            </form>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">+ Add Product</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->title }}</td>
                            <td>
                                @foreach($product->categories as $cat)
                                    <span class="badge bg-info">{{ $cat->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($product->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->title }}</span>
                                @endforeach
                            </td>
                            <td>₹{{ number_format($product->price, 2) }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $product->status == 'published' ? 'success' : ($product->status == 'draft' ? 'secondary' : 'warning') }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>{{ $product->author?->name ?? '-' }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection