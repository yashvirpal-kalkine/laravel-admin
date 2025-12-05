@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    @if ($sliders->isNotEmpty())
        <!--  silder section start here -->
        <section class="slider-home-sec">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button btn--lg" data-bs-target="#carouselExampleControls" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                </div>

                <div class="carousel-inner">
                    @foreach ($sliders as $key => $item)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
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
                    @endforeach
                </div>
            </div>
        </section>
        <!--  silder section end here -->
    @endif
    @if ($whyChooseSections->isNotEmpty())
        <!-- Guarantee  section start here -->
        <section class="guarantee-sec">
            <div class="container">
                <div class="row">
                    @foreach ($whyChooseSections as $key => $item)
                        <x-frontend.why-choose :item="$item" />
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Guarantee  section end here -->
    @endif
    @if ($featuredCategories->isNotEmpty())
        <!-- product category section start here -->
        <section class="product-category-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-category-wrap">
                            <div class="owl-carousel owl-theme category">
                                @foreach ($featuredCategories as $item)
                                    <x-frontend.title-image-carousel :item="$item" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product category section end here -->
    @endif
    @if ($popularProducts->isNotEmpty())
        <!-- Bracelets section start here -->
        <section class="bracelets-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-title text-center">Popular Products</h2>
                        <div class="bracelets-box">
                            <div class="owl-carousel products-silder owl-theme">
                                @foreach ($popularProducts as $item)
                                    <x-frontend.product-card-carousel :product="$item" />
                                @endforeach
                            </div>
                        </div>
                        <a class="all-products" href="#">View all products</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bracelets section end here -->
    @endif

    @if ($braceletProducts->isNotEmpty())
        <!-- product category section start here -->
        <section class="product-category-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-category-wrap">
                            <h2 class="section-title text-center">Shop By Bracelets</h2>
                            <div class="owl-carousel owl-theme category">
                                @foreach ($braceletProducts as $item)
                                    <x-frontend.title-image-carousel :item="$item" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product category section end here -->
    @endif
    @if ($newProducts->isNotEmpty())
        <!-- Bracelets section start here -->
        <section class="bracelets-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-title text-center">New Arrivals</h2>
                        <div class="bracelets-box">
                            <div class="owl-carousel products-silder owl-theme">
                                @foreach ($newProducts as $item)
                                    <x-frontend.product-card-carousel :product="$item" />
                                @endforeach
                            </div>
                        </div>
                        <a class="all-products" href="">View all products</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bracelets section end here -->
    @endif

    @if ($globalSectionFirst)
        <x-frontend.global-section :globalSection="$globalSectionFirst" />
    @endif

    @if ($customizeBracelet)
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
                                                <figure> <a href="#"> <img src="{{ asset('frontend/assets/images/b-1.jpg') }}"
                                                            alt=""> </a>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="customised-img-wrap">
                                                <figure> <a href="#"> <img src="{{ asset('frontend/assets/images/b-2.jpg') }}"
                                                            alt=""> </a>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="customised-img-wrap">
                                                <figure> <a href="#"> <img src="{{ asset('frontend/assets/images/b-3.jpg') }}"
                                                            alt=""> </a>
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
    @endif



    @if ($globalSectionSecond)
        <x-frontend.global-section :globalSection="$globalSectionSecond" />
    @endif

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
                                    <figure> <img src="{{ asset('frontend/assets/images/ins1.jpg') }}" alt="Instagram Feed">
                                    </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins2.jpg') }}" alt="Instagram Feed">
                                    </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins3.jpg') }}" alt="Instagram Feed">
                                    </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins4.jpg') }}" alt="Instagram Feed">
                                    </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins5.jpg') }}" alt="Instagram Feed">
                                    </figure>
                                    <a href="#"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="instagram-box">
                                    <figure> <img src="{{ asset('frontend/assets/images/ins1.jpg') }}" alt="Instagram Feed">
                                    </figure>
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