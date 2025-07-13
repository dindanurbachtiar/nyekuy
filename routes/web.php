<?php
// routes/web.php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within the "web" middleware group. Now create something great!
|
*/

// Rute untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login (POST request)
Route::post('/login', [AuthController::class, 'login']);

// Rute yang memerlukan autentikasi (misal: dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Pastikan Anda memiliki file resources/views/dashboard.blade.php
    })->name('dashboard');

    // Rute untuk logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Redirect root URL ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});
