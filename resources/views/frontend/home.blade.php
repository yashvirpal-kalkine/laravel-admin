@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
 <!--  silder section start here -->
    <section class="slider-home-sec">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button btn--lg" data-bs-target="#carouselExampleControls" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <!-- <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('frontend/assets/images/banner1.webp') }}" class="d-block w-100" alt="banner1">
                    <div class="carousel-caption">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="container-fluid">
                                    <h2>Find the Right Direction Through <br>Vedic Astrology </h2>
                                    <h3>Talk to our experienced Astrologers and get right solutions for your problems
                                    </h3>
                                    <a class="btn" href="#">Call Us Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('frontend/assets/images/banner3.webp') }}" class="d-block w-100" alt="banner2">
                    <div class="carousel-caption">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="container-fluid">
                                    <h2>Here's the solution to all your problems<h2>
                                            <h3>Talk to our experienced Astrologers and get right solutions for your
                                                problems</h3>
                                            <a class="btn btn--lg" href="#">Call Us Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  silder section end here -->

    <!-- Guarantee  section start here -->
    <section class="guarantee-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="guarantee-box">
                        <figure> <img src="{{ asset('frontend/assets/images/icon1.png') }}" alt=""> </figure>
                        <p>Guarantee of Purity</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="guarantee-box">
                        <figure> <img src="{{ asset('frontend/assets/images/icon2.png') }}" alt=""> </figure>
                        <p>100% Natural & Certified</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="guarantee-box">
                        <figure> <img src="{{ asset('frontend/assets/images/icon3.png') }}" alt=""> </figure>
                        <p>Ethically Sourced</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="guarantee-box">
                        <figure> <img src="{{ asset('frontend/assets/images/icon4.png') }}" alt=""> </figure>
                        <p>Free Shipping</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Guarantee  section end here -->

    <!-- product category section start here -->
    <section class="product-category-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-category-wrap">
                        <div class="owl-carousel owl-theme category">
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c1.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">All Products</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c2.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Bracelets</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c3.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Pendants</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c4.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Gold Plated (IGP)</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c5.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Kada</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c7.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Rudraksh</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c8.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">God Idols</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c9.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Yantra</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c10.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Anklets</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c11.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Roots & Jadibooti</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/c12.webp') }}"></figure>
                                    </div>
                                    <h3><a href="#">Shankh</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product category section end here -->

    <!-- Bracelets section start here -->
    <section class="bracelets-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title text-center">Popular Products</h2>
                    <div class="bracelets-box">
                        <div class="owl-carousel products-silder owl-theme">
                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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
                        </div>
                    </div>
                    <a class="all-products" href="#">View all products</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Bracelets section end here -->



    <!-- product category section start here -->
    <section class="product-category-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-category-wrap">
                        <h2 class="section-title text-center">Shop By Bracelets</h2>
                        <div class="owl-carousel owl-theme category">
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b1.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">African Turquoise Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b2.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Amazonite Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b3.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Amethyst Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b4.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Aquamarine Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b5.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Arthritis Healing Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b6.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Asthma Support Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b7.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Aura Quartz Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b8.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Career Mixel Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b9.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Carnelian Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b10.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Cat’s Eye Bracelet</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="category-img">
                                    <div class="hex-wrap">
                                        <span class="hex-border"></span>
                                        <figure><img src="{{ asset('frontend/assets/images/b11.jpg') }}"></figure>
                                    </div>
                                    <h3><a href="#">Citrine Bracelet</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product category section end here -->

    <!-- Bracelets section start here -->
    <section class="bracelets-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title text-center">New Arrivals</h2>
                    <div class="bracelets-box">
                        <div class="owl-carousel products-silder owl-theme">
                            <div class="item">
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
                                <div class="product-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/pro10.jpg') }}" alt="">
                                    </figure>
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
                                <div class="product-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/pro11.jpg') }}" alt="">
                                    </figure>
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
                                <div class="product-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/pro12.jpg') }}" alt="">
                                    </figure>
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
                                <div class="product-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/pro13.jpg') }}" alt="">
                                    </figure>
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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

                            <div class="item">
                                <div class="product-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/pro14.jpg') }}" alt="">
                                    </figure>
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
                                                viewBox="0 0 511.933 511.933" width="512"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g
                                                            id="Layer_2_00000145060757712065768520000010951869483675587996_">
                                                            <g
                                                                id="heart_00000179625350871963104660000003479433197253248677_">
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
                    </div>
                    <a class="all-products" href="#">View all products</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Bracelets section end here -->

    <!-- Magnet Pyramid section start hee -->
    <section class="magnet-pyramid-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="magnet-pyramid-wrap">
                        <figure> <img src="{{ asset('frontend/assets/images/bg2.png') }}" alt="Magnet Pyramid "
                                title="Magnet Pyramid "> </figure>
                        <div class="magnet-pyramid-text">
                            <h2>Money Magnet Pyramid</h2>
                            <p>Activate Money Flow Energy In Your Life</p>
                            <a class="btn shop-now-btn" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Magnet Pyramid section end hee -->


    <!-- customised bracelets section strat here -->
    <section class="customised-bracelets-sec"
        style="background: url({{ asset('frontend/assets/images/bg4.png') }}) no-repeat center;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <h2 class="section-title text-center">Customize Bracelets</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="customised-img-box">
                                <div class="owl-carousel owl-theme" id="customised-img">
                                    <div class="item">
                                        <div class="customised-img-wrap">
                                            <figure> <a href="#"> <img
                                                        src="{{ asset('frontend/assets/images/b-1.jpg') }}" alt=""> </a>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="customised-img-wrap">
                                            <figure> <a href="#"> <img
                                                        src="{{ asset('frontend/assets/images/b-2.jpg') }}" alt=""> </a>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="customised-img-wrap">
                                            <figure> <a href="#"> <img
                                                        src="{{ asset('frontend/assets/images/b-3.jpg') }}" alt=""> </a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="customised-form">
                                <h4>For Energize, We require these details</h4>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <label>Name</label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <label>Date Of Birth</label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <label>Problem</label>
                                                <input type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <label>Specific Problem</label>
                                                <textarea></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <button>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- customised bracelets section strat here -->




    <section class="magnet-pyramid-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="magnet-pyramid-wrap palm-stone">
                        <figure> <img src="{{ asset('frontend/assets/images/bg3.png') }}" alt="Magnet Pyramid "
                                title="Magnet Pyramid "> </figure>
                        <div class="magnet-pyramid-text">
                            <h2>Rose Quartz Palm Stone</h2>
                            <h5>Attract love, peace & emotional healing naturally.</h5>
                            <a class="btn shop-now-btn" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Instagram Feed section start here -->
    <section class="instagram-feed-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title text-center">Follow Us on Instagram</h2>
                    <div class="instagram-feed-wrap">
                        <div class="owl-carousel owl-theme" id="instagram">
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins1.jpg') }}"
                                            alt="Instagram Feed"> </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins2.jpg') }}"
                                            alt="Instagram Feed"> </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins3.jpg') }}"
                                            alt="Instagram Feed"> </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins4.jpg') }}"
                                            alt="Instagram Feed"> </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins5.jpg') }}"
                                            alt="Instagram Feed"> </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins1.jpg') }}"
                                            alt="Instagram Feed"> </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Feed section end here -->
    @endsection