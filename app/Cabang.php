<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';
    public $timestamps = false;
    
    public function pasar() {
        return $this->hasMany('App\Pasar', 'id_cabang');
    }

    public function getKepalaAttribute() {
        return User::role(User::ROLE_KCABANG)->where('id_cabang', $this->id)->first();
    }
}
