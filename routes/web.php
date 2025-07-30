<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LaporanController;
use Illuminate\Http\Request; // Import Request untuk fungsi anonim di rute pembayaran

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk pengguna yang sudah login
Route::middleware('auth:pelayan')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Orders (Pesanan) & Menu Management
     */
    // Halaman utama pemesanan (menampilkan daftar menu)
    Route::get('/modules/orders', [OrderController::class, 'index'])->name('orders.index');

    // Rute resource untuk manajemen Menu (minuman)
    // Ini menangani POST (store), PUT (update), DELETE (destroy) untuk item menu
    Route::resource('/modules/orders', OrderController::class)
        ->only(['store', 'update', 'destroy']) // Tambahkan 'destroy' agar fungsi hapus menu bekerja
        ->parameters(['orders' => 'kode_menu']);

    // Rute baru untuk pencarian menu minuman (dari model Menu)
    Route::get('/modules/orders/search-menu', [OrderController::class, 'searchMenu'])->name('orders.search_menu');

    // Rute baru untuk pencarian bahan baku (dari model BahanBaku)
    Route::get('/modules/orders/search-bahan', [OrderController::class, 'searchBahan'])->name('orders.search_bahan');

    // Proses order (checkout dari keranjang)
    Route::post('/modules/orders/process', [OrderController::class, 'processOrder'])->name('orders.process');

    // Riwayat dan detail order
    Route::get('/modules/orders/history', [OrderController::class, 'orderHistory'])->name('orders.history');
    Route::get('/modules/orders/detail/{kodePesanan}', [OrderController::class, 'orderDetail'])->name('orders.detail');
    Route::put('/modules/orders/status/{kodePesanan}', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    /**
     * Materials (Bahan Baku) - Ini adalah rute terpisah untuk manajemen bahan baku
     */
    Route::get('/modules/materials', [BahanBakuController::class, 'index'])->name('materials.index');
    Route::post('/bahan-baku', [BahanBakuController::class, 'store']);
    Route::get('/bahan-baku/get/{kode_bahan}', [BahanBakuController::class, 'getOne']);
    Route::put('/bahan-baku/{kode_bahan}', [BahanBakuController::class, 'update']);
    Route::delete('/bahan-baku/{kode_bahan}', [BahanBakuController::class, 'destroy']);
    // Rute untuk manajemen menu minuman yang mungkin tumpang tindih dengan OrderController
    // Jika BahanBakuController juga mengelola menu minuman, pertimbangkan untuk mengkonsolidasikannya
    Route::post('/menu-minuman', [BahanBakuController::class, 'storeMinuman']);
    Route::put('/menu-minuman/{kode_menu}', [BahanBakuController::class, 'updateMinuman']);
    Route::delete('/menu-minuman/{kode_menu}', [BahanBakuController::class, 'destroyMinuman']);


    /**
     * Payment
     */
    // Rute untuk menampilkan form pembayaran (dipanggil setelah checkout dari keranjang)
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/calculate-change', [PaymentController::class, 'calculateChange'])->name('payment.calculate');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    /**
     * Reports
     */
    Route::get('/modules/reports', [LaporanController::class, 'index'])->name('reports.index');
    // Jika ada laporan harian di OrderController, tambahkan rutenya di sini
    Route::get('/modules/daily-report', [OrderController::class, 'dailyOrderReport'])->name('orders.dailyReport');

});