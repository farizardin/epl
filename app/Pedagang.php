<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedagang extends Model
{
    protected $table = 'pedagang';

    protected $fillable = [
        'nik', 'nama', 'alamat', 'kota', 'telp', 'tgl_lahir', 'foto'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'tgl_lahir'
    ];
}
