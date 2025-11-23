<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');

        // 🧍‍♂️ Admin Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // 🚪 Logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('users.addresses', \App\Http\Controllers\Admin\AddressController::class)->shallow();




        // Categories
        Route::resource('product-categories', \App\Http\Controllers\Admin\ProductCategoryController::class);

        // Tags
        Route::resource('product-tags', \App\Http\Controllers\Admin\ProductTagController::class);

        // Products
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Orders
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

        // Coupons
        Route::resource('coupons', \App\Http\Controllers\Admin\CouponController::class);

        // Invoices
        Route::get('transactions/{transaction}/invoice', [\App\Http\Controllers\Admin\TransactionController::class, 'invoice'])->name('transactions.invoice');
        Route::resource('transactions', \App\Http\Controllers\Admin\TransactionController::class);

        Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class);
        Route::resource('blog-tags', \App\Http\Controllers\Admin\BlogTagController::class);
        Route::resource('blog-posts', \App\Http\Controllers\Admin\BlogPostController::class);

        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::resource('calculators', \App\Http\Controllers\Admin\CalculatorController::class);
        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
        Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
        Route::resource('global-sections', App\Http\Controllers\Admin\GlobalSectionController::class);


        //Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
