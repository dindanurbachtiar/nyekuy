<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'kode_bahan';
    public $incrementing = false; // Karena kode_bahan bukan auto-increment
    protected $keyType = 'string'; // Tipe primary key berupa string

    protected $fillable = [
        'kode_bahan',
        'nama_bahan_baku',
        'stok'
    ];

    public $timestamps = true; // Gunakan true kalau tabel kamu ada kolom created_at dan updated_at
}
