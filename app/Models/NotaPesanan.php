<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Order;

class NotaPesanan extends Model
{
    use HasFactory;

    protected $table = 'nota_pesanan';

    protected $fillable = [
        'order_id',
        'kode_pesanan',
        'nama_pelanggan',
        'nama_menu',
        'kode_menu',
        'jumlah_pesanan',
        // 'id_pelayan', // <<< Hapus baris ini
        'harga_satuan',
        'total_harga',
        'tanggal_pesanan',
        'status'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'tanggal_pesanan' => 'datetime'
    ];

    public static function generateKodePesanan()
    {
        $now = Carbon::now('Asia/Jakarta');
        $dateFormat = $now->format('ymd');
        
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

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'kode_menu', 'kode_menu');
    }

    

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
}
