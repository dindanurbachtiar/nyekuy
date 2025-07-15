@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')
<div class="container mx-auto py-12">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Sistem Pembayaran</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Detail Pesanan</h2>
            <div class="flex justify-between items-center text-lg mb-6">
                <span class="text-gray-600">Total Pesanan:</span>
                <span class="font-bold text-2xl text-blue-600">
                    Rp. {{ number_format($orderTotal, 0, ',', '.') }}
                </span>
            </div>
            
            <button onclick="openPaymentModal({{ $orderTotal }})" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-credit-card mr-2"></i>
                Bayar Sekarang
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <i class="fas fa-shield-alt text-3xl text-green-500 mb-4"></i>
                <h3 class="font-semibold text-gray-800 mb-2">Aman & Terpercaya</h3>
                <p class="text-gray-600 text-sm">Pembayaran dilindungi dengan enkripsi tingkat tinggi</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <i class="fas fa-bolt text-3xl text-yellow-500 mb-4"></i>
                <h3 class="font-semibold text-gray-800 mb-2">Proses Cepat</h3>
                <p class="text-gray-600 text-sm">Transaksi diproses dalam hitungan detik</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <i class="fas fa-mobile-alt text-3xl text-blue-500 mb-4"></i>
                <h3 class="font-semibold text-gray-800 mb-2">Multi Platform</h3>
                <p class="text-gray-600 text-sm">Mendukung berbagai metode pembayaran digital</p>
            </div>
        </div>
    </div>
</div>
@endsection