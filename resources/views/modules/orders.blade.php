@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-cash-register text-primary me-2"></i>Pemesanan</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pemesanan</h5>
                    <p class="text-muted">Kelola semua pemesanan pelanggan di sini.</p>
                    
                    <!-- Placeholder content -->
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Modul Pemesanan akan dikembangkan di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection