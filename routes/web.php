<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';





// Home & search
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Products
Route::prefix('products')->group(function () {
    //http://localhost:8000/products/details/sample-product-1
    // Product details (slug always last) - MUST BE FIRST
    Route::get('details/{slug}', [HomeController::class, 'productDetails'])
        ->name('products.details');

    // http://localhost:8000/products/pisces
    // http://localhost:8000/products/shop-by-zodiac/pisces
    // Product list by category/sub-category
    Route::get('{categories?}', [HomeController::class, 'productList'])
        ->where('categories', '.*') // catch nested categories
        ->name('products.list');
});
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

    Route::post('add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
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

// Dynamic pages (keep last)
Route::get('/{slug}', [HomeController::class, 'page'])->name('page');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

});

require __DIR__ . '/auth.php';
