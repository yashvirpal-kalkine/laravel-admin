<?php

use App\Http\Controllers\Admin\Auth\LoginController;
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

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
