<?php

namespace App\Exports;

use App\Transaksi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LaporanExport implements FromView
{
    use Exportable;

    public function __construct($column, $bulan, $tahun)
    {
        $this->column = $column;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('exports.laporan', [
            'transaksi' => Transaksi::whereRaw('MONTH(tgl_penetapan) = '.$this->bulan.' AND YEAR(tgl_penetapan) = '.$this->tahun)->get(),
            'option' => $this->column
        ]);
    }
}