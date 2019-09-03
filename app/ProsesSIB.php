<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsesSIB extends Model
{
    protected $table = 'proses_sib';

    protected $fillable = [
        'id_proses', 'id_bentuk_stand_lama', 'id_bentuk_stand_baru'
    ];

    public function bentuk_stand_baru() {
        return $this->belongsTo('App\BentukStand', 'id_bentuk_stand_baru');
    }
}
