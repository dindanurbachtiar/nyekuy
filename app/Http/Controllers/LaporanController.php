<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Transaksi; // Tambahkan ini jika Anda ingin mengambil data transaksi di sini

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        // Filter berdasarkan tahun
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('tgl_laporan', $request->year);
        }

        // Filter berdasarkan jenis laporan (misalnya cek dari kode_transaksi)
        // Ini mungkin perlu disesuaikan jika 'type' merujuk ke sesuatu selain kode_transaksi
        if ($request->has('type') && $request->type != '') {
            $query->where('kode_transaksi', 'like', "%{$request->type}%");
        }

        // Ambil semua hasil
        $Laporann = $query->get(); // Variabel ini sebaiknya dinamai $laporans (plural)

        // Hitung total pendapatan
        $totalPendapatan = $Laporann->sum('pendapatan');

        return view('modules.reports', compact('Laporann', 'totalPendapatan'));
    }

    // Anda bisa menambahkan metode untuk membuat laporan secara manual atau terjadwal di sini
    // public function generateReportManually(Request $request) { ... }
}
