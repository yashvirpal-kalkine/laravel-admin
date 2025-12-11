@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    
    <!-- products details section start here -->
    <section class="product-section py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <!-- MAIN IMAGE -->
                    <div class="prod_img_outer prod_img2 has_bigger">
                        @php
                            $imgurl = $product->image ? $product->image_url : asset('frontend/images/product.webp');
                        @endphp
                        <div class="prod_img">
                            <span class="setup main-image">
                                @if ($product->sale_price)
                                    <div class="custom-tags-home">
                                        <p>Sale</p>
                                    </div>
                                @endif
                                <img id="mainImg" src="{{ $imgurl }}" alt="{{ $product->image_alt ?? $product->title }}">
                            </span>
                        </div>
                        @if($product->galleries->isNotEmpty())
                            <!-- THUMBNAIL SLIDER + ARROWS -->
                            <div class="thumb-slider-wrapper">

                                <button class="thumb-arrow prev-thumb">▲</button>

                                <div class="owl-carousel owl-thumbs">
                                    @foreach ($product->galleries as $galleries)
                                        @php
                                            $imgurl = $galleries->image ? $galleries->image_url : asset('frontend/images/product.webp');
                                        @endphp
                                        <div class="thumb ">
                                            <img src="{{ $imgurl }}" data-large="{{ $imgurl }}"
                                                alt="{{ $product->image_alt ?? $product->title }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="thumb-arrow next-thumb">▲</button>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- RIGHT SIDE PRODUCT INFO (unchanged) -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <h2>{{ $product->title }}</h2>
                        <div class="price ffdd ">
                            @if ($product->sale_price)
                                <span>
                                    {{ currencyformat($product->sale_price) }}
                                </span>
                                <small class="compare-price">
                                    <s> {{ currencyformat($product->regular_price) }}</s>
                                </small>
                                <span>
                                    <span class="prepaid-offer">
                                        {{ $product->discountPercentage() }}% Off
                                    </span>
                                </span>
                            @else
                                <span class="price-sale">
                                    {{ currencyformat($product->regular_price) }}
                                </span>
                            @endif
                        </div>
                        <p>{{ $product->short_description }}</p>
                        @if ($product->tags->isNotEmpty())
                            <div class="custom_tag_pdp">
                                <ul>Tags:
                                    @foreach ($product->tags as $tags)
                                        <li class="tags">{{ $tags->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @if($product->categories->isNotEmpty())
                            <div class="product-category-box">
                                Category:
                                @foreach ($product->categories as $category)
                                    <a href="{{ route('products.list', $category->full_slug) }}">
                                        {{ $category->title }}
                                    </a>@if(!$loop->last),@endif
                                @endforeach
                            </div>
                        @endif

                        {{-- <div class="offer_box">
                            <div class="marquee-track">
                                <!-- First Set -->
                                <div class="li-text">🎁 15% OFF + Free Gift on All Prepaid Orders 🎁</div>
                                <div class="li-text">💰 Get 10% OFF on Partial Payment 💰</div>
                                <div class="li-text">🎉 Extra 20% OFF on 2nd Product 🎉</div>

                                <!-- Duplicate Set (Loop ke liye mandatory) -->
                                <div class="li-text">🎁 15% OFF + Free Gift on All Prepaid Orders 🎁</div>
                                <div class="li-text">💰 Get 10% OFF on Partial Payment 💰</div>
                                <div class="li-text">🎉 Extra 20% OFF on 2nd Product 🎉</div>
                            </div>
                        </div> --}}


                        <!-- QUANTITY -->
                        <div class="quantity-box pro-h">
                            <label class="fw-bold">Quantity:</label>
                            <div class="quantity-wrap">
                                <div class="gap-3 mt-1">
                                    <div class="input-group quantity-group">
                                        <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                                        <input type="number" class="form-control text-center qty-input" value="1" min="1">
                                        <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                    </div>
                                </div>
                                <div class="btn-box">
                                    <button class="add-to-cart-btn">Add to Cart</button>
                                    <button class="add-to-cart-btn">Buy it now</button>
                                </div>
                            </div>
                        </div>

                        <!-- ds-memonics -->
                        <div class="ds-memonics">
                            <ul>
                                <li>
                                    <figure> <img src="{{ asset('frontend/assets/images/ds1.webp') }}"> </figure>
                                    <h4>Free Delivery</h4>
                                </li>
                                <li>
                                    <figure> <img src="{{ asset('frontend/assets/images/ds2.webp') }}"> </figure>
                                    <h4>7 Day Return</h4>
                                </li>
                                <li>
                                    <figure> <img src="{{ asset('frontend/assets/images/ds3.webp') }}"> </figure>
                                    <h4>100% Authentic</h4>
                                </li>
                                <li>
                                    <figure> <img src="{{ asset('frontend/assets/images/ds4.webp') }}"> </figure>
                                    <h4>Secure Payment</h4>
                                </li>
                            </ul>
                        </div>

                        <div class="custom-html">
                            <div class="bulk-order-enquiry">
                                <p>Want to buy in bulk? <a href="#" style="color: blue;">Inquire Now</a></p>
                            </div>
                        </div>
                        <x-frontend.custom-bracelet-form />
                        <div class="description-box">
                            <div class="accordion" id="accordionExample">

                                <!-- Accordion 1 — DESCRIPTION -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Description
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $product->description }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- products details section end here  -->

    <!-- pro-details-tabs section start here -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">

                <button class="btn btn-success rounded-pill px-5 mb-4">
                    Reviews (0)
                </button>

                <div class="review-section">
                    <h3 class="review-title">Reviews</h3>

                    <p>There are no reviews yet.</p>
                    <p>Be the first to review <strong>“7 Chakra Pendant in Clear Quartz”</strong></p>
                    <p>Your email address will not be published. Required fields are marked *</p>

                    <!-- Rating -->
                    <div class="rating-wrap">
                        <label class="fw-semibold mb-1">Your rating *</label>
                        <div class="rating-stars mb-3">
                            <i class="fas fa-star" data-index="1"></i>
                            <i class="fas fa-star" data-index="2"></i>
                            <i class="fas fa-star" data-index="3"></i>
                            <i class="fas fa-star" data-index="4"></i>
                            <i class="fas fa-star" data-index="5"></i>
                        </div>
                    </div>

                    <!-- Review Form -->
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="fw-semibold mb-1">Your review *</label>
                                <textarea class="form-control" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="fw-semibold mb-1">Name *</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="fw-semibold mb-1">Email *</label>
                                <input type="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="saveInfo">
                            <label class="form-check-label" for="saveInfo">
                                Save my name, email, and website in this browser for the next time I comment.
                            </label>
                        </div>

                        <button type="submit" class="btn btn-review-submit">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- pro-details-tabs section end here  -->

    <!-- Bracelets section start here -->
    <section class="bracelets-sec bg-white pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title text-center">Releated Products</h2>
                    <div class="bracelets-box">
                        <div class="owl-carousel products-silder owl-theme">
                            @foreach ($relatedProducts as $item)
                                <x-frontend.product-card-carousel :item="$item" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bracelets section end here -->
@endsection