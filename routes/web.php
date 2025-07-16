<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PaymentController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware auth
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders Page
    Route::get('/modules/orders', [OrderController::class, 'index'])->name('orders.index');

    // Orders CRUD (Store & Update)
    Route::resource('modules/orders', OrderController::class)
        ->only(['store', 'update'])
        ->parameters(['orders' => 'kode_menu']);

    // Search menu (AJAX)
    Route::get('/modules/orders/search', [OrderController::class, 'search'])->name('orders.search');

    // Materials
    Route::get('/modules/materials', [BahanBakuController::class, 'index'])->name('materials.index');

    // Bahan Baku CRUD
    Route::post('/bahan-baku', [BahanBakuController::class, 'store']);
    Route::get('/bahan-baku/get/{kode_bahan}', [BahanBakuController::class, 'getOne']);
    Route::put('/bahan-baku/{kode_bahan}', [BahanBakuController::class, 'update']);
    Route::delete('/bahan-baku/{kode_bahan}', [BahanBakuController::class, 'destroy']);

    // Payment
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/calculate-change', [PaymentController::class, 'calculateChange'])->name('payment.calculate');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    // Reports
    Route::get('/modules/reports', function () {
        return view('modules.reports');
    })->name('reports.index');
});
