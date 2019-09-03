<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsesSIJ extends Model
{
    protected $table = 'proses_sij';

    protected $fillable = [
        'id_proses', 'id_jenis_jualan_lama', 'id_jenis_jualan_baru'
    ];

    public function jenis_jualan_baru() {
        return $this->belongsTo('App\JenisJualan', 'id_jenis_jualan_baru');
    }
}
