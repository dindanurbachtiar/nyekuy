<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Laporan; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $orderTotal = $request->input('order_total');
        $quickAmounts = [10000, 20000, 50000, 100000]; // bisa custom

         return view('payment.form', [
        'orderTotal' => $orderTotal,
        'quickAmounts' => $quickAmounts,
        'kode_pesanan' => $request->kode_pesanan
    ]);
    }

    public function calculateChange(Request $request)
    {
        $orderTotal = $request->order_total;
        $paidAmount = $request->paid_amount;
        $change = $paidAmount - $orderTotal;

        return response()->json([
            'change' => $change,
            'formatted_change' => number_format($change, 0, ',', '.'),
            'is_sufficient' => $change >= 0
        ]);
    }

    public function processPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paid_amount' => 'required|numeric|min:1',
            'order_total' => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $orderTotal = $request->order_total;
        $paidAmount = $request->paid_amount;
        $change = $paidAmount - $orderTotal;

        // Validasi uang yang dibayarkan harus cukup
        if ($change < 0) {
            return back()->with('error', 'Uang yang dibayarkan kurang dari total pesanan!')->withInput();
        }

        // Generate kode transaksi unik
        $kodeTransaksi = Transaksi::generateKodeTransaksi();

        $paymentData = [
            'order_total' => $orderTotal,
            'paid_amount' => $paidAmount,
            'change_amount' => $change,
            'payment_method' => $request->payment_method,
            'transaction_id' => $kodeTransaksi,
            'status' => 'completed',
            'payment_date' => Carbon::now('Asia/Jakarta'),
            'kode_pesanan' => $request->kode_pesanan // tambahkan ini
        ];

        // Proses pembayaran dan simpan ke database
        $paymentResult = $this->processCashPayment($paymentData);

        if ($paymentResult['success']) {
            return redirect()->route('payment.success')->with('payment_data', $paymentData);
        } else {
            return back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }

    private function processCashPayment($paymentData)
    {
        try {
            DB::beginTransaction();

            // Validasi panjang kode transaksi
            if (strlen($paymentData['transaction_id']) > 50) {
                throw new \Exception('Kode transaksi terlalu panjang');
            }

            // Simpan transaksi ke database
            $transaksi = Transaksi::create([
                'kode_transaksi' => $paymentData['transaction_id'],
                'kode_pesanan' => $paymentData['kode_pesanan'],
                'tgl_bayar' => Carbon::parse($paymentData['payment_date'])->setTimezone('Asia/Jakarta'),
                'total_bayar' => $paymentData['order_total'],
                'jumlah_bayar' => $paymentData['paid_amount'],
                'kembalian' => $paymentData['change_amount'],
                'metode_bayar' => $paymentData['payment_method'],
                'status' => $paymentData['status']
            ]);
            
            // --- BAGIAN BARU: Simpan Laporan ---
            $kodeLaporan = Laporan::generateKodeLaporan();
            Laporan::create([
                'kode_laporan' => $kodeLaporan,
                'tgl_laporan' => Carbon::today('Asia/Jakarta'), // Tanggal laporan hari ini
                'pendapatan' => $transaksi->total_bayar, // Pendapatan dari total_bayar transaksi
                'kode_transaksi' => $transaksi->kode_transaksi // Foreign key ke transaksi yang baru dibuat
            ]);
            // --- AKHIR BAGIAN BARU ---

            DB::commit();

            Log::info('Transaksi berhasil disimpan', [
                'kode_transaksi' => $transaksi->kode_transaksi,
                'total_bayar' => $transaksi->total_bayar,
                'panjang_kode' => strlen($transaksi->kode_transaksi)
            ]);

            return [
                'success' => true,
                'transaction_id' => $paymentData['transaction_id'],
                'message' => 'Pembayaran tunai berhasil dan data tersimpan',
                'transaksi_id' => $transaksi->id
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Gagal menyimpan transaksi', [
                'error' => $e->getMessage(),
                'kode_transaksi' => $paymentData['transaction_id'],
                'panjang_kode' => strlen($paymentData['transaction_id']),
                'sql_state' => $e->getCode()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()
            ];
        }
    }

    public function paymentSuccess()
    {
        $paymentData = session('payment_data');

        if (!$paymentData) {
            return redirect()->route('payment.form');
        }

        return view('payment.success', compact('paymentData'));
    }

    /**
     * Test generate kode transaksi
     */
    public function testKodeTransaksi()
    {
        $kode1 = Transaksi::generateKodeTransaksi();
        $kode2 = Transaksi::generateKodeTransaksiShort();
        
        return response()->json([
            'kode_normal' => $kode1,
            'panjang_normal' => strlen($kode1),
            'kode_pendek' => $kode2,
            'panjang_pendek' => strlen($kode2),
            'timestamp' => now()->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Menampilkan riwayat transaksi
     */
    public function transactionHistory()
    {
        $transaksi = Transaksi::orderBy('tgl_bayar', 'desc')
                             ->paginate(20);

        return view('payment.history', compact('transaksi'));
    }

    /**
     * Detail transaksi berdasarkan kode
     */
    public function transactionDetail($kodeTransaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', $kodeTransaksi)->firstOrFail();
        
        return view('payment.detail', compact('transaksi'));
    }

    /**
     * Laporan transaksi harian
     */
    public function dailyReport()
    {
        $today = today();
        
        $transaksiHariIni = Transaksi::today()->byStatus('completed')->get();
        
        $totalTransaksi = $transaksiHariIni->count();
        $totalPendapatan = $transaksiHariIni->sum('total_bayar');
        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        $laporan = [
            'tanggal' => $today->format('d/m/Y'),
            'total_transaksi' => $totalTransaksi,
            'total_pendapatan' => $totalPendapatan,
            'rata_rata_transaksi' => $rataRataTransaksi,
            'transaksi' => $transaksiHariIni
        ];

        return view('payment.report', compact('laporan'));
    }
}
