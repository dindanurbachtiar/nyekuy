<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $primaryKey = 'id'; // default primary key (incremental)

    protected $fillable = [
        'kode_pesanan',
        'nama_menu',
        'kode_menu',
        'kode_bahan',
        'jumlah_pesanan',
        'harga_satuan',
        'total_harga'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    /**
     * Relasi ke NotaPesanan
     */
    public function nota()
    {
        return $this->belongsTo(NotaPesanan::class, 'kode_pesanan', 'kode_pesanan');
    }

    /**
     * Jika perlu relasi ke Menu
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'kode_menu', 'kode_menu');
    }

    /**
     * Jika perlu relasi ke BahanBaku
     */
    public function bahan()
    {
        return $this->belongsTo(BahanBaku::class, 'kode_bahan', 'kode_bahan');
    }
}
