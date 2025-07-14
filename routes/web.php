<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kamu mendefinisikan semua route untuk aplikasi.
| File ini dimuat oleh RouteServiceProvider.
|
*/

// 🔐 Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Group route yang membutuhkan autentikasi (harus login)
Route::middleware('auth')->group(function () {

    // 🏠 Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 📦 Modul-modul lain
    Route::prefix('modules')->group(function () {

        // Modul Pemesanan
        Route::get('/orders', function () {
            return view('modules.orders');
        })->name('orders.index');

        // Modul Bahan Baku
        Route::get('/materials', function () {
            return view('modules.materials');
        })->name('materials.index');

        // Modul Laporan Pendapatan
        Route::get('/reports', function () {
            return view('modules.reports');
        })->name('reports.index');
    });

    // 🔓 Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 🔁 Redirect dari root ke login
Route::get('/', function () {
    return redirect()->route('login');
});
