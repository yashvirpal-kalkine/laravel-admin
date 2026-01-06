@if($cart->items->isEmpty())
    <p class="text-center mt-2">Cart is empty</p>
@else
    @php
        $total = 0;
    @endphp

    @foreach($cart->items as $item)
        @php
            $subtotal = $item->price * $item->quantity;
            $total += $subtotal;
        @endphp

        <div class="product">
            <div class="product-details">
                <h4 class="product-title">
                    <a href="{{ route('products.details', $item->product->slug) }}">{{ $item->product->title }}</a>
                </h4>

                <span class="cart-product-info">
                    <span class="cart-product-qty">{{ $item->quantity }}</span>
                    × {{ currencyformat($item->price) }} = {{ currencyformat($subtotal) }}
                </span>
            </div>

            <figure class="product-image-container">
                <a href="{{ route('products.details', $item->product->slug) }}" class="product-image">
                    <img src="{{ $item->image ? $item->product->image_url : asset('frontend/images/product.webp') }}" width="80"
                        height="80">
                </a>

                <a href="javascript:void(0)" onclick="removeFromCart({{ $item->product_id }})" class="btn-remove"
                    title="Remove Product">
                    <span>×</span>
                </a>
            </figure>
        </div>
    @endforeach

    <div class="cart-footer">
        <div class="subtotal">
            <span>Subtotal:</span>
            <strong>{{ currencyformat($total) }}</strong>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('page', 'cart') }}" class="btn btn-sm mybtn">View Cart</a>
            <a href="{{ route('page', 'checkout') }}" class="btn btn-sm btn-primary mybtn">Checkout</a>
        </div>
    </div>
@endif