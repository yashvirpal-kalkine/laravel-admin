@extends('layouts.frontend')

@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!--  account section start here -->
    <section class="account-sec">
        <div class="container mt-4 mb-5">
            <h1 class="mb-4">My Account</h1>

            <div class="row">
                @include('profile.partials.sidebar')

                <!-- Main Content -->
                <div class="col-lg-9 col-md-8">
                    <div class="main-content">
                        <!-- Home Page -->
                        <div id="home-page" class="page-content">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <div class="stats-card">
                                        <i class="fas fa-shopping-cart"></i>
                                        <div class="number">3</div>
                                        <div class="label">Total orders</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="stats-card">
                                        <i class="fas fa-tag"></i>
                                        <div class="number">2</div>
                                        <div class="label">Discount coupons</div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span>You've got 1 item(s) waiting in your cart—click to <a href="#">Checkout
                                        now!</a></span>
                            </div>
                        </div>

                        <!-- Profile Page -->
                        <div id="profile-page" class="page-content" style="display:none;">
                            <h2 class="page-title">My profile</h2>
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First name</label>
                                        <input type="text" class="form-control" value="Yog">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last name</label>
                                        <input type="text" class="form-control" value="Raj">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" value="yograjwebdesigner123@gmail.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mobile</label>
                                        <input type="tel" class="form-control" value="+918628898414">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-custom">Update info</button>
                            </form>

                            <h3 class="page-title mt-5 mb-4">Addresses</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="address-card">
                                        <span class="badge">Default</span>
                                        <h5 id="savedName">Yog Raj</h5>
                                        <p class="text-muted" id="savedCountry">India</p>

                                        <div class="address-actions">
                                            <button class="edit-address-btn"><i class="fas fa-edit"></i></button>
                                            <button><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add New Address Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="add-address-card" id="addNewAddressBtn">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p class="text-muted mb-0">+ Add new address</p>
                                    </div>
                                </div>

                            </div>

                            <div id="addressFormWrapper" class="mt-4" style="display:none;">

                                <h4 class="mb-3" id="formTitle">Add Address</h4>

                                <form id="addressForm">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>First name</label>
                                            <input type="text" class="form-control" id="firstName"
                                                placeholder="Enter First Name">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Last name</label>
                                            <input type="text" class="form-control" id="lastName"
                                                placeholder="Enter Last Name">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Company</label>
                                            <input type="text" class="form-control" placeholder="Company name">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="Enter address">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Apartment, suite, etc.</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter apartment, suite, etc.">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label>City</label>
                                            <input type="text" class="form-control" placeholder="Enter city">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label>Country/Region</label>
                                            <select class="form-control" id="country">
                                                <option>Select country/region</option>
                                                <option value="India">India</option>
                                                <option value="USA">USA</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label>Postal/Zip code</label>
                                            <input type="text" class="form-control" placeholder="Enter postal/zip code">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Phone</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter phone number with country code">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label><input type="checkbox"> Set as default address</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save address</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        id="cancelFormBtn">Cancel</button>
                                </form>

                            </div>

                        </div>

                        <!-- Orders Page -->
                        <div id="orders-page" class="page-content" style="display:none;">
                            <h2 class="page-title">My orders</h2>
                            <div class="row mb-4">
                                <div class="col-md-4 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro1.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">7 Chakra Pendant in Clear Quartz</a> </h6>
                                            <div class="product-price">Rs.690.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro2.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision 7 Mukhi Rudraksha With Silver</a> </h6>
                                            <div class="product-price">Rs. 690.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro3.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision 7 Stone Tree</a> </h6>
                                            <div class="product-price">Rs. 690.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="page-title">Suggested to you</h3>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro9.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Sleep & Anxiety Healing Bracelet</a> </h6>
                                            <div class="product-price">Rs. 850.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro10.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Small Evil Eye Hanger</a> </h6>
                                            <div class="product-price">Rs. 400.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro11.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Smoky Quartz Bracelet</a> </h6>
                                            <div class="product-price">Rs. 150.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro12.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Strawberry Quartz Bracelet</a> </h6>
                                            <div class="product-price">Rs. 150.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Review Page -->
                        <div id="review-page" class="page-content" style="display:none;">
                            <h2 class="page-title">Product review</h2>
                            <div class="text-center py-5">
                                <i class="fas fa-star" style="font-size: 40px; color: #ffaa3d; margin-bottom: 20px;"></i>
                                <p class="text-muted">No products to review yet. Make a purchase to leave a review!</p>
                            </div>
                        </div>

                        <!-- Product Recommendations Page -->
                        <div id="recommendations-page" class="page-content" style="display:none;">
                            <h2 class="page-title">Product recommendations</h2>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro9.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Sleep & Anxiety Healing Bracelet</a> </h6>
                                            <div class="product-price">Rs. 850.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro10.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Small Evil Eye Hanger</a> </h6>
                                            <div class="product-price">Rs. 400.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro11.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Smoky Quartz Bracelet</a> </h6>
                                            <div class="product-price">Rs. 150.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <div class="product-card">
                                        <img src="assets/images/pro12.jpg" alt="Product">
                                        <div class="product-card-body">
                                            <h6> <a href="#">Jovial Vision Strawberry Quartz Bracelet</a> </h6>
                                            <div class="product-price">Rs. 150.00</div>
                                            <button class="btn-buy">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Membership Page -->
                        <div id="membership-page" class="page-content" style="display:none;">
                            <h2 class="page-title">Membership</h2>
                            <div class="text-center py-5">
                                <i class="fas fa-award" style="font-size: 60px; color: #ffaa3d; margin-bottom: 20px;"></i>
                                <h4 class="mb-3">No Active Membership</h4>
                                <p class="text-muted mb-4">Join our exclusive membership program to get special benefits and
                                    discounts!</p>
                                <button class="btn btn-primary-custom">Explore Membership Plans</button>
                            </div>
                        </div>

                        <!-- Change Password Page -->
                        <div id="password-page" class="page-content" style="display:none;">
                            <h2 class="page-title">Change password</h2>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">New password</label>
                                            <input type="password" class="form-control" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Confirm new password</label>
                                            <input type="password" class="form-control" placeholder="Re-enter password">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-custom">Change password</button>
                            </form>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  account section end here -->

@endsection



{{--  
<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->
--}}