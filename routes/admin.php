<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

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
        Route::resource('tags', \App\Http\Controllers\Admin\AddressController::class);

        // Products
        Route::resource('products', \App\Http\Controllers\Admin\AddressController::class);

        // Orders
        Route::resource('orders', \App\Http\Controllers\Admin\AddressController::class);

        // Invoices
        Route::resource('invoices', \App\Http\Controllers\Admin\AddressController::class);

        Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class);
        Route::resource('blog-tags', \App\Http\Controllers\Admin\BlogTagController::class);
        Route::resource('blog-posts', \App\Http\Controllers\Admin\BlogPostController::class);

        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::resource('transactions', \App\Http\Controllers\Admin\AddressController::class);
        // // Categories
        // Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        // // Tags
        // Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);

        // // Products
        // Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // // Orders
        // Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

        // // Invoices
        // Route::resource('invoices', \App\Http\Controllers\Admin\InvoiceController::class);

       
        // Route::resource('transactions', \App\Http\Controllers\Admin\TransactionController::class);

    });
});
