<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\JenisProses;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Stand;
use App\Exports\DataExport;
use App\Cabang;
use App\Exports\DataExportMultipleSheet;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:laporan-read');
    }

    public function index() {
        if (Input::get('m')) {
            $tmp = explode('-', Input::get('m'));
            $bulan = $tmp[0];
            $tahun = $tmp[1];
        } else {
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;
        }

        $transaksi = Transaksi::whereRaw('MONTH(tgl_penetapan) = '.$bulan.' AND YEAR(tgl_penetapan) = '.$tahun)->get();
        $jumlah_transaksi = JenisProses::all();

        foreach ($jumlah_transaksi as $j) {
            $j['jumlah'] = Transaksi::JenisProses($j->id)
                ->whereRaw('MONTH(tgl_penetapan) = '.$bulan.' AND YEAR(tgl_penetapan) = '.$tahun)
                ->count();
        }

        return view('laporan.index', compact('transaksi', 'bulan', 'tahun', 'jumlah_transaksi'));
    }

    public function exportLaporan(Request $request) {
        if ($request->m) {
            $tmp = explode('-', $request->m);
            $bulan = $tmp[0];
            $tahun = $tmp[1];
        } else {
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;
        }

        return (new LaporanExport($request->column, $bulan, $tahun))->download('laporan.xlsx');
    }

    public function exportData() {
        if (!request()->cabang) {
            $cabangs = Cabang::all();

            return view('laporan.export', compact('cabangs'));
        }

        $cabang = Cabang::findOrFail(request()->cabang);

        return (new DataExportMultipleSheet($cabang))->download('data_cabang_'.$cabang->nama.'.xlsx');
    }
}
