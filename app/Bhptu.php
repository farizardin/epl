<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bhptu extends Model
{
    protected $table = 'bhptu';

    protected $fillable = [
        'id_stand', 'id_transaksi', 'nomor', 'tanggal', 'tgl_berlaku'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'tanggal', 'tgl_berlaku'
    ];
}
