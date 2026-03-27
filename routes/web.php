<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Password Reset Routes
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/advice', [DashboardController::class, 'sendAdvice'])->name('dashboard.advice');
    
    // Account Management
    Route::delete('/account/clear', [DashboardController::class, 'clearInventory'])->name('account.clear');
    Route::delete('/account/delete', [DashboardController::class, 'deleteAccount'])->name('account.delete');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'store', 'destroy']);
});

// Diagnostic Routes
Route::get('/test-email', function () {
    $product = \App\Models\Product::first();
    if (!$product) return "No product found. Seed the database first.";
    
    Mail::to('sam_k@example.com')->send(new \App\Mail\LowStockNotification($product));
    return "Email sent! Check Resend dashboard.";
});
