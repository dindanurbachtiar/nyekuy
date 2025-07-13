@extends('layouts.app')

@section('title', 'Laporan Pendapatan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chart-bar text-success me-2"></i>Laporan Pendapatan</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Laporan Keuangan</h5>
                    <p class="text-muted">Analisis pendapatan dan laporan keuangan.</p>
                    
                    <!-- Placeholder content -->
                    <div class="text-center py-5">
                        <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Modul Laporan Pendapatan akan dikembangkan di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection