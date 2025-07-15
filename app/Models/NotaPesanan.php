<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaPesanan extends Model
{
    use HasFactory;

    protected $table = 'nota_pesanan';
    protected $primaryKey = 'kode_pesanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_pesanan',
        'nama_pelanggan',
        'jumlah_pesanan',
        'nama_menu',
        'kode_menu',
        'id_pelayan'
    ];
}
