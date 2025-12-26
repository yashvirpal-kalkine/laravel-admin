@php
    $minPrice = $filters['price']['min'] ?? 0;
    $maxPrice = $filters['price']['max'] ?? 0;
@endphp

<div class="card shadow-sm p-3 mb-3">
    <h6 class="fw-semibold mb-3">Price Range</h6>

    <!-- Inputs -->
    <div class="row g-2 mb-3">
        <div class="col">
            <input type="number" id="minInput" class="form-control form-control-sm" value="{{ $minPrice }}"
                min="{{ $minPrice }}" max="{{ $maxPrice }}">
        </div>
        <div class="col">
            <input type="number" id="maxInput" class="form-control form-control-sm" value="{{ $maxPrice }}"
                min="{{ $minPrice }}" max="{{ $maxPrice }}">
        </div>
    </div>

    <!-- Slider -->
    <div class="range-slider">
        <div class="progress"></div>
        <input type="range" id="minRange" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $minPrice }}">
        <input type="range" id="maxRange" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}">
    </div>

    <small class="text-muted d-block mt-2">
        ₹<span id="minVal">{{ $minPrice }}</span> –
        ₹<span id="maxVal">{{ $maxPrice }}</span>
    </small>
</div>
<style>
    .range-slider {
        position: relative;
        height: 6px;
        background: #dee2e6;
        border-radius: 5px;
    }

    .range-slider .progress {
        position: absolute;
        height: 100%;
        background: #0d6efd;
        border-radius: 5px;
        left: 0;
        right: 0;
    }

    .range-slider input[type="range"] {
        position: absolute;
        width: 100%;
        top: -6px;
        pointer-events: none;
        background: none;
        -webkit-appearance: none;
    }

    .range-slider input[type="range"]::-webkit-slider-thumb {
        pointer-events: auto;
        width: 16px;
        height: 16px;
        background: #0d6efd;
        border-radius: 50%;
        -webkit-appearance: none;
    }

    .range-slider input[type="range"]::-moz-range-thumb {
        pointer-events: auto;
        width: 16px;
        height: 16px;
        background: #0d6efd;
        border-radius: 50%;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const minRange = document.getElementById("minRange");
        const maxRange = document.getElementById("maxRange");
        const minInput = document.getElementById("minInput");
        const maxInput = document.getElementById("maxInput");
        const progress = document.querySelector(".range-slider .progress");
        const minVal = document.getElementById("minVal");
        const maxVal = document.getElementById("maxVal");

        if (!minRange || !maxRange) return;

        const minLimit = parseInt(minRange.min);
        const maxLimit = parseInt(maxRange.max);

        function update() {
            let min = parseInt(minRange.value);
            let max = parseInt(maxRange.value);

            // Prevent crossing
            if (min > max) {
                [min, max] = [max, min];
                minRange.value = min;
                maxRange.value = max;
            }

            // Sync inputs
            minInput.value = min;
            maxInput.value = max;

            // Update labels
            minVal.textContent = min;
            maxVal.textContent = max;

            // Progress bar
            progress.style.left = ((min - minLimit) / (maxLimit - minLimit)) * 100 + "%";
            progress.style.right = 100 - ((max - minLimit) / (maxLimit - minLimit)) * 100 + "%";
        }

        // Slider events
        minRange.addEventListener("input", update);
        maxRange.addEventListener("input", update);

        // Input events
        minInput.addEventListener("change", () => {
            minRange.value = Math.max(minLimit, Math.min(minInput.value, maxRange.value));
            update();
        });

        maxInput.addEventListener("change", () => {
            maxRange.value = Math.min(maxLimit, Math.max(maxInput.value, minRange.value));
            update();
        });

        update();
    });
</script>
<!-- Category Filter -->
<div class="card shadow-sm p-3 mb-3">
    <h6 class="fw-semibold mb-3">Categories</h6>

    <ul class="list-group list-group-flush small">
        @forelse($filters['categories'] ?? [] as $category)
            @continue($category['count'] == 0)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input id="pc- {{ $category['id'] }}" class="form-check-input" type="checkbox"
                        value="{{ $category['slug'] }}" name="category[]">
                    <label for="pc- {{ $category['id'] }}" class="form-check-label">
                        {{ $category['name'] }}
                    </label>
                </div>

                <span class="badge bg-secondary-subtle text-dark">
                    {{ $category['count'] }}
                </span>
            </li>
        @empty
            <li class="list-group-item text-muted">No categories</li>
        @endforelse
    </ul>
</div>
<button type="button" class="btn mybtn mb-3 d-block mx-auto">
    Apply Filter
</button>

@php
    $special = $filters['special'] ?? null;
@endphp
<!-- Special Product -->
@if($special)
    <div class="card shadow-sm p-3">
        <h4 class="fw-semibold">Special Product</h4>
        <div class="product-advertisement">
            <figure>
                <a href="{{ route('products.details', $special->slug) }}">
                    <img src="{{  $special->image ? $special->image_url : asset('frontend/images/product.webp')  }}"
                        alt=" {{ $special->name }}">
                </a>
            </figure>
        </div>
        {{-- {{ currencyFormat($special->sale_price ?? $special->regular_price) }} --}}
    </div>
@endif