@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/product.webp');
@endphp
<div class="item">
    <div class="product-box">
        <figure>
            <a href="{{ route('products.details', $item->slug) }}" class="href">
                <img src="{{ $imgurl }}" alt="{{ $item->image_alt ?? $item->title }}">
            </a>
        </figure>
        <div class="product-btns">
            <!-- {{ $item->has_variants ? 'Variable' : 'Simple' }} -->

            @if ($item->has_variants)
                <svg width="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 4v2h10V4H9zM5 3v4H3V3h2zm4 13v4h2v-4H9zm-6 1v2h14v-2H3zm15-6v4h2v-4h-2zM3 8v2h8V8H3z" />
                </svg>
                Choose Options
            @else
                <x-frontend.add-to-cart :cartQty="$item->cart_qty" :productId="$item->id" :isSingle="false" />
            @endif

            <x-frontend.add-to-wishlist :product="$item" :isSingle="false" />
        </div>
        @if ($item->sale_price)
            <div class="custom-tags-home">
                <p>Sale</p>
            </div>
        @endif
        <h4>
            <a href="{{ route('products.details', $item->slug) }}" class="href">{{ $item->title }}</a>
        </h4>
        <x-frontend.price :item="$item" />
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