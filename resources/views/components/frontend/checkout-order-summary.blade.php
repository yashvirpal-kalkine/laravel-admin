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
            @foreach($cart->items as $item)
                <x-frontend.checkout-product :item="$item" />
            @endforeach

            <tr>
                <td style="color: #000000;">Subtotal</td>
                <td style="text-align: right; color: #000000;">{{ currencyformat($cart->total()) }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="shipping-options">
        <div class="shipping-header">
            <span><i class="fas fa-shipping-fast"></i> Shipping Method</span>
            <span class="price">{{ currencyformat($cart->total()) }}</span>
        </div>

        <div class="shipping-option">
            <input type="radio" id="freeShip" name="shipping" checked>
            <label for="freeShip">Free Shipping</label>
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