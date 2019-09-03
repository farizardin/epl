<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    protected $table = 'proses';

    public const IT = 1, BN = 2, Her = 3, SIJ = 4, SIB = 5, IPS = 6, BHPTU = 7;

    protected $fillable = [
        'id_jenis_proses', 'id_transaksi', 'biaya', 'biaya_detail'
    ];

    public function jenis_proses() {
        return $this->belongsTo('App\JenisProses', 'id_jenis_proses');
    }

    public function detail_proses() {
        if ($this->jenis_proses->id == self::BN) {
            return ProsesBN::where('id_proses', $this->id)->first();
        } else if ($this->jenis_proses->id == self::SIB) {
            return ProsesSIB::where('id_proses', $this->id)->first();
        } else if ($this->jenis_proses->id == self::SIJ) {
            return ProsesSIJ::where('id_proses', $this->id)->first();
        }
    }
}
