<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Menu;

class BahanBakuController extends Controller
{
    /**
     * Tampilkan daftar bahan baku dan menu (jika perlu).
     */
    public function index()
    {
        $bahanBakus = BahanBaku::all();

        // Jika data menu tidak diperlukan di view, boleh dihapus
        $menus = Menu::all();

        return view('modules.materials', compact('bahanBakus', 'menus'));
    }

    /**
     * Simpan data bahan baku baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bahan'        => 'required|unique:bahan_baku,kode_bahan',
            'nama_bahan_baku'   => 'required|string|max:255',
            'stok'              => 'required|numeric|min:0',
        ]);

        BahanBaku::create($validated);

        return redirect()->back()->with('success', 'Data bahan baku berhasil ditambahkan');
    }

    /**
     * Tampilkan satu data bahan baku (biasanya untuk AJAX edit).
     */
    public function show($kode_bahan)
    {
        $bahan = BahanBaku::findOrFail($kode_bahan);
        return response()->json($bahan);
    }

    /**
     * Perbarui data bahan baku.
     */
    public function update(Request $request, $kode_bahan)
    {
        $validated = $request->validate([
            'nama_bahan_baku'   => 'required|string|max:255',
            'stok'              => 'required|numeric|min:0',
        ]);

        $bahan = BahanBaku::findOrFail($kode_bahan);
        $bahan->update($validated);

        return redirect()->back()->with('success', 'Data bahan baku berhasil diperbarui');
    }

    /**
     * Hapus data bahan baku.
     */
    public function destroy($kode_bahan)
    {
        $bahan = BahanBaku::findOrFail($kode_bahan);
        $bahan->delete();

        return redirect()->route('materials.index')->with('success', 'Bahan baku berhasil dihapus');
    }
}
