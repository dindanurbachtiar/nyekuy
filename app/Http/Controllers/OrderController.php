<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BahanBaku;
use App\Models\NotaPesanan;
use App\Models\Laporan;
use App\Models\Transaksi;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $bahanBakus = BahanBaku::all(); 
        return view('modules.orders', compact('menus','bahanBakus'));
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
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', Arr::flatten($e->errors()))
            ], 422);
        } catch (\Exception $e) {
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
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', Arr::flatten($e->errors()))
            ], 422);
        } catch (\Exception $e) {
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

            $kodePesanan = NotaPesanan::generateKodePesanan();
            $kodeTransaksi = Transaksi::generateKodeTransaksi();
            $tanggalSekarang = Carbon::now('Asia/Jakarta');
            
            $idPelayan = Auth::guard('pelayan')->id();

            // Simpan nota header
            $nota = NotaPesanan::create([
                'kode_pesanan' => $kodePesanan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'tanggal_pesanan' => $tanggalSekarang,
                'status' => 'pending',
                'id_pelayan' => $idPelayan,
            ]);



            $totalPendapatan = 0;

            foreach ($request->items as $item) {
                $menu = BahanBaku::where('kode_bahan', $item['kode_menu'])->first();
                $tipeMenu = 'bahan_baku';

                if (!$menu) {
                    $menu = Menu::where('kode_menu', $item['kode_menu'])->first();
                    $tipeMenu = 'menu';
                }

                if (!$menu) {
                    throw new \Exception("Item dengan kode {$item['kode_menu']} tidak ditemukan");
                }

                $hargaSatuan = $menu->harga;
                $totalHarga = $hargaSatuan * $item['quantity'];
                $totalPendapatan += $totalHarga;

                // Simpan detail pesanan
                DetailPesanan::create([
                    'kode_pesanan' => $kodePesanan,
                    'kode_menu' => $tipeMenu === 'menu' ? $item['kode_menu'] : null,
                    'kode_bahan' => $tipeMenu === 'bahan_baku' ? $item['kode_menu'] : null,
                    'jumlah_pesanan' => $item['quantity'],
                    'harga_satuan' => $hargaSatuan,
                    'total_harga' => $totalHarga,
                ]);

                // Kurangi stok
                if ($tipeMenu === 'menu') {
                    if ($menu->stok < $item['quantity']) {
                        throw new \Exception("Stok menu minuman '{$menu->nama_menu}' tidak mencukupi");
                    }
                } else {
                    if ($menu->stok < $item['quantity']) {
                        throw new \Exception("Stok bahan baku '{$menu->nama_bahan}' tidak mencukupi");
                    }
                }
                $menu->stok -= $item['quantity'];
                $menu->save();
            }

            DB::commit();

            return redirect()->route('payment.form', [
                'order_total' => $totalPendapatan,
                'kode_pesanan' => $kodePesanan,
                'nama_pelanggan' => $request->nama_pelanggan
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Data pesanan tidak valid: ' . implode(', ', Arr::flatten($e->errors()))
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

        public function orderHistory()
        {
            $pesanan = NotaPesanan::with('menu')->orderBy('tanggal_pesanan', 'desc')->paginate(20);
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
            $pesananHariIni = NotaPesanan::whereDate('tanggal_pesanan', $today)->get();

            $laporan = [
                'tanggal' => $today->format('d/m/Y'),
                'total_pesanan' => $pesananHariIni->count(),
                'total_pendapatan' => $pesananHariIni->sum('total_harga'),
                'pelanggan_unik' => $pesananHariIni->unique('nama_pelanggan')->count(),
                'pesanan' => $pesananHariIni->groupBy('nama_pelanggan')
            ];

            return view('modules.daily-order-report', compact('laporan'));
        }
}

