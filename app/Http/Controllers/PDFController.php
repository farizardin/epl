<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helper;
use Illuminate\Support\Facades\Input;
use App\Proses;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cetak_kuitansi($id) {
        $tgl = Helper::tgl_indo(Carbon::now()->toDateString());
        $transaksi = Transaksi::findOrFail($id);
        $proses_bn = $transaksi->proses->where('id_jenis_proses', Proses::BN)->first();
        $detail_bn = null;
        if ($proses_bn) $detail_bn = $proses_bn->detail_proses();

        $pdf = PDF::loadView('pdf.kuitansi', compact('tgl', 'transaksi', 'detail_bn'))->setPaper('folio', 'portrait');

        return $pdf->stream();
    }

    public function cetak_kartu($id) {
        $transaksi = Transaksi::findOrFail($id);
        $only_her = true;
        foreach ($transaksi->proses as $proses) {
            if ($proses->id_jenis_proses != Proses::Her) $only_her = false;
        }

        $pdf = PDF::loadView('pdf.kartustandA4', compact('transaksi', 'only_her'))->setPaper('folio', 'portrait');

        return $pdf->stream();
    }

    public function cetak_rekap() {
        $tanggal = Input::get('m');
        $date = explode('/', $tanggal);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $transaksi = Transaksi::where('tgl_permohonan', $date)->get();
        $pdf = PDF::loadView('pdf.rekapitulasi', compact('transaksi', 'tanggal'))->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function cetak_bkmc($id) {
        $transaksi = Transaksi::findOrFail($id);
        $proses_bn = $transaksi->proses->where('id_jenis_proses', \App\Proses::BN)->first();
        $detail_bn = null;

        if ($proses_bn) {
            $detail_bn = $proses_bn->detail_proses();
        }

        $pdf = PDF::loadView('pdf.bkmc', compact('transaksi', 'detail_bn'))->setPaper('a5', 'portrait');

        return $pdf->stream();

        // return view('pdf.bkmc', compact('transaksi', 'detail_bn'));
    }

    public function cetak_buku($id) {
        $transaksi = Transaksi::findOrFail($id);
        $proses_bn = $transaksi->proses->where('id_jenis_proses', \App\Proses::BN)->first();
        $detail_bn = null;

        if ($proses_bn) {
            $detail_bn = $proses_bn->detail_proses();
        } 

        $pdf = PDF::loadView('pdf.bukustand', compact('transaksi', 'detail_bn'))->setPaper('a5', 'landscape');

        return $pdf->stream();
    }
    
    public function cetak_blangko($id) {
        $transaksi = Transaksi::findOrFail($id);
        $proses_bn = $transaksi->proses->where('id_jenis_proses', \App\Proses::BN)->first();
        $detail_bn = null;

        if ($proses_bn) {
            $detail_bn = $proses_bn->detail_proses();
        } 

        $pdf = PDF::loadView('pdf.blangkopermohonan', compact('transaksi', 'detail_bn'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
    
    public function cetak_tandapenerimaan($id) {
        $tgl = Helper::tgl_indo(Carbon::now()->toDateString());
        $transaksi = Transaksi::findOrFail($id);
        $proses_bn = $transaksi->proses->where('id_jenis_proses', \App\Proses::BN)->first();
        $detail_bn = null;

        if ($proses_bn) {
            $detail_bn = $proses_bn->detail_proses();
        }

        $pdf = PDF::loadView('pdf.tandapenerimaan', compact('tgl', 'transaksi', 'detail_bn'))->setPaper('folio', 'portrait');

        return $pdf->stream();
    }

    public function cetak_pptu($id) {
        $transaksi = Transaksi::findOrFail($id);
        $tanggal = Helper::tgl_indo(Carbon::now()->toDateString());
        $hari = Helper::getHari(Carbon::now()->dayOfWeek);
        $tgl = Carbon::now()->day;
        $bulan = Helper::getBulan(Carbon::now()->month);
        $tahun = Carbon::now()->year;

        $proses_bn = $transaksi->proses->where('id_jenis_proses', Proses::BN)->first();
        $detail_bn = null;
        if ($proses_bn) $detail_bn = $proses_bn->detail_proses();

        $pdf = PDF::loadView('pdf.pptu', compact('transaksi', 'tanggal', 'hari', 'tgl', 'bulan', 'tahun', 'detail_bn'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function cetak_suratpernyataan($id) {
        $transaksi = Transaksi::findOrFail($id);
        $tanggal = Helper::tgl_indo(Carbon::now()->toDateString());
        $hari = Helper::getHari(Carbon::now()->dayOfWeek);
        $tgl = Carbon::now()->day;
        $bulan = Helper::getBulan(Carbon::now()->month);
        $tahun = Carbon::now()->year;

        $proses_bn = $transaksi->proses->where('id_jenis_proses', \App\Proses::BN)->first();
		if (!$proses_bn) {
            flash('Proses BN tidak tersedia.')->error();

			return redirect(route('proses.detail', $transaksi->id));
		}

        $pdf = PDF::loadView('pdf.suratpernyataan', compact('transaksi', 'tanggal', 'hari', 'tgl', 'bulan', 'tahun', 'proses_bn'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function cetak_beritaacara($id) {
        $transaksi = Transaksi::findOrFail($id);
        $tanggal = Helper::tgl_indo(Carbon::now()->toDateString());
        $hari = Helper::getHari(Carbon::now()->dayOfWeek);
        $tgl = Carbon::now()->day;
        $bulan = Helper::getBulan(Carbon::now()->month);
        $tahun = Carbon::now()->year;

        $proses_bn = $transaksi->proses->where('id_jenis_proses', Proses::BN)->first();
        $detail_bn = null;
        if ($proses_bn) $detail_bn = $proses_bn->detail_proses();

        $proses_sib = $transaksi->proses->where('id_jenis_proses', Proses::SIB)->first();
        $detail_sib = null;
        if ($proses_sib) $detail_sib = $proses_sib->detail_proses();

        $proses_sij = $transaksi->proses->where('id_jenis_proses', Proses::SIJ)->first();
        $detail_sij = null;
        if ($detail_sij) $detail_sij = $proses_sij->detail_proses();

        $pdf = PDF::loadView('pdf.beritaacara', compact('transaksi', 'tanggal', 'hari', 'tgl', 'bulan', 'tahun', 'detail_bn', 'detail_sib', 'detail_sij'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
