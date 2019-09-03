<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsesBN extends Model
{
    protected $table = 'proses_bn';

    protected $fillable = [
        'id_proses', 'nik_lama', 'nama_lama', 'alamat_lama', 'kota_lama', 'telp_lama', 'tgl_lahir_lama', 'foto_lama',
        'nik_baru', 'nama_baru', 'alamat_baru', 'kota_baru', 'telp_baru', 'tgl_lahir_baru', 'foto_baru'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'tgl_lahir_lama', 'tgl_lahir_baru'
    ];
}