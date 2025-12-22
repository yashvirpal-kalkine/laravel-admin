@extends('layouts.frontend')
@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')

    <!--  Wishlist page section start here -->
    <section class="wishlist-page-sec">
        <div class="container">
            <div class="wishlist-table-container">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="product-row align-middle">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <figure class="product-image-container position-relative m-0">
                                        <img src="{{ asset('frontend/assets/images/pro2.jpg') }}" alt="product"
                                            class="product-image rounded-circle">

                                        <a href="#" class="btn-remove" title="Remove from Wishlist">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </figure>

                                    <h6 class="product-title mb-0">
                                        <a href="#" class="text-decoration-none text-dark">
                                            Jovial Vision 7 Mukhi Rudraksha With Silver
                                        </a>
                                    </h6>
                                </div>
                            </td>

                            <td>
                                <span class="fw-semibold text-nowrap">₹ 1,299</span>
                            </td>

                            <td>
                                <span class="stock-status in-stock me-2">
                                    <i class="fas fa-check-circle me-1"></i> In Stock
                                </span>
                                <span class="stock-status out-stock">
                                    <i class="fas fa-times-circle"></i> Out of Stock
                                </span>
                            </td>

                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                </button>
                                <button class="btn btn-sm btn-secondary" disabled>
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                                <button class="btn btn-sm btn-outline-danger ms-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                <div class="wishlist-actions">
                                    <button class="btn btn-share">
                                        <i class="fas fa-share-alt"></i> Share Wishlist
                                    </button>
                                    <button class="btn btn-clear">
                                        <i class="fas fa-trash-alt"></i> Clear Wishlist
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="product-row align-middle">

                           
                            <td colspan="4">
                            
                                <p class="text-center mb-0">No more products in your wishlist.</p>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>






        </div>
    </section>
    <!--  Wishlist  page section end here -->




    {{--

    <button class="btn btn-outline-danger wishlist-toggle" data-id="{{ $product->id }}" data-type="Product">
        <i class="bi bi-heart{{ $product->isWishlistedBy(auth()->user()) ? '-fill' : '' }}"></i>
    </button>

    <script>
        $('.wishlist-toggle').click(function () {
            let id = $(this).data('id');
            let type = $(this).data('type');
            $.post('{{ route('wishlist.toggle') }}', {
                id: id,
                type: type,
                _token: '{{ csrf_token() }}'
            }, function (response) {
                location.reload(); // or update icon dynamically
            });
        });
    </script>
    <h3>My Wishlist</h3>
    <ul>
        @foreach($wishlists as $item)
        <li>
            {{ $item->wishlistable->title ?? $item->wishlistable->name }}
            <form action="{{ route('wishlist.toggle') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ class_basename($item->wishlistable_type) }}">
                <input type="hidden" name="id" value="{{ $item->wishlistable_id }}">
                <button class="btn btn-sm btn-danger">Remove</button>
            </form>
        </li>
        @endforeach
    </ul> --}}


@endsection