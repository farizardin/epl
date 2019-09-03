<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penomoran extends Model
{
    protected $table = 'penomoran';

    protected $fillable = [
        'nomor', 'counter'
    ];

    public static function generateNomor($kode_pasar) {
        $tmp = [];
        $now = Carbon::now();
        $counter = self::getLastCounter() + 1;

        $tmp[] = $counter;
        $tmp[] = $kode_pasar;
        $tmp[] = self::getRomawiMonth($now->month);
        $tmp[] = $now->year;

        $tmp_nomor = implode('/', $tmp);

        $nomor = Penomoran::create(['nomor' => $tmp_nomor, 'counter' => $counter]);

        return $nomor->nomor;
    }

    public static function getLastCounter() {
        $tmp = Penomoran::where(DB::raw('YEAR(created_at)'), '=', Carbon::now()->year)->orderBy('id', 'desc')->first();

        return $tmp == null ? 0 : $tmp->counter;
    }

    public static function getRomawiMonth($month) {
        $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];

        return $romawi[$month-1];
    }
}
