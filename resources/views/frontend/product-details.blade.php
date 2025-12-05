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
                            <h1>Product Details</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb section end here -->

    <!-- products details section start here -->
    <section class="product-section py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <!-- MAIN IMAGE -->
                    <div class="prod_img_outer prod_img2 has_bigger">

                        <div class="prod_img">
                            <a class="setup main-image" href="#" target="_blank">
                                <img id="mainImg" src="{{ asset('frontend/assets/images/pro1.jpg') }}" alt="">
                            </a>
                        </div>

                        <!-- THUMBNAIL SLIDER + ARROWS -->
                        <div class="thumb-slider-wrapper">

                            <button class="thumb-arrow prev-thumb">▲</button>

                            <div class="owl-carousel owl-thumbs">
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}" data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro2.jpg') }}" data-large="{{ asset('frontend/assets/images/pro2.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}" data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}" data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}" data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}" data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}" data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                            </div>

                            <button class="thumb-arrow next-thumb">▲</button>

                        </div>

                    </div>


                </div>
                <!-- RIGHT SIDE PRODUCT INFO (unchanged) -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <h2>7 Chakra Pendant in Clear Quartz</h2>


                        <div class="custom_tag_pdp">
                            <ul>
                                <li class="tags">Memory Boost</li>
                                <li class="tags">Concentration Increase</li>
                            </ul>
                        </div>
                        <div class="price ffdd ">
                            <span> NZ$ 4,209.00
                                <span class="prepaid-offer"> 15% OFF + Free Gift on Prepaid Order</span>
                            </span>
                        </div>

                        <p class="taxes"> (incl gst) </p>

                        <div class="product-category-box">
                            Category:
                            <a href="/product-category/pendants/">Pendants</a>,
                            <a href="/product-category/rings/">Rings</a> &
                            <a href="/product-category/malas/">Malas</a>
                        </div>

                        <div class="offer_box">
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
                        </div>


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
                                            <ul>
                                                <li>This premium spiritual product from <strong>Jovial Vision</strong> is
                                                    designed to attract positivity and overall well-being.</li>
                                                <li>Helps maintain mental calmness, clarity and confidence in day-to-day
                                                    life.</li>
                                                <li>Perfect for students, working professionals, job seekers and business
                                                    owners.</li>
                                                <li>Every product is <strong>cleansed & energized (Abhimantrit)</strong>
                                                    using powerful Vedic rituals before dispatch.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion 2 — BENEFITS -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Benefits
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><strong>Boosts Focus & Memory</strong> — helps in exams, studies and new
                                                    learning.</li>
                                                <li><strong>Improves Job & Interview Success</strong> — enhances speech,
                                                    confidence and clarity.</li>
                                                <li><strong>Removes Negativity & Confusion</strong> — keeps mind calm and
                                                    positive.</li>
                                                <li><strong>Increases Wisdom & Creativity</strong> — opens the way for
                                                    intuition and clarity.</li>
                                                <li><strong>Energized by Jovial Vision Experts</strong> — for maximum
                                                    spiritual impact.</li>
                                            </ul>

                                            <ul>
                                                <li>Every product is <strong>Abhimantrit</strong> following powerful Vedic
                                                    rituals.</li>
                                                <li>Energization is done personally with your <strong>Name & Gotra</strong>
                                                    for best results.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion 3 — PACKAGING -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Packaging
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Details are confirmed before energization to maintain complete accuracy.
                                                </li>
                                                <li>Products are cleansed and energized according to your <strong>Name,
                                                        Gotra & Date of Birth</strong>.</li>
                                                <li>After energization, products are packed with positive vibrations.</li>
                                            </ul>

                                            <ul>
                                                <li>Fresh flowers</li>
                                                <li>Positive blessings</li>
                                                <li>Certificate of authenticity</li>
                                                <li>Personalized greeting card</li>
                                            </ul>

                                            <ul>
                                                <li>All steps are completed under the supervision of the <strong>Jovial
                                                        Vision Team</strong> to ensure powerful results.</li>
                                            </ul>
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
                                                        <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
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
                                                        <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
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
                                                        <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
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
                                                        <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
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
                                                        <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
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
                                                        <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
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
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <span class="rating-count">(22 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bracelets section end here -->
@endsection