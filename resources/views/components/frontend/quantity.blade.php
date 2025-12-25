{{-- <div class="input-group quantity-group">
    <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
    <input type="number" class="form-control text-center qty-input" value="1" min="1">
    <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
</div> --}}
<div class="input-group input-group-sm qty-wrapper mx-auto">
    <button type="button" class="btn btn-outline-secondary qty-btn" data-type="minus">
        <i class="fas fa-minus"></i>
    </button>
    <input type="text" class="form-control text-center qty-input" value="{{ max(1, (int) $cartQty) }}"
        data-product-id="{{ $productId }}" min="1" max="100" readonly />
    <button type="button" class="btn btn-outline-secondary qty-btn" data-type="plus">
        <i class="fas fa-plus"></i>
    </button>
</div>