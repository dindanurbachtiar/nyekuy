<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBaku = BahanBaku::all();
        return view('modules.materials', compact('bahanBaku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bahan' => 'required|unique:bahan_baku,kode_bahan',
            'nama_bahan' => 'required',
            'stok' => 'required|numeric',
        ]);

        BahanBaku::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $kode_bahan)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'stok' => 'required|numeric',
        ]);

        $bahan = BahanBaku::findOrFail($kode_bahan);
        $bahan->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function getOne($kode_bahan)
    {
        return BahanBaku::findOrFail($kode_bahan);
    }

    public function destroy($kode_bahan)
    {
        $bahan = BahanBaku::find($kode_bahan);
        if (!$bahan) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }

        $bahan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
