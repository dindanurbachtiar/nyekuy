<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'tgl_bayar',
        'total_bayar',
        'jumlah_bayar',
        'kembalian',
        'metode_bayar',
        'status'
    ];

    protected $casts = [
        'tgl_bayar' => 'datetime',
        'total_bayar' => 'decimal:2',
        'jumlah_bayar' => 'decimal:2',
        'kembalian' => 'decimal:2'
    ];

    /**
     * Generate kode transaksi unik dengan format yang lebih pendek
     */
    public static function generateKodeTransaksi()
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // Format: TXN-YYMMDD-XXXX (lebih pendek)
        $dateFormat = $now->format('ymd'); // 6 digit: 250716
        $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        $kodeTransaksi = "TXN-{$dateFormat}-{$randomNumber}";
        
        // Pastikan kode unik (cek database)
        while (self::where('kode_transaksi', $kodeTransaksi)->exists()) {
            $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $kodeTransaksi = "TXN-{$dateFormat}-{$randomNumber}";
        }
        
        return $kodeTransaksi;
    }

    /**
     * Generate kode transaksi alternatif (lebih pendek lagi)
     */
    public static function generateKodeTransaksiShort()
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // Format: TX-YYMMDD-XXX (lebih pendek lagi)
        $dateFormat = $now->format('ymd'); // 6 digit
        $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        $kodeTransaksi = "TX-{$dateFormat}-{$randomNumber}";
        
        // Pastikan kode unik
        while (self::where('kode_transaksi', $kodeTransaksi)->exists()) {
            $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            $kodeTransaksi = "TX-{$dateFormat}-{$randomNumber}";
        }
        
        return $kodeTransaksi;
    }

    /**
     * Scope untuk transaksi hari ini (timezone Indonesia)
     */
    public function scopeToday($query)
    {
        $today = Carbon::today('Asia/Jakarta');
        return $query->whereDate('tgl_bayar', $today);
    }

    /**
     * Scope untuk transaksi berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getFormattedTglBayarAttribute()
    {
        return $this->tgl_bayar->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s');
    }

    /**
     * Accessor untuk format tanggal pendek
     */
    public function getTglBayarShortAttribute()
    {
        return $this->tgl_bayar->setTimezone('Asia/Jakarta')->format('d/m/Y H:i');
    }
}
