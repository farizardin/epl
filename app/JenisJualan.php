<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisJualan extends Model
{
    protected $table = 'jenis_jualan';
    public $timestamps = false;

    public function kelompok_jualan() {
        return $this->belongsTo('App\KelompokJualan', 'id_kelompok_jualan');
    }
}
