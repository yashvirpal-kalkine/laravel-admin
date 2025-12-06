@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/category.webp');
@endphp
<div class="item">
    <div class="category-img">
        <div class="hex-wrap">
            <span class="hex-border"></span>
            <figure><img src="{{ $imgurl }}" alt="{{ $item->image_alt ?? $item->title }}"></figure>
        </div>
        <h3><a href="{{ route('products.list', $item->full_slug) }}">{{ $item->title }}</a></h3>
    </div>
</div>