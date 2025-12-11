@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/product.webp');
@endphp
<div class="item">
    <div class="customised-img-wrap">
        <figure>
            <a href="{{ route('products.details', $product->slug) }}">
                <img src="{{ $imgurl }}" alt="{{ $product->image_alt ?? $product->title }}">
            </a>
        </figure>
    </div>
</div>