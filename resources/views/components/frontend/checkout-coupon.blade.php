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