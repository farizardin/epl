<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    public const ROLE_DIREKTUR = 'Direktur';
    public const ROLE_KPEMASARAN = 'KA Pemasaran';
    public const ROLE_KCABANG = 'KA Cabang';
    public const ROLE_KUNIT = 'KA Unit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_pasar', 'id_cabang', 'username', 'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function pasar() {
        return $this->belongsTo('App\Pasar', 'id_pasar');
    }

    public function cabang() {
        return $this->belongsTo('App\Cabang', 'id_cabang');
    }

    public static function getDirektur() {
        return User::role(self::ROLE_DIREKTUR)->first()->name;
    }

    public static function getKPemasaran() {
        return User::role(self::ROLE_KPEMASARAN)->first()->name;
    }
}
