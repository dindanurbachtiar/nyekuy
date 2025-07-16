<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'kode_laporan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

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
}
