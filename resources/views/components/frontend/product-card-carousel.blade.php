@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/product.webp');
@endphp
<div class="item">
    <div class="product-box">
        <figure><img src="{{ $imgurl }}" alt="{{ $item->image_alt ?? $item->title }}"></figure>
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
                <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512" viewBox="0 0 511.933 511.933"
                    width="512" xmlns="http://www.w3.org/2000/svg">
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
        @if ($item->sale_price)
            <div class="custom-tags-home">
                <p>Sale</p>
            </div>
        @endif
        <h4>
            <a href="{{ route('products.details', $item->slug) }}" class="href">{{ $item->title }}</a>
        </h4>
        <div class="product-price">
            @if ($item->sale_price)
                <span class="price-sale">
                    {{ currencyformat($item->sale_price) }}
                </span>
                <small class="compare-price">
                    <s> {{ currencyformat($item->regular_price) }}</s>
                </small>
                <span class="price-discount-percent">
                    {{ $item->discountPercentage() }}% Off
                </span>
            @else
                <span class="price-sale">
                    {{ currencyformat($item->regular_price) }}
                </span>
            @endif
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