<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelayan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelayan';
    protected $primaryKey = 'id_pelayan';
     public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nama_pelayan',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
