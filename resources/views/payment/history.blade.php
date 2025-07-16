@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>Riwayat Transaksi
                    </h5>
                    <div>
                        <a href="{{ route('payment.report') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-chart-bar me-1"></i>Laporan Harian
                        </a>
                        <a href="{{ route('payment.form') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Transaksi Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($transaksi->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Total Bayar</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Kembalian</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksi as $item)
                                    <tr>
                                        <td>
                                            <code>{{ $item->kode_transaksi }}</code>
                                        </td>
                                        <td>{{ $item->tgl_bayar->format('d/m/Y H:i') }}</td>
                                        <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->kembalian, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($item->metode_bayar) }}</span>
                                        </td>
                                        <td>
                                            @if($item->status == 'completed')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($item->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('payment.detail', $item->kode_transaksi) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $transaksi->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada transaksi</h5>
                            <p class="text-muted">Mulai transaksi pertama Anda</p>
                            <a href="{{ route('payment.form') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Buat Transaksi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
