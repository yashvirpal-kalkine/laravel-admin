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
        Cart (<span id="cart-count">{{ $cart->items->sum('quantity') ?? 0 }}</span>)
    </a>


    <button class="add-cart" data-id="1" onclick="addToCart(2)">add cart</button>
    <button class="add-cart" data-id="1" onclick="updateCart(2)">Update cart</button>



    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        @foreach($cart->items as $item)
            {{-- {{ $item }} --}}
            <tr id="cart-item-{{ $item->id }}">
                <td>{{ $item->product->title }}</td>
                <td>
                    <input type="number" value="{{ $item->quantity }}" min="1" data-id="{{ $item->id }}" class="update-cart">
                </td>
                <td>{{ $item->price }}</td>
                <td>
                    <button class="remove-cart" data-id="{{ $item->id }}"
                        onclick="removeFromCart({{ $item->product_id }})">Remove</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>Total: <span id="cart-total">{{ $cart->total() }}</span></div>

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
                        document.getElementById('cart-count').innerText = data.cart_count;
                        alert(data.message);
                    });
            }

            function updateCart(productId, qty = 1) {
                fetch(`/cart/update/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ quantity: qty })
                }).then(() => location.reload());
            }

            function removeFromCart(productId) {
                fetch(`/cart/remove/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(() => location.reload());
            }
        </script>
    @endpush




    <!-- cart page section start here -->
    <section class="cart-page-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="#" class="product-image">
                                                <img src="{{ asset('frontend/assets/images/pro1.jpg') }}" alt="product">
                                            </a>

                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"><i
                                                    class="fas fa-times"></i></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="#">7 Chakra Pendant in Clear Quartz</a>
                                        </h5>
                                    </td>
                                    <td>₹ 799</td>
                                    <td>
                                        <div class=" gap-3 mt-1">
                                            <div class="input-group quantity-group">
                                                <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                                                <input type="number" class="form-control text-center qty-input" value="1"
                                                    min="1">
                                                <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">₹ 799</span></td>
                                </tr>

                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="#" class="product-image">
                                                <img src="{{ asset('frontend/assets/images/pro2.jpg') }}" alt="product">
                                            </a>

                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"><i
                                                    class="fas fa-times"></i></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="#">Jovial Vision 7 Mukhi Rudraksha With Silver</a>
                                        </h5>
                                    </td>
                                    <td>₹ 799</td>
                                    <td>
                                        <div class=" gap-3 mt-1">
                                            <div class="input-group quantity-group">
                                                <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                                                <input type="number" class="form-control text-center qty-input" value="1"
                                                    min="1">
                                                <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">₹ 799</span></td>
                                </tr>

                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="#" class="product-image">
                                                <img src="{{ asset('frontend/assets/images/pro3.jpg') }}" alt="product">
                                            </a>

                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"><i
                                                    class="fas fa-times"></i></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="#">Jovial Vision 7 Stone Tree</a>
                                        </h5>
                                    </td>
                                    <td>₹ 799</td>
                                    <td>
                                        <div class=" gap-3 mt-1">
                                            <div class="input-group quantity-group">
                                                <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                                                <input type="number" class="form-control text-center qty-input" value="1"
                                                    min="1">
                                                <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">₹ 799</span></td>
                                </tr>
                            </tbody>


                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                        <div class="cart-discount-wrap">
                                            <div class="float-left">
                                                <div class="cart-discount">
                                                    <form action="#">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm"
                                                                placeholder="Coupon Code" required="">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm" type="submit">Apply
                                                                    Coupon</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="float-right">
                                                <button type="submit" class="btn btn-shop btn-update-cart">
                                                    Update Cart
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>$17.90</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-start">
                                        <h4>Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="radio" checked="">
                                                <label class="custom-control-label">Local pickup</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat rate</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->

                                        <form action="#">
                                            <div class="form-group form-group-sm">
                                                <label>Shipping to Delhi</label>
                                                <div class="select-custom">
                                                    <select class="form-control form-control-sm">
                                                        <option value="Afghanistan">Afghanistan</option>
                                                        <option value="Albania">Albania</option>
                                                        <option value="Algeria">Algeria</option>
                                                        <option value="Andorra">Andorra</option>
                                                        <option value="Angola">Angola</option>
                                                        <option value="Argentina">Argentina</option>
                                                        <option value="Armenia">Armenia</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Austria">Austria</option>
                                                        <option value="Azerbaijan">Azerbaijan</option>

                                                        <!-- INDIA SELECTED -->
                                                        <option value="India" selected>India</option>

                                                        <option value="Indonesia">Indonesia</option>
                                                        <option value="Iran">Iran</option>
                                                        <option value="Iraq">Iraq</option>
                                                        <option value="Ireland">Ireland</option>
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Kenya">Kenya</option>
                                                        <option value="Malaysia">Malaysia</option>
                                                        <option value="Nepal">Nepal</option>
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                    </select>

                                                </div><!-- End .select-custom -->
                                            </div><!-- End .form-group -->

                                            <div class="form-group form-group-sm">
                                                <div class="select-custom">
                                                    <select class="form-control form-control-sm">
                                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                        <option value="Assam">Assam</option>
                                                        <option value="Bihar">Bihar</option>
                                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                                        <option value="Goa">Goa</option>
                                                        <option value="Gujarat">Gujarat</option>
                                                        <option value="Haryana">Haryana</option>
                                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                        <option value="Jharkhand">Jharkhand</option>
                                                        <option value="Karnataka">Karnataka</option>
                                                        <option value="Kerala">Kerala</option>
                                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                        <option value="Maharashtra">Maharashtra</option>
                                                        <option value="Manipur">Manipur</option>
                                                        <option value="Meghalaya">Meghalaya</option>
                                                        <option value="Mizoram">Mizoram</option>
                                                        <option value="Nagaland">Nagaland</option>
                                                        <option value="Odisha">Odisha</option>
                                                        <option value="Punjab">Punjab</option>
                                                        <option value="Rajasthan">Rajasthan</option>
                                                        <option value="Sikkim">Sikkim</option>
                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                        <option value="Telangana">Telangana</option>
                                                        <option value="Tripura">Tripura</option>
                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                        <option value="Uttarakhand">Uttarakhand</option>
                                                        <option value="West Bengal">West Bengal</option>

                                                        <!-- Union Territories -->
                                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                            Islands</option>
                                                        <option value="Chandigarh">Chandigarh</option>

                                                        <!-- DEFAULT SELECTED DELHI -->
                                                        <option value="Delhi" selected>Delhi</option>

                                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                        <option value="Ladakh">Ladakh</option>
                                                        <option value="Lakshadweep">Lakshadweep</option>
                                                        <option value="Puducherry">Puducherry</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Town / City">
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <input type="text" class="form-control form-control-sm" placeholder="ZIP">
                                            </div>


                                        </form>
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>$17.90</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="cart.html" class="btn btn-block btn-dark">Proceed to Checkout
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart page section end here -->
@endsection