<!-- header section start here -->
<header>
    <div class="top-header-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-header-wrap">
                        <div class="top-left">
                            <div class="offer-slider owl-carousel">
                                <div class="item"> <p>Get 30% Off On Selected Items</p> </div>
                                <div class="item"> <p>Free Shipping on Orders Above ₹999</p> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-header-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="middle-header-wrap">
                        <div class="left-logo">
                            <figure> <a href="#"> <img src="{{ asset('frontend/assets/images/logo.webp') }}"> </a>
                            </figure>
                        </div>
                        <div class="middle-right">
                            <div class="search-box">
                                <form>
                                    <div class="input-group">
                                        <input type="text" name="" placeholder="Search">
                                        <button><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="login-box">
                                <ul>
                                    <li><a class="topwish" href="#"><i class="fa fa-heart hidden-md hidden-lg hidden-sm"></i></a></li>
                                    <li> <a href="#"> <i class="fas fa-user"></i> </a> </li>

                                    <li class="dropdown cart-dropdown"> <a href="#" class="cart-toggle"> <i class="fas fa-shopping-bag"></i>
                                        </a>
                                        <span id="cartCount">3</span>
                                        <div class=" cart-box">
                                            <div class="cart-header">
                                                <span>Shopping Cart</span>
                                                <a href="#" class="cart-close">×</a>
                                            </div>

                                            <div class="product">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="#">7 Chakra Pendant in Clear Quartz</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span class="cart-product-qty">1</span>
                                                        × ₹799
                                                    </span>
                                                </div>

                                                <figure class="product-image-container">
                                                    <a href="#" class="product-image">
                                                        <img src="{{ asset('frontend/assets/images/pro1.jpg') }}"
                                                            alt="product" width="80" height="80">
                                                    </a>

                                                    <a href="#" class="btn-remove"
                                                        title="Remove Product"><span>×</span></a>
                                                </figure>
                                            </div>

                                            <div class="product">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="#">Jovial Vision 7 Mukhi Rudraksha With Silver</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span class="cart-product-qty">1</span>
                                                        × ₹450
                                                    </span>
                                                </div>

                                                <figure class="product-image-container">
                                                    <a href="#" class="product-image">
                                                        <img src="{{ asset('frontend/assets/images/pro2.jpg') }}"
                                                            alt="product" width="80" height="80">
                                                    </a>

                                                    <a href="#" class="btn-remove"
                                                        title="Remove Product"><span>×</span></a>
                                                </figure>
                                            </div>

                                            <div class="product">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="#">Jovial Vision 7 Stone Tree</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span class="cart-product-qty">1</span>
                                                        × ₹799
                                                    </span>
                                                </div>

                                                <figure class="product-image-container">
                                                    <a href="#" class="product-image">
                                                        <img src="{{ asset('frontend/assets/images/pro3.jpg') }}"
                                                            alt="product" width="80" height="80">
                                                    </a>

                                                    <a href="#" class="btn-remove"
                                                        title="Remove Product"><span>×</span></a>
                                                </figure>
                                            </div>

                                            <div class="cart-footer">
                                                <div class="subtotal">
                                                    <span>Subtotal:</span>
                                                    <strong>$13400.00</strong>
                                                </div>

                                                <a href="#" class="btn view-cart">View Cart</a>
                                                <a href="#" class="btn checkout">Checkout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="menu-wrapper">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mx-auto">

                                    <!--  PRODUCTS WITH SUBMENU -->
                                    <li class="nav-item products-parent position-relative">
                                        <a href="#" class="products-toggle">
                                            <i class="fas fa-box"></i> Products
                                            <i class="fas fa-chevron-down mobile-arrow"></i>
                                        </a>

                                        <!-- SUBMENU -->
                                        <ul class="products-submenu">
                                            <li><a href="#">Bracelets</a></li>
                                            <li><a href="#">Rudraksha</a></li>
                                            <li><a href="#">Pyrite</a></li>
                                            <li><a href="#">Stone</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item zodiac-parent">
                                        <a href="#" class="zodiac-toggle">
                                            <i class="fas fa-bullseye"></i> Shop By Concern
                                            <i class="fas fa-chevron-down mobile-arrow"></i>
                                        </a>

                                        <div class="mega-menu">

                                            <div class="zodiac-grid">
                                                <div class="z-item"> <a href="#"><img
                                                            src="{{ asset('frontend/assets/images/s1.jpg') }}">
                                                        <p>Love</p>
                                                    </a> </div>
                                                <div class="z-item"> <a href="#"><img
                                                            src="{{ asset('frontend/assets/images/s2.jpg') }}">
                                                        <p>Money</p>
                                                    </a> </div>
                                                <div class="z-item"> <a href="#"><img
                                                            src="{{ asset('frontend/assets/images/s3.jpg') }}">
                                                        <p>Career</p>
                                                    </a> </div>
                                                <div class="z-item"> <a href="#"><img
                                                            src="{{ asset('frontend/assets/images/s4.jpg') }}">
                                                        <p>Health</p>
                                                    </a> </div>
                                                <div class="z-item"> <a href="#"><img
                                                            src="{{ asset('frontend/assets/images/s5.jpg') }}">
                                                        <p>Marriage</p>
                                                    </a> </div>
                                                <div class="z-item"> <a href="#"><img
                                                            src="{{ asset('frontend/assets/images/s6.jpg') }}">
                                                        <p>Gifts</p>
                                                    </a> </div>
                                            </div>

                                        </div>
                                    </li>

                                    <!--  ZODIAC MEGA MENU -->
                                    <li class="nav-item zodiac-parent">
                                        <a href="#" class="zodiac-toggle">
                                            <i class="fas fa-sun"></i> Shop by Zodiac
                                            <i class="fas fa-chevron-down mobile-arrow"></i>
                                        </a>

                                        <div class="mega-menu">

                                            <div class="zodiac-grid">
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m1.png') }}">
                                                        <p>Aries</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m2.png') }}">
                                                        <p>Taurus</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m3.png') }}">
                                                        <p>Gemini</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m4.png') }}">
                                                        <p>Cancer</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m5.png') }}">
                                                        <p>Leo</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m6.png') }}">
                                                        <p>Virgo</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m7.png') }}">
                                                        <p>Libra</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m8.png') }}">
                                                        <p>Scorpio</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m9.png') }}">
                                                        <p>Sagittarius</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m10.png') }}">
                                                        <p>Capricorn</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m11.png') }}">
                                                        <p>Aquarius</p>
                                                    </a></div>
                                                <div class="z-item"><a href="#"><img
                                                            src="{{ asset('frontend/assets/images/m12.png') }}">
                                                        <p>Pisces</p>
                                                    </a></div>
                                            </div>

                                        </div>
                                    </li>

                                    <!-- OTHER MENU ITEMS -->
                                    <li class="nav-item">
                                        <a href="#"><i class="fas fa-ring"></i> Customised Bracelets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"><i class="fas fa-gift"></i> Corporate Gifts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"><i class="fas fa-om"></i> Puja Needs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"><i class="fas fa-id-card"></i> Membership Plans</a>
                                    </li>

                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header section end here -->