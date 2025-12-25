@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <div id="mini-cart">
        <a href="{{ route('cart.index') }}">Cart (<span id="cart-count">{{ $cart->items->sum('quantity') ?? 0 }}</span>)</a>
        <ul>
            @foreach($cart->items as $item)
                <li>{{ $item->product->title }} x {{ $item->quantity }} - {{ $item->price }}</li>
            @endforeach
        </ul>
        <div>Total: {{ $cart->total() }}</div>
    </div>
    <a href="{{ route('cart.index') }}">
        Cart (<span class="cart-count">{{ $cart->items->sum('quantity') }}</span>)
    </a>


    <button class="add-cart" data-id="1" onclick="addToCart(2)">add cart</button>
    <button class="add-cart" data-id="1" onclick="updateCart(2)">Update cart</button>
    <button onclick="removeFromCart({{ 2 }})"> Remove </button>
    {{-- <input type="number" value="{{ $item->quantity }}" min="1"
        onchange="updateCart({{ $item->product_id }}, this.value)"> --}}



    @push('scripts')
        <script>
            function addToCart(productId, qty = 1) {
                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ quantity: qty })
                })
                    .then(res => res.json())
                    .then(data => {
                        console.log('SUCCESS:', data);
                        loadMiniCart();
                        document.getElementById('cart-count').innerText = data.cart_count;
                    });
            }

            function updateCart(productId, qty) {
                console.log('Updating:', productId, qty);

                fetch(`/cart/update/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity: qty })
                })
                    .then(res => res.json())
                    .then(data => {
                        console.log('SUCCESS:', data);
                        loadMiniCart();
                    })
                    .catch(err => console.error('ERROR:', err));
            }

            function removeFromCart(productId) {
                fetch(`/cart/remove/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(() => loadMiniCart());
            }

            function loadMiniCart() {
                fetch('/cart/mini', {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) return;
                        renderMiniCart(data.cart);
                    });
            }
            function renderMiniCart(cart) {
                const miniCart = document.getElementById('minicart');

                if (!cart.items.length) {
                    miniCart.innerHTML = `<p class="text-center mt-2">Cart is empty</p>`;
                    document.querySelectorAll('.cartCount').forEach(el => el.innerText = 0);
                    return;
                }

                let count = 0;
                let total = 0;

                let html = ``;

                cart.items.forEach(item => {
                    count += item.quantity;
                    total += item.price * item.quantity;

                    html += `<div class="product">
                                                                    <div class="product-details">
                                                                        <h4 class="product-title">
                                                                            <a href="#">${item.product.title}</a>
                                                                        </h4>

                                                                        <span class="cart-product-info">
                                                                            <span class="cart-product-qty">${item.quantity}</span>
                                                                            × ${item.price} = ₹${(item.price * item.quantity).toFixed(2)}
                                                                        </span>
                                                                    </div>

                                                                    <figure class="product-image-container">
                                                                        <a href="#" class="product-image">
                                                                            <img src="{{ asset('frontend/assets/images/pro1.jpg') }}" alt="product" width="80" height="80">
                                                                        </a>

                                                                        <a href="javascript:void(0)" onclick="removeFromCart(${item.product_id})" class="btn-remove" title="Remove Product"><span>×</span></a>
                                                                    </figure>
                                                                </div>`;

                });
                html += `<div class="cart-footer">
                                                            <div class="subtotal">
                                                                <span>Subtotal:</span>
                                                                <strong>₹${total.toFixed(2)}</strong>
                                                            </div>
                                                            <div class="d-flex gap-2">
                                                                <a href="{{ route('page', 'cart') }}" class="btn btn-sm mybtn">View Cart</a>
                                                                <a href="{{ route('page', 'checkout') }}" class="btn btn-sm btn-primary mybtn">Checkout</a>   
                                                            </div>
                                                        </div>`;
                miniCart.innerHTML = html;

                document.querySelectorAll('.cartCount').forEach(el => el.innerText = count);
            }
            document.addEventListener('DOMContentLoaded', function () {
                loadMiniCart();
            });
        </script>
    @endpush


    {{-- {{ $cart }} --}}

    <!-- cart page section start here -->
    <section class="cart-page-sec">
        <div class="container">
            <div class="container py-5">
                <div class="row g-4">
                    @if ($cart->items->count() > 0)
                        <div class="col-lg-9">
                            <div class="table-responsive">
                                <table class="table align-middle table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th class="text-center" style="width:160px;">Quantity</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->items as $item)
                                            <tr id="cart-item-{{ $item->id }}">

                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <a href="javascript:void(0);"
                                                            onclick="removeFromCart({{ $item->product_id }})"
                                                            class="text-danger fs-5">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        <img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                                            class="rounded-circle" width="70" height="70" style="object-fit:cover">
                                                        <a href="#" class="fw-semibold text-dark text-decoration-none">
                                                            {{ $item->product->title }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>{{ $item->price }}</td>
                                                <td class="text-center">
                                                    <div class="input-group input-group-sm quantity-group mx-auto">
                                                        <button type="button" class="btn btn-outline-secondary qty-btn"
                                                            data-type="minus"
                                                            onclick="updateCart({{ $item->product_id }}, this.value)">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type="number" class="form-control text-center qty-input"
                                                            value="{{ $item->quantity }}" data-id="{{ $item->id }}" min="1"
                                                            max="10" />
                                                        <button type="button"
                                                            onclick="updateCart({{ $item->product_id }}, this.value)"
                                                            class="btn btn-outline-secondary qty-btn" data-type="plus">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-end fw-semibold">{{ $item->quantity * $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <div class="d-flex flex-column flex-md-row justify-content-between gap-3">

                                                    <form class="d-flex gap-2">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Coupon Code">
                                                        <button class="btn btn-sm btn-outline-dark mybtn" type="submit">
                                                            Apply
                                                        </button>
                                                    </form>

                                                    <button class="btn btn-primary btn-sm mybtn">
                                                        Update Cart
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="border rounded p-3 shadow-sm">
                                <h5 class="fw-bold mb-3">Cart Totals</h5>

                                <table class="table table-sm mb-3">
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-end">{{ $cart->total() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-end">₹0</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total</td>
                                        <td class="text-end">{{ $cart->total() }}</td>
                                    </tr>
                                </table>

                                <a href="#" class="btn btn-dark w-100 mybtn">
                                    Proceed to Checkout <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            Your cart is empty.
                        </div>
                    @endif
                </div>
            </div>



        </div>
    </section>
    <!-- cart page section end here -->
    <style>
        .quantity-group {
            width: 140px;
        }

        .qty-input {
            max-width: 50px;
            padding: 4px;
        }

        .qty-btn {
            width: 36px;
        }

        .qty-btn i {
            font-size: 12px;
        }
    </style>
@endsection
@push('scripts')
    <script>
        document.addEventListener("click", function (e) {
            if (!e.target.closest(".qty-btn")) return;

            const btn = e.target.closest(".qty-btn");
            const input = btn.parentElement.querySelector(".qty-input");

            let value = parseInt(input.value);
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 999;

            if (btn.dataset.type === "plus" && value < max) {
                input.value = value + 1;
            }

            if (btn.dataset.type === "minus" && value > min) {
                input.value = value - 1;
            }
        });
    </script>

@endpush