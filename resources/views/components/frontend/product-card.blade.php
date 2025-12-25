@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/product.webp');
@endphp
<div class="col-md-4">
    <div class="product-box">
        <figure><img src="{{ $imgurl }}" alt="{{ $item->image_alt ?? $item->title }}"></figure>
        <div class="product-btns">
            <x-frontend.add-to-cart :cartQty="$item->cart_qty" :productId="$item->id" :isSingle="false" />
            <x-frontend.add-to-wishlist :isSingle="false" />
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