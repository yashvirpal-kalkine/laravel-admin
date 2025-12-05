@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')

    <!-- breadcrumb section start here -->
    <section class="breadcrumb-sec"
        style="background: url({{ asset('frontend/assets/images/banner1.png') }}) no-repeat center;">
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
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro2.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro2.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                                <div class="thumb "><img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                        data-large="{{ asset('frontend/assets/images/pro1.jpg') }}">
                                </div>
                            </div>

                            <button class="thumb-arrow next-thumb">▲</button>

                        </div>

                    </div>


                </div>
                <!-- RIGHT SIDE PRODUCT INFO (unchanged) -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <h2>{{ $product->title }}</h2>


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
                    <h2 class="section-title text-center">Releated Products</h2>
                    <div class="bracelets-box">
                        <div class="owl-carousel products-silder owl-theme">
                            @foreach ($relatedProducts as $item)
                                <x-frontend.product-card-carousel :product="$item" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bracelets section end here -->
@endsection