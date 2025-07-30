<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// Hapus import yang tidak digunakan jika model Order, Transaksi, Laporan tidak langsung terkait di sini
// use App\Models\Order; // Hapus jika tidak ada model 'Order' terpisah
// use App\Models\Transaksi; // Ini harusnya relasi hasOne dari NotaPesanan ke Transaksi
// use App\Models\Laporan; // Ini harusnya relasi hasOneThrough dari NotaPesanan melalui Transaksi ke Laporan

class NotaPesanan extends Model
{
    use HasFactory;

    protected $table = 'nota_pesanan';

    // [PENTING] Definisikan Primary Key
    protected $primaryKey = 'kode_pesanan'; // Mengatur 'kode_pesanan' sebagai primary key
    public $incrementing = false; // Memberi tahu Laravel bahwa primary key tidak auto-incrementing
    protected $keyType = 'string'; // Memberi tahu Laravel bahwa tipe primary key adalah string

    protected $fillable = [
        // 'order_id', // Hapus ini jika tidak ada kolom 'order_id' di tabel nota_pesanan atau tidak digunakan
        'kode_pesanan',
        'nama_pelanggan',
        // 'nama_menu',        // Hapus: ini milik DetailPesanan
        // 'kode_menu',        // Hapus: ini milik DetailPesanan
        // 'jumlah_pesanan',   // Hapus: ini milik DetailPesanan
        'id_pelayan',
        // 'harga_satuan',     // Hapus: ini milik DetailPesanan
        'total_harga',      // Ini adalah total dari semua item di DetailPesanan
        'tanggal_pesanan',
        'status'
    ];

    protected $casts = [
        // 'harga_satuan' => 'decimal:2', // Hapus: ini milik DetailPesanan
        'total_harga' => 'decimal:2',
        'tanggal_pesanan' => 'datetime'
    ];

    public static function generateKodePesanan()
    {
        $now = Carbon::now('Asia/Jakarta');
        $dateFormat = $now->format('ymd');

        // Pastikan pencarian berdasarkan primary key yang benar
        $lastOrder = self::where('kode_pesanan', 'like', "PSN-{$dateFormat}-%")
            ->orderBy('kode_pesanan', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->kode_pesanan, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return "PSN-{$dateFormat}-{$newNumber}";
    }

    // Relasi ke DetailPesanan (ini yang benar untuk mendapatkan item-item pesanan)
    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'kode_pesanan', 'kode_pesanan');
    }

    // Hapus relasi menu() jika NotaPesanan tidak langsung memiliki satu menu
    // public function menu()
    // {
    //     return $this->belongsTo(Menu::class, 'kode_menu', 'kode_menu');
    // }

    public function scopeToday($query)
    {
        return $query->whereDate('tanggal_pesanan', today());
    }

    public function scopeByCustomer($query, $customerName)
    {
        return $query->where('nama_pelanggan', 'like', "%{$customerName}%");
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function getFormattedTanggalPesananAttribute()
    {
        return $this->tanggal_pesanan->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s');
    }

    // Pastikan relasi transaksi dan laporan sudah benar jika Anda menggunakannya
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'kode_pesanan', 'kode_pesanan');
    }

    public function laporan()
    {
        return $this->hasOneThrough(Laporan::class, Transaksi::class, 'kode_pesanan', 'kode_transaksi', 'kode_pesanan', 'kode_transaksi');
    }
}