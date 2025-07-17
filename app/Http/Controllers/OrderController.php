<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\NotaPesanan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\Transaksi; // Pastikan ini diimpor
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr; // <<< TAMBAHKAN BARIS INI

class OrderController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('modules.orders', compact('menus'));
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'kode_menu' => 'required|string|unique:menus,kode_menu',
                'nama_menu' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0'
            ]);

            $menu = Menu::create([
                'kode_menu' => $request->kode_menu,
                'nama_menu' => $request->nama_menu,
                'harga' => $request->harga,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Menu berhasil ditambahkan!',
                'data' => $menu
            ]);

        } catch (ValidationException $e) {
            Log::error('Validasi gagal menambahkan menu', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', Arr::flatten($e->errors())) // <<< UBAH DI SINI
            ], 422);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan menu', ['error' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $kode_menu): JsonResponse
    {
        try {
            $menu = Menu::where('kode_menu', $kode_menu)->firstOrFail();

            $request->validate([
                'nama_menu' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0'
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

        } catch (ValidationException $e) {
            Log::error('Validasi gagal mengupdate menu', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', Arr::flatten($e->errors())) // <<< UBAH DI SINI
            ], 422);
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate menu', ['error' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($kode_menu): JsonResponse
    {
        try {
            $menu = Menu::where('kode_menu', $kode_menu)->firstOrFail();
            $menu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Menu berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus menu', ['error' => $e->getMessage(), 'kode_menu' => $kode_menu]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        $menus = Menu::where('nama_menu', 'LIKE', "%{$query}%")
                    ->orWhere('kode_menu', 'LIKE', "%{$query}%")
                    ->get();

        return response()->json($menus);
    }

    public function processOrder(Request $request): RedirectResponse | JsonResponse
    {
        Log::debug('Menerima permintaan processOrder', ['request_data' => $request->all()]);
        try {
            DB::beginTransaction();

            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'items' => 'required|array|min:1',
                'items.*.kode_menu' => 'required|string',
                'items.*.nama_menu' => 'required|string',
                'items.*.quantity' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0'
            ]);
            Log::debug('Validasi berhasil');

            $kodeTransaksi = Transaksi::generateKodeTransaksi(); 
            $totalPendapatan = 0;

            foreach ($request->items as $item) {
                Log::debug('Memproses item', ['item' => $item]);
                $kodePesanan = NotaPesanan::generateKodePesanan();
                
                $menu = Menu::where('kode_menu', $item['kode_menu'])->first();
                
                if (!$menu) {
                    Log::error('Menu tidak ditemukan', ['kode_menu' => $item['kode_menu']]);
                    throw new \Exception("Menu dengan kode {$item['kode_menu']} tidak ditemukan");
                }

                $hargaSatuan = $menu->harga;
                $totalHarga = $hargaSatuan * $item['quantity'];
                $totalPendapatan += $totalHarga;
                
                $dataToCreate = [
                    'kode_pesanan' => $kodePesanan,
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'nama_menu' => $item['nama_menu'],
                    'kode_menu' => $item['kode_menu'],
                    'jumlah_pesanan' => $item['quantity'],
                    'harga_satuan' => $hargaSatuan,
                    'total_harga' => $totalHarga,
                    'tanggal_pesanan' => Carbon::now('Asia/Jakarta'),
                    'status' => 'pending'
                ];
                Log::debug('Data untuk NotaPesanan creation', $dataToCreate);

                NotaPesanan::create($dataToCreate);
                Log::debug('Item disimpan ke NotaPesanan', ['kode_pesanan' => $kodePesanan]);
            }

            if (class_exists('App\Models\Laporan')) {
                $kodeLaporan = 'LAP-' . date('ymdHis') . '-' . rand(100, 999);
                
                Laporan::create([
                    'kode_laporan' => $kodeLaporan,
                    'tgl_laporan' => Carbon::now('Asia/Jakarta')->toDateString(),
                    'pendapatan' => $totalPendapatan,
                    'kode_transaksi' => $kodeTransaksi
                ]);
                Log::debug('Data disimpan ke Laporan', ['kode_laporan' => $kodeLaporan]);
            }

            DB::commit();
            Log::info('Pesanan berhasil diproses', [
                'kode_transaksi' => $kodeTransaksi,
                'nama_pelanggan' => $request->nama_pelanggan,
                'total_items' => count($request->items),
                'total_pendapatan' => $totalPendapatan
            ]);

            return redirect()->route('payment.form', ['order_total' => $totalPendapatan]);

        } catch (ValidationException $e) {
            Log::error('Validasi pesanan gagal', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Data pesanan tidak valid: ' . implode(', ', Arr::flatten($e->errors())) // <<< UBAH DI SINI
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Gagal memproses pesanan', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'nama_pelanggan' => $request->nama_pelanggan ?? 'Unknown',
                'request_items' => $request->items ?? []
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function orderHistory()
    {
        $pesanan = NotaPesanan::with('menu')
                             ->orderBy('tanggal_pesanan', 'desc')
                             ->paginate(20);

        return view('modules.order-history', compact('pesanan'));
    }

    public function orderDetail($kodePesanan)
    {
        $pesanan = NotaPesanan::where('kode_pesanan', $kodePesanan)->firstOrFail();
        return view('modules.order-detail', compact('pesanan'));
    }

    public function updateOrderStatus(Request $request, $kodePesanan)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,processing,completed,cancelled'
            ]);

            $pesanan = NotaPesanan::where('kode_pesanan', $kodePesanan)->firstOrFail();
            $pesanan->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diupdate!',
                'data' => $pesanan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ]);
        }
    }

    public function dailyOrderReport()
    {
        $today = today();
        
        $pesananHariIni = NotaPesanan::today()->get();
        
        $totalPesanan = $pesananHariIni->count();
        $totalPendapatan = $pesananHariIni->sum('total_harga');
        $pelangganUnik = $pesananHariIni->unique('nama_pelanggan')->count();
        
        $laporan = [
            'tanggal' => $today->format('d/m/Y'),
            'total_pesanan' => $totalPesanan,
            'total_pendapatan' => $totalPendapatan,
            'pelanggan_unik' => $pelangganUnik,
            'pesanan' => $pesananHariIni->groupBy('nama_pelanggan')
        ];

        return view('modules.daily-order-report', compact('laporan'));
    }
}
