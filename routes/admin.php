<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Guest routes
        Route::middleware('guest:admin')->group(function () {
            Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
            Route::post('/login', [LoginController::class, 'login']);
        });

        // Authenticated admin routes
        Route::middleware('admin.auth')->group(function () {
            Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
            Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        });
    });
