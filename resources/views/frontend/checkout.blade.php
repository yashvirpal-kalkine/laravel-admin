@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- breadcrumb section start here -->
    <section class="breadcrumb-sec" style="background: url(assets/images/banner1.png) no-repeat center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>Checkout</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb section end here -->

    <!-- checkout page section start here -->
    <section class="cart-page-sec">
        <div class="container">
            <form>
                <div class="row g-4">
                    <div class="col-lg-6">

                        <!-- Returning Customer -->
                        <div class="notification-card">
                            <div class="toggle-section" onclick="toggleContent('loginContent')">
                                <i class="fas fa-user-circle"></i>
                                <span>Returning customer? Click here to login</span>
                                <i class="fas fa-chevron-down arrow-icon" id="loginArrow"></i>
                            </div>
                            <div id="loginContent" class="expandable-content">
                                <p style="color: #666; margin-bottom: 20px;">If you didn't logged in, please log in first.
                                </p>

                                <div class="input-field">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Enter your email">
                                </div>

                                <div class="input-field">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter your password">
                                </div>

                                <button type="button" class="submit-button">
                                    <i class="fas fa-sign-in-alt"></i> Sign In
                                </button>
                            </div>
                        </div>

                        <!-- Coupon Code -->
                        <div class="notification-card">
                            <div class="toggle-section" onclick="toggleContent('couponContent')">
                                <i class="fas fa-ticket-alt"></i>
                                <span>Have a coupon? Click here to enter your code</span>
                                <i class="fas fa-chevron-down arrow-icon" id="couponArrow"></i>
                            </div>
                            <div id="couponContent" class="expandable-content">
                                <p style="color: #666; margin-bottom: 15px;">If you have a coupon code, please apply it
                                    below.</p>

                                <div class="coupon-input-group">
                                    <input type="text" placeholder="Enter coupon code">
                                    <button type="button" class="submit-button">
                                        <i class="fas fa-check"></i> Apply
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Billing Details -->
                        <div class="billing-section">
                            <h4 class="section-header">
                                <i class="fas fa-file-invoice"></i> Billing Details
                            </h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-field">
                                        <label>First Name <span class="required-star">*</span></label>
                                        <input type="text" placeholder="Adam">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-field">
                                        <label>Last Name <span class="required-star">*</span></label>
                                        <input type="text" placeholder="John">
                                    </div>
                                </div>
                            </div>

                            <div class="input-field">
                                <label>Company Name</label>
                                <input type="text" placeholder="Your company name (optional)">
                            </div>

                            <div class="input-field">
                                <label>Country/ Region <span class="required-star">*</span></label>
                                <select>
                                    <option value="3">Australia</option>
                                    <option value="4">England</option>
                                    <option value="6">New Zealand</option>
                                    <option value="5">Switzerland</option>
                                    <option value="1">United Kingdom (UK)</option>
                                    <option value="2">United States (USA)</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Street Address <span class="required-star">*</span></label>
                                <input type="text" placeholder="House number and street name" class="mb-3">
                                <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                            </div>

                            <div class="input-field">
                                <label>Town/ City <span class="required-star">*</span></label>
                                <input type="text" placeholder="Your city">
                            </div>

                            <div class="input-field">
                                <label>Country</label>
                                <input type="text" placeholder="Your country">
                            </div>

                            <div class="input-field">
                                <label>Phone <span class="required-star">*</span></label>
                                <input type="tel" placeholder="+1 234 567 8900">
                            </div>

                            <div class="input-field">
                                <label>Email Address <span class="required-star">*</span></label>
                                <input type="email" placeholder="your.email@example.com">
                            </div>

                            <div class="checkbox-group">
                                <input type="checkbox" id="createAccount">
                                <label for="createAccount">Create an account</label>
                            </div>

                            <!-- Different Shipping -->
                            <div class="notification-card" style="margin-top: 25px;">
                                <div class="checkbox-group" style="margin: 0;">
                                    <input type="checkbox" id="differentShipping"
                                        onclick="toggleContent('shippingContent')">
                                    <label for="differentShipping">Ship to a different address?</label>
                                </div>
                                <div id="shippingContent" class="expandable-content">

                                    <div class="input-field">
                                        <label>Country/ Region <span class="required-star">*</span></label>
                                        <select>
                                            <option value="3">Australia</option>
                                            <option value="4">England</option>
                                            <option value="6">New Zealand</option>
                                            <option value="5">Switzerland</option>
                                            <option value="1">United Kingdom (UK)</option>
                                            <option value="2">United States (USA)</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Street Address <span class="required-star">*</span></label>
                                        <input type="text" placeholder="House number and street name" class="mb-3">
                                        <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                    </div>

                                    <div class="input-field">
                                        <label>Town/ City <span class="required-star">*</span></label>
                                        <input type="text" placeholder="Your city">
                                    </div>

                                    <div class="input-field">
                                        <label>Country</label>
                                        <input type="text" placeholder="Your country">
                                    </div>

                                    <div class="input-field">
                                        <label>Phone <span class="required-star">*</span></label>
                                        <input type="tel" placeholder="+1 234 567 8900">
                                    </div>

                                </div>
                            </div>

                            <div class="input-field" style="margin-top: 25px;">
                                <label>Other Notes (optional)</label>
                                <textarea rows="4"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>

                        </div>
                    </div>

                    <!-- ORDER SUMMARY -->
                    <div class="col-lg-6">
                        <div class="order-summary">

                            <h5 class="summary-title">
                                <i class="fas fa-shopping-cart"></i>
                                Your Order
                            </h5>

                            <table class="summary-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th style="text-align: right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-name">
                                            7 Chakra Pendant in Clear Quartz
                                            <span class="quantity-badge">x1</span>
                                        </td>
                                        <td class="price" style="text-align: right;">₹117.00</td>
                                    </tr>
                                    <tr>
                                        <td class="product-name">
                                            Jovial Vision 7 Mukhi Rudraksha With Silver
                                            <span class="quantity-badge">x1</span>
                                        </td>
                                        <td class="price" style="text-align: right;">₹198.00</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #000000;">Subtotal</td>
                                        <td style="text-align: right; color: #000000;">₹315.00</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="shipping-options">
                                <div class="shipping-header">
                                    <span><i class="fas fa-shipping-fast"></i> Shipping Method</span>
                                    <span class="price">₹35.00</span>
                                </div>

                                <div class="shipping-option">
                                    <input type="radio" id="freeShip" name="shipping" checked>
                                    <label for="freeShip">Free Shipping</label>
                                </div>

                                <div class="shipping-option">
                                    <input type="radio" id="localShip" name="shipping">
                                    <label for="localShip">Local</label>
                                </div>

                                <div class="shipping-option">
                                    <input type="radio" id="flatRate" name="shipping">
                                    <label for="flatRate">Flat Rate</label>
                                </div>
                            </div>

                            <div class="total-section">
                                <div class="total-row">
                                    <span>Total</span>
                                    <span class="total-amount">₹323.00</span>
                                </div>
                            </div>

                            <div class="payment-methods">

                                <div class="payment-option">
                                    <div class="payment-header">
                                        <input type="radio" id="bankTransfer" name="payment">
                                        <label for="bankTransfer">
                                            <i class="fas fa-university"></i> Direct Bank Transfer
                                        </label>
                                    </div>
                                    <p class="payment-description">
                                        Make your payment directly into our bank account. Use Order ID as reference. Your
                                        order will not
                                        ship until funds clear.
                                    </p>
                                </div>

                                <div class="payment-option">
                                    <div class="payment-header">
                                        <input type="radio" id="cashDelivery" name="payment">
                                        <label for="cashDelivery">
                                            <i class="fas fa-money-bill-wave"></i> Cash on Delivery
                                        </label>
                                    </div>
                                    <p class="payment-description">Pay with cash upon delivery.</p>
                                </div>

                                <div class="payment-option active">
                                    <div class="payment-header">
                                        <input type="radio" id="paypal" name="payment" checked>
                                        <label for="paypal">
                                            <i class="fab fa-paypal"></i> PayPal
                                        </label>
                                    </div>
                                    <p class="payment-description">
                                        Pay via PayPal; you can also pay with your credit card if you don't have a PayPal
                                        account.
                                    </p>
                                </div>

                            </div>

                            <button type="submit" class="checkout-button">
                                <i class="fas fa-lock"></i> Process to Checkout
                            </button>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <!-- checkout page section end here -->
@endsection