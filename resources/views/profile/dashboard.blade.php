<!-- Home Page -->
<div id="home-page" class="page-content">
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <i class="fas fa-shopping-cart"></i>
                <div class="number">{{ $total_orders ?? 0 }}</div>
                <div class="label">Total orders</div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <i class="fas fa-money-bill"></i>
                <div class="number">{{ currencyformat($total_spent ?? 0)}}</div>
                <div class="label">Total Spent</div>
            </div>
        </div>
        {{-- <div class="col-md-6 mb-3">
            <div class="stats-card">
                <i class="fas fa-hourglass-half text-yellow-500"></i>
                <div class="number">{{ $pending_orders ?? 0 }}</div>
                <div class="label">Pending Orders</div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <i class="fas fa-tag"></i>
                <div class="number">2</div>
                <div class="label">Discount coupons</div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="alert-cart">
        <i class="fas fa-shopping-cart"></i>
        <span>You've got 1 item(s) waiting in your cart—click to <a href="#">Checkout
                now!</a></span>
    </div> --}}
    <div class="">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2 text-warning"></i>
                    Recent Orders
                </h5>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>

            <x-frontend.user.order-list :items="$recentOrders" />

        </div>
    </div>
</div>