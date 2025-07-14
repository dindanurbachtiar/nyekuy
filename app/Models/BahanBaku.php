<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'kode_bahan';
    public $incrementing = false; // kode bukan auto increment
    protected $keyType = 'string';
    protected $fillable = ['kode_bahan', 'nama_bahan', 'qty'];
    public $timestamps = false;

}
