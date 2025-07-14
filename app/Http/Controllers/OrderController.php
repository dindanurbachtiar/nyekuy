<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\NotaPesanan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('modules.orders', compact('menus'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'kode_menu' => 'required|string|unique:menu,kode_menu',
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer|min:0'
        ]);

        $menu = Menu::create([
            'kode_menu' => $request->kode_menu,
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'bahan_baku' => null,
            'kode_bahan' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil ditambahkan!',
            'data' => $menu
        ]);
    }

    public function update(Request $request, $kode_menu): JsonResponse
    {
        $menu = Menu::findOrFail($kode_menu);

        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer|min:0'
        ]);

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diupdate!',
            'data' => $menu
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        $menus = Menu::where('nama_menu', 'LIKE', "%{$query}%")
                    ->orWhere('kode_menu', 'LIKE', "%{$query}%")
                    ->get();

        return response()->json($menus);
    }

    public function processOrder(Request $request): JsonResponse
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.kode_menu' => 'required|string',
            'items.*.nama_menu' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|integer|min:0'
        ]);

        $kodeTransaksi = 'TRX' . date('YmdHis') . rand(100, 999);
        $idPelayan = auth()->user()->id ?? 'PELAYAN001'; // Assuming user is logged in

        // Save each item to nota_pesanan
        foreach ($request->items as $item) {
            $kodePesanan = 'PSN' . date('YmdHis') . rand(100, 999);
            
            NotaPesanan::create([
                'kode_pesanan' => $kodePesanan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'jumlah_pesanan' => $item['quantity'],
                'nama_menu' => $item['nama_menu'],
                'kode_menu' => $item['kode_menu'],
                'id_pelayan' => $idPelayan
            ]);
        }

        // Save to laporan
        $kodeLaporan = 'LAP' . date('YmdHis') . rand(100, 999);
        
        Laporan::create([
            'kode_laporan' => $kodeLaporan,
            'tgl_laporan' => Carbon::now()->toDateString(),
            'pendapatan' => $request->total,
            'kode_transaksi' => $kodeTransaksi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diproses!',
            'kode_transaksi' => $kodeTransaksi
        ]);
    }
}
