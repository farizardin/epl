<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarif';
    public $timestamps = false;

    protected $fillable = [
        'id_kelas_pasar', 'id_bentuk_stand', 'id_kelompok_jualan', 'id_lantai', 'nama', 'tarif'
    ];

    public function kelas_pasar() {
        return $this->belongsTo('App\KelasPasar', 'id_kelas_pasar');
    }

    public function bentuk_stand() {
        return $this->belongsTo('App\BentukStand', 'id_bentuk_stand');
    }

    public function kelompok_jualan() {
        return $this->belongsTo('App\KelompokJualan', 'id_kelompok_jualan');
    }

    public function lantai() {
        return $this->belongsTo('App\Lantai', 'id_lantai');
    }

}