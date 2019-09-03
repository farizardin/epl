<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasar extends Model
{
    use SoftDeletes;

    protected $table = 'pasar';

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'id_cabang', 'id_kelas_pasar', 'nama', 'alamat'
    ];

    public function stand() {
        return $this->hasMany('App\Stand', 'id_pasar');
    }

    public function cabang() {
        return $this->belongsTo('App\Cabang', 'id_cabang');
    }

    public function kelas() {
        return $this->belongsTo('App\KelasPasar', 'id_kelas_pasar');
    }
}
