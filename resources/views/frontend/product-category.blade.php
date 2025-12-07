@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- breadcrumb section start here -->
    <section class="breadcrumb-sec" style="background: url({{ asset('frontend/assets/images/banner1.png') }}) no-repeat center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>Products</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb section end here -->

    <!-- All products section start here -->
    <section class="all-products-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-bar">
                        <div class="top-baar-left">
                            <p>Showing 1 - 10 of 8 products</p>
                        </div>
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
                <!-- LEFT CATEGORIES -->
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
                                <a href="#"> <img src="{{ asset('frontend/assets/images/a.jpg') }}" alt="Product Advertisement"> </a>
                            </figure>
                        </div>
                    </div>
                </div>

                <!-- RIGHT PRODUCTS -->
                <div class="col-md-9">
                    <div class="row gy-4 gx-3">
                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro1.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class="custom-tags-home">
                                    <p>Bestseller</p>
                                </div>
                                <h4>7 Chakra Pendant in Clear Quartz</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 799
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro2.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class="custom-tags-home">
                                    <p>Bestseller</p>
                                </div>
                                <h4>Jovial Vision 7 Mukhi Rudraksha With Silver</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 799
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro3.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class="custom-tags-home">
                                    <p>Bestseller</p>
                                </div>
                                <h4>Jovial Vision 7 Stone Tree</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 799
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro4.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class="custom-tags-home">
                                    <p>Bestseller</p>
                                </div>
                                <h4>Jovial Vision Abundance Pyramid</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 799
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro5.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class="custom-tags-home">
                                    <p>Bestseller</p>
                                </div>
                                <h4>Jovial Vision African Turquoise Bracelet</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 799
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro6.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class="custom-tags-home">
                                    <p>Bestseller</p>
                                </div>
                                <h4>Jovial Vision Amazonite Bracelet</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 799
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro9.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <h4>Jovial Vision Sleep & Anxiety Healing Bracelet</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 1,099
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        20% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(10 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro10.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <h4>Jovial Vision Small Evil Eye Hanger</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 499
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 649</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        10% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(2 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro11.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <h4>Jovial Vision Smoky Quartz Bracelet</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 789
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        25% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro12.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <h4>Jovial Vision Strawberry Quartz Bracelet</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 969
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro13.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <h4>Jovial Vision Student’s Crystal Coaster</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 699
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-box">
                                <figure> <img src="{{ asset('frontend/assets/images/pro14.jpg') }}" alt=""> </figure>
                                <div class="product-btns">
                                    <button class="btn-cart">
                                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Shopping_Bag" fill="#222" data-name="Shopping Bag">
                                                <path
                                                    d="m32 54.685h-14.443a7.5 7.5 0 0 1 -7.453-8.34l2.821-30.066a1.5 1.5 0 0 1 1.494-1.36h17.581a1.5 1.5 0 0 1 0 3h-16.215l-2.7 28.734a4.5 4.5 0 0 0 4.469 5.032h14.446a1.5 1.5 0 0 1 0 3z" />
                                                <path
                                                    d="m14.419 17.919a1.5 1.5 0 0 1 -1.07-2.551l5.5-5.6a1.5 1.5 0 0 1 1.07-.45h12.081a1.5 1.5 0 0 1 0 3h-11.449l-5.062 5.152a1.5 1.5 0 0 1 -1.07.449z" />
                                                <path
                                                    d="m46.443 54.685h-14.443a1.5 1.5 0 0 1 0-3h14.443a4.5 4.5 0 0 0 4.472-5l-2.7-28.762h-16.215a1.5 1.5 0 0 1 0-3h17.581a1.5 1.5 0 0 1 1.494 1.36l2.825 30.09a7.5 7.5 0 0 1 -7.456 8.312z" />
                                                <path
                                                    d="m49.581 17.919a1.5 1.5 0 0 1 -1.07-.449l-5.062-5.155h-11.449a1.5 1.5 0 0 1 0-3h12.078a1.5 1.5 0 0 1 1.07.45l5.5 5.6a1.5 1.5 0 0 1 -1.07 2.551z" />
                                                <path
                                                    d="m32 30.835a8.157 8.157 0 0 1 -8.148-8.148v-1.5a1.5 1.5 0 0 1 3 0v1.5a5.148 5.148 0 0 0 10.3 0v-1.5a1.5 1.5 0 0 1 3 0v1.5a8.157 8.157 0 0 1 -8.152 8.148z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="btn-wishlist">
                                        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512"
                                            viewBox="0 0 511.933 511.933" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                                                            <path
                                                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <h4>Jovial Vision Students Keychain</h4>
                                <div class="product-price">
                                    <span class="price-sale">
                                        ₹ 249
                                    </span>
                                    <small class="compare-price">
                                        <s>₹ 1,299</s>
                                    </small>
                                    <span class="price-discount-percent">
                                        38% OFF
                                    </span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(22 Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation" class="mt-4">
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
                    </nav>

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- All products section end here -->
@endsection