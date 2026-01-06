<tr id="cart-item-{{ $item->product_id }}">
    @php
        $subtotal = $item->price * $item->quantity;

    @endphp
    <td>
        <div class="d-flex align-items-center gap-3">
            <a href="javascript:void(0);" onclick="removeFromCart({{ $item->product_id }})" class="text-danger fs-5">
                <i class="fas fa-trash-alt"></i>
            </a>
            <img src="{{ $item->image ? $item->product->image_url : asset('frontend/images/product.webp') }}"
                class="rounded-circle" width="70" height="70" style="object-fit:cover">
            <a href="{{ route('products.details', $item->product->slug) }}"
                class="fw-semibold text-dark text-decoration-none">
                {{ $item->product->title }}
            </a>
        </div>
    </td>
    <td>{{ currencyformat($item->price) }}</td>
    <td class="text-center">
        <x-frontend.quantity :cartQty="$item->quantity " :productId="$item->product_id" :isSingle="false" />
    </td>
    <td class="text-end fw-semibold" id="subtotal-{{ $item->product_id }}">
        {{ currencyformat($subtotal) }}
    </td>
</tr>