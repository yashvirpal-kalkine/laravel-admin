@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')

{{-- 
    <div class="d-flex gap-2 m-3 p-3 border">
        <button class="add-cart" data-id="1" onclick="addToCart(1)">add cart</button>
        <button class="add-cart" data-id="1" onclick="addToCart(2)">add cart</button>
        <button class="add-cart" data-id="1" onclick="updateCart(2)">Update cart</button>
        <button onclick="removeFromCart({{ 2 }})"> Remove </button>
    </div> --}}






    {{-- {{ $cart }} --}}

    <!-- cart page section start here -->
    <section class="cart-page-sec">
        <div class="container">
            <div class="container py-5">
                <div class="row g-4" id="cartpage">
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
                                            <x-frontend.cart-product :item="$item" />
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <div class="d-flex flex-column flex-md-row justify-content-end gap-3">

                                                    <form class="d-flex gap-2">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Coupon Code">
                                                        <button class="btn btn-sm btn-outline-dark mybtn" type="submit">
                                                            Apply
                                                        </button>
                                                    </form>
                                                    {{-- <button class="btn btn-primary btn-sm mybtn">
                                                        Update Cart
                                                    </button> --}}
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
                                        <td class="text-end" id="cart-subtotal">{{ currencyformat($cart->total()) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-end">{{ currencyformat(0) }}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total</td>
                                        <td class="text-end" id="cart-total">{{ currencyformat($cart->total()) }}</td>
                                    </tr>
                                </table>

                                <a href="{{ route('page', 'checkout') }}" class="btn btn-dark w-100 mybtn">
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

@endsection
@push('scripts')
    <script>


    </script>
@endpush