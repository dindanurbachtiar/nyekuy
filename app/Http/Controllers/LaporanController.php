<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

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
        if ($request->has('type') && $request->type != '') {
            $query->where('kode_transaksi', 'like', "%{$request->type}%");
        }

        // Ambil semua hasil
        $Laporann = $query->get();

        // Hitung total pendapatan
        $totalPendapatan = $Laporann->sum('pendapatan');

        return view('modules.reports', compact('Laporann', 'totalPendapatan'));
    }

}
