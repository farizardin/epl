<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $dates = [
        'created_at', 'updated_at', 'tgl_lahir', 'tgl_acc', 'tgl_penetapan', 'tgl_permohonan', 'tgl_valid_kcabang', 'tgl_valid_kpemasaran',
        'tgl_valid_direksi'
    ];

    public const STATUS_WAIT_CABANG = 1;
    public const STATUS_WAIT_PEMASARAN = 2;
    public const STATUS_WAIT_DIREKTUR = 3;
    public const STATUS_SUCCESS = 4;

    public const STATUS = [
        '1' => 'Menunggu ACC Cabang',
        '2' => 'Menunggu ACC Pemasaran',
        '3' => 'Menunggu ACC Direksi',
        '4' => 'Proses Selesai',
    ];

    protected $fillable = [
        'id_stand', 'nik', 'nama', 'alamat', 'kota', 'telp', 'tgl_lahir', 'foto',
        'tgl_permohonan', 'tgl_acc', 'tgl_penetapan', 'biaya', 'biaya_detail', 'keterangan', 'status',
        'keterangan_kcabang', 'id_proses', 'tgl_valid_kcabang', 'tgl_valid_kpemasaran',
        'tgl_valid_direksi', 'id_pptu', 'id_bhptu'
    ];

    public function proses() {
        return $this->hasMany('App\Proses', 'id_transaksi');
    }

    public function stand() {
        return $this->belongsTo('App\Stand', 'id_stand');
    }

    public function pptu() {
        return $this->belongsTo('App\Pptu', 'id_pptu');
    }

    public function scopePasar($query, $id_pasar) {
        return $query->whereHas('stand', function ($q) use ($id_pasar) {
            $q->where('id_pasar', '=', $id_pasar);
        });
    }

    public function scopeCabang($query, $id_cabang) {
        return $query->whereHas('stand', function ($q) use ($id_cabang) {
            $q->whereHas('pasar', function ($qu) use ($id_cabang) {
                $qu->where('id_cabang', '=', $id_cabang);
            });
        });
    }

    public function scopeJenisProses($query, $id_jenis_proses) {
        return $query->whereHas('proses', function ($q) use ($id_jenis_proses) {
            $q->where('id_jenis_proses', '=', $id_jenis_proses);
        });
    }

    public function getBiayaAttribute($value) {
        // return money_format('%n', $value);
        $value;
    }

    public function getTarifAttribute() {
        return (float) preg_replace("/([^0-9\\,])/i", "", $this->biaya);
    }
}