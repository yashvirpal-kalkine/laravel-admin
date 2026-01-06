<div class="item">
    <div class="customised-img-wrap">
        <figure>
            <a href="{{ route('products.details', $item->slug) }}">
                <img src="{{  $item->image ? $item->image_url : asset('frontend/images/product.webp') }}"
                    alt="{{ $item->image_alt ?? $item->title }}">
            </a>
        </figure>
    </div>
</div>
@foreach ($item->galleries as $gal)
    <div class="item">
        <div class="customised-img-wrap">
            <figure>
                <a href="{{ route('products.details', $item->slug) }}">
                    <img src="{{  $gal->image ? $gal->image_url : asset('frontend/images/product.webp') }}"
                        alt="{{ $item->image_alt ?? $item->title }}">
                </a>
            </figure>
        </div>
    </div>
@endforeach