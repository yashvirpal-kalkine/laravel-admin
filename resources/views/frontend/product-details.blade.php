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
                        @if($product->has_variants)

                            <div class="row">
                                @foreach ($product->attributes as $attr)
                                    <div class="col-md-6">
                                        <label>{{ $attr->name }}</label>
                                        <select class="variant-select form-control" data-attr="{{ $attr->id }}">
                                            <option value="">Select {{ $attr->name }}</option>
                                            @foreach ($attr->values as $val)
                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                            @php
                                $min = $product->variants->min('sale_price') ?? $product->variants->min('regular_price');
                                $max = $product->variants->max('sale_price') ?? $product->variants->max('regular_price');
                            @endphp

                            <div id="price-block">
                                <span id="price-range">
                                    {{ currencyformat($min) }} - {{ currencyformat($max) }}
                                </span>

                                <span id="variant-price" style="display:none;"></span>
                            </div>
                        @else
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
                        @endif
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
                                    <x-frontend.quantity :cartQty="$product->cart_qty" :product="$product"
                                        :isSingle="true" />
                                </div>
                                <div class="btn-box">
                                    <x-frontend.add-to-cart :cartQty="$product->cart_qty" :product="$product"
                                        :isSingle="true" />
                                </div>
                            </div>
                            <x-frontend.add-to-wishlist :product="$product" :isSingle="true" />
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
                                <p>Want to buy in bulk?
                                    <a href="{{ route('page', 'bulk-enquiry') }}"
                                        style="color: var(--bg---color-bg-3)">Enquiry Now</a>
                                </p>
                            </div>
                        </div>
                        <!-- <div class="custom-html">
                                                                <div class="bulk-order-enquiry">
                                                                    <p>Want to buy in bulk?
                                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal"
                                                                            style="color: var(--bg---color-bg-3)">Enquiry Now</a>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="enquiryModalLabel">Enquiry Form</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <x-frontend.custom-bracelet-form full-width="true" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div> -->



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- products details section end here  -->

    <!-- pro-details-tabs section start here -->
    <div class="container my-5">

        <!-- Tabs -->
        <div class="product-tabs">
            <button class="product-tab-btn active" data-tab="desc">Description</button>
            <button class="product-tab-btn" data-tab="reviews"> Reviews <span class="count">0</span> </button>
            @if($product->faqs->count())
                <button class="product-tab-btn" data-tab="faq"> FAQ </button>
            @endif
        </div>

        <!-- Description -->
        <div id="desc" class="tab-content-box active">
            <h4>Description</h4>
            <p>
                {!! $product->description !!}
            </p>
        </div>

        <!-- Reviews -->
        <div id="reviews" class="tab-content-box">

            <!-- Comment List -->
            <div class="comment-list mb-5">

                <div class="comment-item">
                    <div class="comment-avatar">A</div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <h6>Akash Verma</h6>
                            <span class="comment-date">June 12, 2025</span>
                        </div>
                        <div class="comment-rating">★★★★☆</div>
                        <p>Beautiful pendant, very good quality and fast delivery.</p>
                    </div>
                </div>

                <div class="comment-item">
                    <div class="comment-avatar">R</div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <h6>Riya Sharma</h6>
                            <span class="comment-date">June 10, 2025</span>
                        </div>
                        <div class="comment-rating">★★★★★</div>
                        <p>Loved the crystal clarity and packaging. Highly recommended.</p>
                    </div>
                </div>

            </div>

            <!-- Review Form -->
            <div class="review-section">
                <h3 class="review-title">Add a Review</h3>

                <div class="rating-wrap mb-3">
                    <label class="fw-semibold mb-1">Your rating *</label>
                    <div class="rating-stars">
                        <i class="fas fa-star" data-index="1"></i>
                        <i class="fas fa-star" data-index="2"></i>
                        <i class="fas fa-star" data-index="3"></i>
                        <i class="fas fa-star" data-index="4"></i>
                        <i class="fas fa-star" data-index="5"></i>
                    </div>
                </div>

                <form>
                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Your review *</label>
                        <textarea class="form-control" rows="4"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold mb-1">Name *</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold mb-1">Email *</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>

                    <button class="btn-review-submit">Submit</button>
                </form>
            </div>

        </div>
        @if($product->faqs->count())
            <div id="faq" class="tab-content-box ">
                <h3>Product FAQs</h3>
                <div class="accordion" id="productFaqAccordion">
                    @foreach($product->faqs as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse"
                                aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#productFaqAccordion">
                                <div class="accordion-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <!-- pro-details-tabs section end here  -->
    @if($relatedProducts->isNotEmpty())
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
    @endif
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.variant-select').forEach(select => {
            select.addEventListener('change', function () {
                let values = [];
                document.querySelectorAll('.variant-select').forEach(s => {
                    if (s.value !== "") values.push(parseInt(s.value));
                });

                // check if all attributes selected
                if (values.length !== document.querySelectorAll('.variant-select').length) {
                    document.getElementById('variant-price').style.display = 'none';
                    document.getElementById('price-range').style.display = 'inline';
                    return;
                }

                // AJAX Call
                fetch('/get-variant-price', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: {{ $product->id }},
                        values: values,
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.found) {
                            let priceHtml = '';

                            if (data.sale_price) {
                                priceHtml = `
                                                        <span>${data.sale_formatted}</span>
                                                        <small><s>${data.regular_formatted}</s></small>
                                                    `;
                            } else {
                                priceHtml = `<span>${data.regular_formatted}</span>`;
                            }

                            document.getElementById('price-range').style.display = 'none';
                            document.getElementById('variant-price').style.display = 'inline';
                            document.getElementById('variant-price').innerHTML = priceHtml;
                        }

                    });
            });
        });
    </script>

@endpush