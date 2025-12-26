<!-- Magnet Pyramid section start hee -->
@php
    $imgurl = $item->image ? $item->image_url : asset('frontend/images/offers.webp');
@endphp
<section class="magnet-pyramid-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="magnet-pyramid-wrap">
                    <figure><img src="{{ $imgurl }}" alt="{{ $item->image_alt ?? $item->title }}"></figure>
                    <div class="magnet-pyramid-text">
                        @if($item->title)
                            <h2>{{ $item->title }}</h2>
                        @endif
                        @if($item->subtitle)
                            <p>{{ $item->subtitle }}</p>
                        @endif
                        @if($item->short_description)
                            <p>{{ $item->short_description }}</p>
                        @endif
                        @if($item->description)
                            <p>{{ $item->description }}</p>
                        @endif
                        @if($item->button_text)
                            <a class="btn shop-now-btn mybtn" href="{{ $item->button_link ?? '#' }}">
                                {{ $item->button_text }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <!-- Magnet Pyramid section start hee -->
<section class="magnet-pyramid-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="magnet-pyramid-wrap">
                    <figure> <img src="{{ asset('frontend/assets/images/bg2.png') }}" alt="Magnet Pyramid "
                            title="Magnet Pyramid "> </figure>
                    <div class="magnet-pyramid-text">
                        <h2>Money Magnet Pyramid</h2>
                        <p>Activate Money Flow Energy In Your Life</p>
                        <a class="btn shop-now-btn" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Magnet Pyramid section end hee -->
<section class="magnet-pyramid-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="magnet-pyramid-wrap palm-stone">
                    <figure> <img src="{{ asset('frontend/assets/images/bg3.png') }}" alt="Magnet Pyramid "
                            title="Magnet Pyramid "> </figure>
                    <div class="magnet-pyramid-text">
                        <h2>Rose Quartz Palm Stone</h2>
                        <h5>Attract love, peace & emotional healing naturally.</h5>
                        <a class="btn shop-now-btn" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}