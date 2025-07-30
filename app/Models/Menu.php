<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu_minuman';
    protected $primaryKey = 'kode_menu';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Nonaktifkan created_at & updated_at

    protected $fillable = [
        'kode_menu',
        'nama_menu',
        'harga',
        'stok',
        'bahan_baku',
        'kode_bahan'
    ];

    protected $casts = [
        'stok' => 'integer',
        'harga' => 'integer',
    ];
}