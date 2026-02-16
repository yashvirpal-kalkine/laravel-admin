<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Api\GeoLocationController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';





// Home & search
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::post('/get-variant-price', [HomeController::class, 'getVariantPrice']);


Route::post('/get-variant-price', [HomeController::class, 'getVariantPrice'])->name('product.variant.price');


// Products
Route::prefix('products')->group(function () {
    //http://localhost:8000/products/details/sample-product-1
    // Product details (slug always last) - MUST BE FIRST
    Route::get('details/{slug}', [HomeController::class, 'productDetails'])->name('products.details');

    Route::post('/products/load', [HomeController::class, 'load'])->name('products.load');


    // http://localhost:8000/products/pisces
    // http://localhost:8000/products/shop-by-zodiac/pisces
    // Product list by category/sub-category
    Route::get('{categories?}', [HomeController::class, 'productList'])
        ->where('categories', '.*') // catch nested categories
        ->name('products.list');
});
// Route::prefix('cart')->group(function () {
//     //Route::get('/', [HomeController::class, 'index'])->name('cart.index');

//     Route::post('add/{product}', [CartController::class, 'add'])->name('cart.add');
//     Route::post('update/{product}', [CartController::class, 'update'])->name('cart.update');
//     Route::delete('remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
//     Route::get('mini', [CartController::class, 'mini'])->name('cart.mini');
//     Route::get('/cart/product-qty/{product}', [CartController::class, 'productQty'])->name('cart.productQty');
// });



Route::prefix('cart')->name('cart.')->group(function () {
   // Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/mini', [CartController::class, 'mini'])->name('mini');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::put('/update/{itemId}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{itemId}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    
    Route::post('/coupon/apply', [CartController::class, 'applyCoupon'])->name('coupon.apply');
    Route::delete('/coupon/{couponId}', [CartController::class, 'removeCoupon'])->name('coupon.remove');
});


Route::prefix('checkout')->name('checkout.')->group(function () {
   
    Route::post('/login', [CheckoutController::class, 'login'])->name('login');
    Route::post('/shipping', [CheckoutController::class, 'updateShipping'])->name('shipping');
    Route::post('/process', [CheckoutController::class, 'checkOut'])->name('process');
});




// Blog
Route::prefix('blog')->group(function () {
    // Blog post details
    Route::get('post/{slug}', [HomeController::class, 'blogDetails'])
        ->name('blog.details');
    // Blog list by category/sub-category
    Route::get('{categories?}', [HomeController::class, 'blogList'])
        ->where('categories', '.*') // catch nested categories
        ->name('blog.list');
});
//Route::post('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/wishlistcount', [WishlistController::class, 'count'])->name('wishlist.count');


Route::post('/checkout/login', [CheckoutController::class, 'login'])->name('checkoutLogin');
Route::post('/checkout/create-order', [CheckoutController::class, 'checkOut'])->name('createOrder');


Route::post('/contact-form-submit', [HomeController::class, 'contactFormSubmit'])->name('contact.submit');
Route::post('/newsletter/subscribe', [HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
Route::get('/sitemap.xml', [HomeController::class, 'sitemapXML'])->name('sitemapxml');

Route::get('/api/geo/country', [GeoLocationController::class, 'getCountry'])->name('api.geo.country');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [ProfileController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [ProfileController::class, 'show'])->name('orders.show');

    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});



use App\Http\Controllers\UserProfileController;


Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/', [UserProfileController::class, 'profile'])->name('edit');
    Route::put('/update', [UserProfileController::class, 'updateProfile'])->name('update');
    Route::put('/password', [UserProfileController::class, 'updatePassword'])->name('password.update');

    // Addresses
    Route::get('/addresses', [UserProfileController::class, 'addresses'])->name('addresses');
    Route::get('/addresses/create', [UserProfileController::class, 'createAddress'])->name('addresses.create');
    Route::post('/addresses', [UserProfileController::class, 'storeAddress'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [UserProfileController::class, 'editAddress'])->name('addresses.edit');
    Route::put('/addresses/{address}', [UserProfileController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('/addresses/{address}', [UserProfileController::class, 'deleteAddress'])->name('addresses.destroy');
    Route::post('/addresses/{address}/default', [UserProfileController::class, 'makeDefaultAddress'])->name('addresses.default');

    // Orders
    Route::get('/orders', [UserProfileController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [UserProfileController::class, 'orderDetail'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [UserProfileController::class, 'cancelOrder'])->name('orders.cancel');

    // Transactions
    Route::get('/transactions', [UserProfileController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{id}', [UserProfileController::class, 'transactionDetail'])->name('transactions.show');
});

// Dynamic pages (keep last)
Route::get('/{slug}', [HomeController::class, 'page'])->name('page');

require __DIR__ . '/auth.php';
