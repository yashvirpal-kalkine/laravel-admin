<!-- Billing Details -->
<div class="billing-section">
    <h4 class="section-header">
        <i class="fas fa-file-invoice"></i> Billing Details
    </h4>

    <div class="row">
        <div class="col-md-6">
            <div class="input-field">
                <label>First Name <span class="required-star">*</span></label>
                <input name="billing_first_name" id="billing_first_name" type="text" placeholder="First Name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-field">
                <label>Last Name <span class="required-star">*</span></label>
                <input name="billing_last_name" id="billing_last_name" type="text" placeholder="Last Name">
            </div>
        </div>
    </div>

    <div class="input-field">
        <label>Street Address <span class="required-star">*</span></label>
        <input name="billing_address_line1" id="billing_address_line1" type="text"
            placeholder="House number and street name" class="mb-3">
        <input name="billing_address_line2" id="billing_address_line2" type="text"
            placeholder="Apartment, suite, unit, etc. (optional)">
    </div>

    <div class="input-field">
        <label>City <span class="required-star">*</span></label>
        <input name="billing_city" id="billing_city" type="text" placeholder="Your city">
    </div>

    <div class="input-field">
        <label>State <span class="required-star">*</span></label>
        <input name="billing_state" id="billing_state" type="text" placeholder="Your State">
    </div>

    <div class="input-field">
        <label>Phone <span class="required-star">*</span></label>
        <input name="billing_phone" id="billing_phone" class="w-100" type="tel" placeholder="+1 234 567 8900">
    </div>

    <div class="input-field">
        <label>Zip <span class="required-star">*</span></label>
        <input name="billing_zip" id="billing_zip" type="tel" placeholder="110096">
    </div>

    <div class="input-field">
        <label>Email Address <span class="required-star">*</span></label>
        <input name="email" id="email" type="email" placeholder="your.email@example.com">
    </div>
    <div class="input-field">
        <label>Password <span class="required-star">*</span></label>
        <input name="password" id="password" type="password" placeholder="Password">
    </div>

    <!-- Different Shipping -->
    <div class="notification-card" style="margin-top: 25px;">
        <div class="checkbox-group" style="margin: 0;">
            {{-- <input type="checkbox" name="differentShipping" id="differentShipping" value="1"> --}}

            <input type="checkbox" name="differentShipping" id="differentShipping"
                onclick="toggleContent('shippingContent')">
            <label for="differentShipping">Ship to a different address?</label>
        </div>
        <div id="shippingContent" class="expandable-content">

            <div class="row">
                <div class="col-md-6">
                    <div class="input-field">
                        <label>First Name <span class="required-star">*</span></label>
                        <input name="shipping_first_name" id="shipping_first_name" type="text" placeholder="First Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-field">
                        <label>Last Name <span class="required-star">*</span></label>
                        <input name="shipping_last_name" id="shipping_last_name" type="text" placeholder="Last Name">
                    </div>
                </div>
            </div>

            <div class="input-field">
                <label>Street Address <span class="required-star">*</span></label>
                <input name="shipping_address_line1" id="shipping_address_line1" type="text"
                    placeholder="House number and street name" class="mb-3">
                <input name="shipping_address_line2" id="shipping_address_line2" type="text"
                    placeholder="Apartment, suite, unit, etc. (optional)">
            </div>

            <div class="input-field">
                <label> City <span class="required-star">*</span></label>
                <input name="shipping_city" id="shipping_city" type="text" placeholder="Your city">
            </div>

            <div class="input-field">
                <label>State <span class="required-star">*</span></label>
                <input name="shipping_state" id="shipping_state" type="text" placeholder="Your State">
            </div>

            <div class="input-field">
                <label>Phone <span class="required-star">*</span></label>
                <input name="shipping_phone" id="shipping_phone" class="w-100" type="tel" placeholder="+1 234 567 8900">
            </div>
            <div class="input-field">
                <label>Zip <span class="required-star">*</span></label>
                <input name="shipping_zip" id="shipping_zip" type="tel" placeholder="110096">
            </div>
        </div>
    </div>

    <div class="input-field" style="margin-top: 25px;">
        <label>Other Notes (optional)</label>
        <textarea name="order_notes" id="order_notes" rows="4" placeholder="special notes for delivery."></textarea>
    </div>

</div>