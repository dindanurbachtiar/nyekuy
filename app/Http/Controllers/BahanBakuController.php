<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBakus = BahanBaku::all();
        $menus = Menu::all();
        return view('modules.materials', compact('bahanBakus', 'menus'));
    }

    public function store(Request $request)
    {
        Log::info('Data diterima untuk store Bahan Baku: ', $request->all()); // Debugging

        $validated = $request->validate([
            'kode_bahan' => 'required|unique:bahan_baku,kode_bahan',
            'nama_bahan_baku' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0', // [PERBAIKAN] Validasi harga
        ]);

        BahanBaku::create($validated);

        return redirect()->back()->with('success', 'Data bahan baku berhasil ditambahkan');
    }

    public function show($kode)
    {
        $bahan = BahanBaku::where('kode_bahan', $kode)->first();
        if ($bahan) {
            return response()->json($bahan);
        }

        $menu = Menu::where('kode_menu', $kode)->first();
        if ($menu) {
            return response()->json($menu);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }

    public function update(Request $request, $kode_bahan)
    {
        Log::info('Data diterima untuk update Bahan Baku: ', $request->all()); // Debugging

        $validated = $request->validate([
            'nama_bahan_baku' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0', // [PERBAIKAN] Validasi harga
        ]);

        $bahan = BahanBaku::where('kode_bahan', $kode_bahan)->firstOrFail();
        $bahan->update($validated);

        return redirect()->back()->with('success', 'Data bahan baku berhasil diperbarui');
    }

    public function destroy($kode_bahan)
    {
        $bahan = BahanBaku::where('kode_bahan', $kode_bahan)->firstOrFail();
        $bahan->delete();

        return redirect()->route('materials.index')->with('success', 'Bahan baku berhasil dihapus');
    }

    public function storeMinuman(Request $request)
    {
        Log::info('Data diterima untuk storeMinuman: ', $request->all());

        $validated = $request->validate([
            'kode_menu' => 'required|unique:menu_minuman,kode_menu',
            'nama_menu' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        Menu::create($validated);

        return redirect()->back()->with('success', 'Menu minuman berhasil ditambahkan');
    }

    public function updateMinuman(Request $request, $kode_menu)
    {
        Log::info('Data diterima untuk updateMinuman: ', $request->all());
        Log::info('Kode Menu yang akan diupdate: ' . $kode_menu);

        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $menu = Menu::where('kode_menu', $kode_menu)->firstOrFail();

        Log::info('Menu sebelum update: ', $menu->toArray());

        $menu->update($validated);

        Log::info('Menu setelah update: ', $menu->toArray());

        return redirect()->back()->with('success', 'Menu minuman berhasil diperbarui');
    }

    public function destroyMinuman($kode_menu)
    {
        $menu = Menu::where('kode_menu', $kode_menu)->firstOrFail();
        $menu->delete();

        return redirect()->back()->with('success', 'Menu minuman berhasil dihapus');
    }
}