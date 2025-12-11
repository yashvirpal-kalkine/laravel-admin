@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- All products section start here -->
    <section class="all-products-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-bar">
                        <div class="top-baar-right">
                            <select id="sortProduct">
                                <option value="default">Sort By</option>
                                <option value="name">Name (A-Z)</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="price-filter-ui">
                        <div class="price-title">Filter by Price</div>

                        <div class="price-slider-box">
                            <div class="price-progress" id="progressBar"></div>
                            <input type="range" min="0" max="3000000" value="0" class="range" id="minRange">
                            <input type="range" min="0" max="3000000" value="3000000" class="range" id="maxRange">
                        </div>

                        <div class="price-input-row">
                            <label>Price:</label>
                            <div class="box">
                                <span>₹</span>
                                <input type="number" id="minInput" value="0">
                            </div>
                            <span>-</span>
                            <div class="box">
                                <span>₹</span>
                                <input type="number" id="maxInput" value="3000000">
                            </div>
                        </div>
                    </div>

                    <div class="products-left-side">
                        <h2> Product Category</h2>
                        <div class="products-category" id="productsCategory">
                            <ul class="category-filter-list">
                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Bracelets">
                                        Bracelets (12)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Pendants">
                                        Pendants (31)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Gold Plated (IGP)">
                                        Gold Plated (IGP) (8)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Kada">
                                        Kada (14)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Rudraksh">
                                        Rudraksh (27)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="God Idols">
                                        God Idols (19)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Yantra">
                                        Yantra (22)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Anklets">
                                        Anklets (6)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Roots & Jadibooti">
                                        Roots & Jadibooti (4)
                                    </label>
                                </li>

                                <li>
                                    <label>
                                        <input type="checkbox" name="filter.category" value="Shankh">
                                        Shankh (11)
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="product-advertisement">
                            <h4>Specials</h4>
                            <figure>
                                <a href="#"> <img src="{{ asset('frontend/assets/images/a.jpg') }}"
                                        alt="Product Advertisement"> </a>
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row gy-4 gx-3">
                        @if($products->count() > 0)
                            @foreach ($products as $product)
                                <x-frontend.product-card :item="$product" />
                            @endforeach
                        @else
                            <div class="col-12 text-center py-5">
                                <x-frontend.no-product />
                            </div>
                        @endif
                    </div>
                    <nav aria-label="Page navigation" class="mt-4">
                        <div class="d-flex justify-content-center">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </nav>

                    {{-- <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">

                            <!-- Previous -->
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>

                            <!-- Page Numbers -->
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>

                            <!-- Next -->
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>

                        </ul>
                    </nav> --}}

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- All products section end here -->
@endsection