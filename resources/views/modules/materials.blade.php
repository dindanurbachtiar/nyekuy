@extends('layouts.app')

@section('title', 'Bahan Baku')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-boxes text-warning me-2"></i>Bahan Baku</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Bahan Baku</h5>
                    <p class="text-muted">Kelola inventori dan stok bahan baku.</p>
                    
                    <!-- Placeholder content -->
                    <div class="text-center py-5">
                        <i class="fas fa-warehouse fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Modul Bahan Baku akan dikembangkan di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection