<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Tambahkan ini

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'kode_laporan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Karena Anda tidak menggunakan created_at/updated_at di migrasi laporan

    protected $fillable = [
        'kode_laporan',
        'tgl_laporan',
        'pendapatan',
        'kode_transaksi'
    ];

    protected $casts = [
        'tgl_laporan' => 'date',
        'pendapatan' => 'integer'
    ];

    /**
     * Generate kode laporan unik
     */
    public static function generateKodeLaporan()
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // Format: LAP-YYMMDDHHMMSS-XXX
        $dateFormat = $now->format('ymdHis'); // 12 digit: 250722153045
        $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT); // 3 digit
        
        $kodeLaporan = "LAP-{$dateFormat}-{$randomNumber}";
        
        // Pastikan kode unik (cek database)
        while (self::where('kode_laporan', $kodeLaporan)->exists()) {
            $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            $kodeLaporan = "LAP-{$dateFormat}-{$randomNumber}";
        }
        
        return $kodeLaporan;
    }
}
