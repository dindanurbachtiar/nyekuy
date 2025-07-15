<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// 🔐 Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Group route yang membutuhkan autentikasi (harus login)
Route::middleware('auth')->group(function () {

    // 🏠 Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 📦 Modul-modul lain
    Route::prefix('modules')->group(function () {
        Route::get('/orders', function () {
            return view('modules.orders');
        })->name('orders.index');

        Route::get('/materials', function () {
            return view('modules.materials');
        })->name('materials.index');

        Route::get('/reports', function () {
            return view('modules.reports');
        })->name('reports.index');
    });

    // 💳 Modul Pembayaran
    Route::get('/', function () {
        return redirect()->route('payment.form');
    });

    Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/', [PaymentController::class, 'showPaymentForm'])->name('form');
    Route::post('/process', [PaymentController::class, 'processPayment'])->name('process');
    Route::post('/calculate-change', [PaymentController::class, 'calculateChange'])->name('calculate.change');
    Route::get('/success', [PaymentController::class, 'paymentSuccess'])->name('success');
});


    // 🔓 Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 🔁 Redirect dari root ke halaman login jika belum login
Route::get('/', function () {
    return redirect()->route('login');
});
