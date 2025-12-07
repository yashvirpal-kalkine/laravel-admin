{{-- <div class="col-md-3 col-sm-6">
    <div class="guarantee-box">
        <figure> <img src="{{ asset('frontend/assets/images/icon1.png') }}" alt=""> </figure>
        <p>Guarantee of Purity</p>
    </div>
</div>
<div class="col-md-3 col-sm-6">
    <div class="guarantee-box">
        <figure> <img src="{{ asset('frontend/assets/images/icon2.png') }}" alt=""> </figure>
        <p>100% Natural & Certified</p>
    </div>
</div>
<div class="col-md-3 col-sm-6">
    <div class="guarantee-box">
        <figure> <img src="{{ asset('frontend/assets/images/icon3.png') }}" alt=""> </figure>
        <p>Ethically Sourced</p>
    </div>
</div>
<div class="col-md-3 col-sm-6">
    <div class="guarantee-box">
        <figure> <img src="{{ asset('frontend/assets/images/icon4.png') }}" alt=""> </figure>
        <p>Free Shipping</p>
    </div>
</div> --}}
@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/why-choose-us.webp');
@endphp
<div class="col-md-3 col-sm-6">
    <div class="guarantee-box">
        <figure> <img src="{{ $imgurl}}" alt="{{ $item->image_alt ?? $item->title }}"> </figure>
        <p>{{ $item->title }}</p>
    </div>
</div>