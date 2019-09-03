<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stand extends Model
{
    use SoftDeletes;

    /* Status Stand : Aktif, Cabut / Kosong, Segel, */
    public const AKTIF = 'AKTIF';
    public const CABUT = 'CABUT';
    public const SEGEL = 'SEGEL';
    public const STATUS = [
        'AKTIF' => 'AKTIF', 'CABUT' => 'CABUT', 'SEGEL' => 'SEGEL'
    ];


    protected $table = 'stand';

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'id_pasar', 'id_bentuk_stand', 'id_jenis_jualan', 'id_bhptu', 'id_pptu', 'id_pedagang', 'id_lantai',
        'id_daya_listrik', 'no_reg', 'no_rekening', 'no_stand','panjang', 'lebar', 'luas', 'air', 'status', 'keterangan'
    ];

    protected $custom_attributes = [
        'air' => 'hehe'
    ];

    public function getIsKosongAttribute() {
        return $this->status == self::CABUT && $this->id_pedagang == null;
    }

    public function pasar() {
        return $this->belongsTo('App\Pasar', 'id_pasar');
    }

    public function bentuk_stand() {
        return $this->belongsTo('App\BentukStand', 'id_bentuk_stand');
    }

    public function jenis_jualan() {
        return $this->belongsTo('App\JenisJualan', 'id_jenis_jualan');
    }

    public function bhptu() {
        return $this->belongsTo('App\Bhptu', 'id_bhptu');
    }

    public function pptu() {
        return $this->belongsTo('App\Pptu', 'id_pptu');
    }

    public function pedagang() {
        return $this->belongsTo('App\Pedagang', 'id_pedagang');
    }

    public function lantai() {
        return $this->belongsTo('App\Lantai', 'id_lantai');
    }

    public function daya_listrik() {
        return $this->belongsTo('App\DayaListrik', 'id_daya_listrik');
    }

    public function transaksi() {
        return $this->hasMany('App\Transaksi', 'id_stand');
    }

    public function scopeCabang($query, $id_cabang) {
        return $query->whereHas('pasar', function ($q) use ($id_cabang) {
            $q->where('id_cabang', $id_cabang);
        });
    }

    public function scopeSPasar($query, $id_pasar) {
        return $query->where('id_pasar', $id_pasar);
    }
}