<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LaporanController;

// Redirect root ke login
Route::get('/', fn () => redirect()->route('login'));

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk pengguna yang sudah login
Route::middleware('auth:pelayan')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Orders (Pesanan)
     */
    Route::get('/modules/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::resource('/modules/orders', OrderController::class)
        ->only(['store', 'update'])
        ->parameters(['orders' => 'kode_menu']);

    // AJAX search
    Route::get('/modules/orders/search', [OrderController::class, 'search'])->name('orders.search');

    // Proses order
    Route::post('/modules/orders/process', [OrderController::class, 'processOrder'])->name('orders.process');

    // Riwayat dan detail order
    Route::get('/modules/orders/history', [OrderController::class, 'orderHistory'])->name('orders.history');
    Route::get('/modules/orders/detail/{kodePesanan}', [OrderController::class, 'orderDetail'])->name('orders.detail');
    Route::put('/modules/orders/status/{kodePesanan}', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    /**
     * Materials (Bahan Baku)
     */
    Route::get('/modules/materials', [BahanBakuController::class, 'index'])->name('materials.index');
    Route::post('/bahan-baku', [BahanBakuController::class, 'store']);
    Route::get('/bahan-baku/get/{kode_bahan}', [BahanBakuController::class, 'getOne']);
    Route::put('/bahan-baku/{kode_bahan}', [BahanBakuController::class, 'update']);
    Route::delete('/bahan-baku/{kode_bahan}', [BahanBakuController::class, 'destroy']);
    Route::post('/menu-minuman', [BahanBakuController::class, 'storeMinuman']);
    Route::put('/menu-minuman/{kode_menu}', [BahanBakuController::class, 'updateMinuman']);
    Route::delete('/menu-minuman/{kode_menu}', [BahanBakuController::class, 'destroyMinuman']);


    /**
     * Payment
     */
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/calculate-change', [PaymentController::class, 'calculateChange'])->name('payment.calculate');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    /**
     * Reports
     */
    Route::get('/modules/reports', [LaporanController::class, 'index'])->name('reports.index');
});
