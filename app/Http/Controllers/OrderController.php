<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BahanBaku;
use App\Models\NotaPesanan;
use App\Models\Laporan; // Tidak digunakan di sini, bisa dihapus jika tidak ada fungsionalitas laporan yang relevan.
use App\Models\Transaksi; // Tidak digunakan di sini, bisa dihapus jika tidak ada fungsionalitas transaksi yang relevan.
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
        // Mengambil semua menu minuman (dari model Menu)
        $menus = Menu::all();
        // Mengambil semua bahan baku (dari model BahanBaku), yang di frontend dianggap sebagai "menu seblak"
        $bahanBakus = BahanBaku::all();

        // Mengirimkan kedua koleksi data ke view 'modules.orders'
        return view('modules.orders', compact('menus', 'bahanBakus'));
    }

    /**
     * Store a newly created menu item (not directly used for orders, but for menu management).
     * This function was in the original file, I'm keeping it as is.
     * @param Request $request
     * @return JsonResponse
     */
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
                'stok' => 0, // Default stok jika tidak disediakan
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

    /**
     * Update an existing menu item (not directly used for orders, but for menu management).
     * This function was in the original file, I'm keeping it as is.
     * @param Request $request
     * @param string $kode_menu
     * @return JsonResponse
     */
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

    /**
     * Delete a menu item (not directly used for orders, but for menu management).
     * This function was in the original file, I'm keeping it as is.
     * @param string $kode_menu
     * @return JsonResponse
     */
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

    /**
     * Search for menu items (minuman).
     * @param Request $request
     * @return JsonResponse
     */
    public function searchMenu(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        $menus = Menu::where('nama_menu', 'LIKE', "%{$query}%")
            ->orWhere('kode_menu', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($menus);
    }

    /**
     * Search for bahan baku items (seblak).
     * @param Request $request
     * @return JsonResponse
     */
    public function searchBahan(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        $bahanBakus = BahanBaku::where('nama_bahan_baku', 'LIKE', "%{$query}%")
            ->orWhere('kode_bahan', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($bahanBakus);
    }

    /**
     * Process an order from the cart.
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function processOrder(Request $request): RedirectResponse|JsonResponse
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'items' => 'required|array|min:1',
                'items.*.kode_menu' => 'required|string',
                'items.*.nama_menu' => 'required|string', // Although not used in backend logic for lookup, good for logging/detail
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.type' => 'required|in:menu,bahan_baku', // Added validation for type
                'total' => 'required|numeric|min:0'
            ]);

            $kodePesanan = NotaPesanan::generateKodePesanan();
            // Kode Transaksi tidak diperlukan di sini jika alur pembayaran terpisah
            // $kodeTransaksi = Transaksi::generateKodeTransaksi(); 
            $tanggalSekarang = Carbon::now('Asia/Jakarta');

            // Pastikan user terautentikasi sebagai 'pelayan'
            // Sesuaikan guard jika nama guard berbeda (misal 'web')
            $idPelayan = Auth::guard('pelayan')->id();

            if (!$idPelayan) {
                // Jika tidak ada pelayan yang login, bisa throw error atau atur default
                throw new \Exception('Pelayan tidak terautentikasi.');
            }

            // Simpan nota header
            $nota = NotaPesanan::create([
                'kode_pesanan' => $kodePesanan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'tanggal_pesanan' => $tanggalSekarang,
                'status' => 'pending', // Status awal 'pending' sebelum pembayaran
                'id_pelayan' => $idPelayan,
            ]);

            $totalPendapatan = 0;

            foreach ($request->items as $item) {
                $menu = null;
                $modelClass = null; // To store which model we are dealing with

                if ($item['type'] === 'bahan_baku') {
                    $menu = BahanBaku::where('kode_bahan', $item['kode_menu'])->first();
                    $modelClass = BahanBaku::class;
                } elseif ($item['type'] === 'menu') {
                    $menu = Menu::where('kode_menu', $item['kode_menu'])->first();
                    $modelClass = Menu::class;
                }

                if (!$menu) {
                    throw new \Exception("Item dengan kode {$item['kode_menu']} dan tipe {$item['type']} tidak ditemukan.");
                }

                $hargaSatuan = $menu->harga;
                $totalHargaPerItem = $hargaSatuan * $item['quantity'];
                $totalPendapatan += $totalHargaPerItem;

                // Simpan detail pesanan
                DetailPesanan::create([
                    'kode_pesanan' => $kodePesanan,
                    'kode_menu' => $item['type'] === 'menu' ? $item['kode_menu'] : null, // Hanya isi jika tipe menu
                    'kode_bahan' => $item['type'] === 'bahan_baku' ? $item['kode_menu'] : null, // Hanya isi jika tipe bahan_baku
                    'jumlah_pesanan' => $item['quantity'],
                    'harga_satuan' => $hargaSatuan,
                    'total_harga' => $totalHargaPerItem,
                ]);

                // Kurangi stok
                if ($menu->stok < $item['quantity']) {
                    throw new \Exception("Stok {$item['type']} '{$item['nama_menu']}' tidak mencukupi. Stok tersedia: {$menu->stok}");
                }
                $menu->stok -= $item['quantity'];
                $menu->save();
            }

            // Update total harga di nota setelah semua item diproses
            $nota->total_harga = $totalPendapatan;
            $nota->save();

            DB::commit();

            // Redirect ke halaman pembayaran dengan data yang diperlukan
            return redirect()->route('payment.form', [
                'order_total' => $totalPendapatan,
                'kode_pesanan' => $kodePesanan,
                'nama_pelanggan' => $request->nama_pelanggan
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Validation Error in processOrder: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Data pesanan tidak valid: ' . implode(', ', Arr::flatten($e->errors()))
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Processing Error: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi-fungsi lain dari OrderController (orderHistory, orderDetail, updateOrderStatus, dailyOrderReport)
    // Biarkan tetap ada jika masih digunakan. Saya tidak menyertakannya di sini untuk menjaga fokus pada perubahan utama.
    public function orderHistory()
    {
        $pesanan = NotaPesanan::orderBy('tanggal_pesanan', 'desc')->paginate(20);
        return view('modules.order-history', compact('pesanan'));
    }

    public function orderDetail($kodePesanan)
    {
        $pesanan = NotaPesanan::where('kode_pesanan', $kodePesanan)->firstOrFail();
        // Anda mungkin perlu memuat relasi detail pesanan di sini
        $pesanan->load('details'); // Asumsikan ada relasi 'details' di model NotaPesanan
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
        // Memuat detail pesanan untuk setiap nota
        $pesananHariIni = NotaPesanan::with('details')->whereDate('tanggal_pesanan', $today)->get();

        $laporan = [
            'tanggal' => $today->format('d/m/Y'),
            'total_pesanan' => $pesananHariIni->count(),
            'total_pendapatan' => $pesananHariIni->sum('total_harga'), // Pastikan kolom total_harga di NotaPesanan terisi
            'pelanggan_unik' => $pesananHariIni->unique('nama_pelanggan')->count(),
            'pesanan' => $pesananHariIni // Mengirim semua pesanan hari ini
        ];

        return view('modules.daily-order-report', compact('laporan'));
    }
}