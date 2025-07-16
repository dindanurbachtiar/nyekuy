@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="receipt border rounded shadow-sm p-4 bg-white" style="max-width: 360px; width: 100%; font-family: monospace;">
        
        <!-- Header -->
        <div class="text-center mb-3">
            <div class="mb-2">
                <i class="fas fa-check-circle text-success fa-2x"></i>
            </div>
            <h5 class="mb-0">Pembayaran Berhasil</h5>
            <small class="text-muted">Transaksi Tunai Selesai</small>
        </div>

        <hr>

        <!-- Detail Transaksi -->
        <div class="mb-2 d-flex justify-content-between">
            <span>ID Transaksi:</span>
            <span>{{ $paymentData['transaction_id'] }}</span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Total Pesanan:</span>
            <span>Rp {{ number_format($paymentData['order_total'], 0, ',', '.') }}</span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Uang Dibayarkan:</span>
            <span>Rp {{ number_format($paymentData['paid_amount'], 0, ',', '.') }}</span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Kembalian:</span>
            <span>Rp {{ number_format($paymentData['change_amount'], 0, ',', '.') }}</span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Metode:</span>
            <span>Tunai</span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Status:</span>
            <span class="text-success">Selesai</span>
        </div>
        <div class="mb-4 d-flex justify-content-between">
            <span>Waktu:</span>
            <span>{{ $paymentData['payment_date']->format('d/m/Y H:i:s') }}</span>
        </div>

        <hr>

        <!-- Kembalian Besar -->
        @if($paymentData['change_amount'] > 0)
        <div class="text-center mb-4">
            <strong class="d-block">Kembalian:</strong>
            <span class="fs-4 text-danger">Rp {{ number_format($paymentData['change_amount'], 0, ',', '.') }}</span>
        </div>
        @endif

        <!-- Tombol Aksi -->
        <div class="d-grid gap-2">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-1"></i> Cetak Struk
            </button>
                <a href="{{ url('/modules/orders') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> Transaksi Baru
            </a>
        </div>
    </div>
</div>

<!-- Gaya Cetak -->
<style>
@media print {
    body * {
        visibility: hidden;
    }
    .receipt, .receipt * {
        visibility: visible;
    }
    .receipt {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        font-size: 12px;
    }
    .btn, a {
        display: none !important;
    }
}
</style>
@endsection
