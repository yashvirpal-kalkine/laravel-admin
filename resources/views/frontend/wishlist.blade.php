@extends('layouts.frontend')
@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')

    <!-- breadcrumb section start here -->
    <section class="breadcrumb-sec" style="background: url(assets/images/banner1.png) no-repeat center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                          <h1> Wishlist</h1>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Wishlist</li>
                          </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb section end here -->

    <!--  Wishlist page section start here -->
    <section class="wishlist-page-sec">
        <div class="container">
            <div class="wishlist-table-container">
                <table class="table table-wishlist">
                    <thead>
                        <tr>
                            <th style="width: 120px;"></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th style="width: 180px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <img src="assets/images/pro1.jpg" alt="product" class="product-image">
                                    <a href="#" class="btn-remove" title="Remove from Wishlist">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="#">7 Chakra Pendant in Clear Quartz</a>
                                </h5>
                            </td>
                            <td>
                                <span class="price">₹ 799</span>
                            </td>
                            <td>
                                <span class="stock-status in-stock">
                                    <i class="fas fa-check-circle"></i> In Stock
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-add-cart">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </td>
                        </tr>

                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <img src="assets/images/pro2.jpg" alt="product" class="product-image">
                                    <a href="#" class="btn-remove" title="Remove from Wishlist">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="#">Jovial Vision 7 Mukhi Rudraksha With Silver</a>
                                </h5>
                            </td>
                            <td>
                                <span class="price">₹ 1,299</span>
                            </td>
                            <td>
                                <span class="stock-status in-stock">
                                    <i class="fas fa-check-circle"></i> In Stock
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-add-cart">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </td>
                        </tr>

                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <img src="assets/images/pro3.jpg" alt="product" class="product-image">
                                    <a href="#" class="btn-remove" title="Remove from Wishlist">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="#">Jovial Vision 7 Stone Tree</a>
                                </h5>
                            </td>
                            <td>
                                <span class="price">₹ 899</span>
                            </td>
                            <td>
                                <span class="stock-status out-stock">
                                    <i class="fas fa-times-circle"></i> Out of Stock
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-add-cart" disabled="">
                                    <i class="fas fa-ban"></i> Unavailable
                                </button>
                            </td>
                        </tr>

                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <img src="assets/images/pro4.jpg" alt="product" class="product-image">
                                    <a href="#" class="btn-remove" title="Remove from Wishlist">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="#">Crystal Healing Bracelet</a>
                                </h5>
                            </td>
                            <td>
                                <span class="price">₹ 649</span>
                            </td>
                            <td>
                                <span class="stock-status in-stock">
                                    <i class="fas fa-check-circle"></i> In Stock
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-add-cart">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="wishlist-actions">
                <button class="btn btn-share">
                    <i class="fas fa-share-alt"></i> Share Wishlist
                </button>
                <button class="btn btn-clear">
                    <i class="fas fa-trash-alt"></i> Clear Wishlist
                </button>
            </div>
        </div>
    </section> 
    <!--  Wishlist  page section end here -->





    
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
    </ul>
@endsection
