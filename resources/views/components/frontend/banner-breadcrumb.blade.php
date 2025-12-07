@php
    $items = $items ?? [];
    $title = count($items) ? $items[array_key_last($items)]['label'] : 'Page';
@endphp
<section class="breadcrumb-sec"
    style="background:url({{ $background ?? asset('frontend/assets/images/banner1.png') }}) no-repeat center;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <h1>{{ $title ?? "" }}</h1>
                        <ol class="breadcrumb">
                            @foreach ($items as $item)
                                @if ($loop->last)
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $item['label'] }}
                                    </li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>