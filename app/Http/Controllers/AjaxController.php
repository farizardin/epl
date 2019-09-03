<?php

namespace App\Http\Controllers;

use App\JenisJualan;
use App\Pedagang;
use App\ProsesIT;
use App\Tarif;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPedagang(Request $request) {
        $id = $request->id;
        $pedagang = Pedagang::find($id);

        return response()->json($pedagang);
    }

    public function getBiayaIT(Request $request) {
        $tarif_it = Tarif::where('nama', 'IT')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->where('id_bentuk_stand', $request->id_bentuk_stand)
            ->where('id_kelompok_jualan', $request->id_kelompok_jualan)
            ->where('id_lantai', $request->id_lantai)
            ->first();

        $sitb = Tarif::where('nama', 'SITB')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->where('id_bentuk_stand', $request->id_bentuk_stand)
            ->where('id_kelompok_jualan', $request->id_kelompok_jualan)
            ->first();

        $tarif = [];
        $tarif[] = ['nama' => 'Biaya Perolehan HPTU', 'tarif' => $tarif_it->tarif*$request->luas];
        $tarif[] = ['nama' => 'Biaya SITB', 'tarif' => $sitb->tarif*$request->luas];

        return response()->json($tarif);
    }

    public function getBiayaBN(Request $request) {
        $tarif_bn = Tarif::where('nama', 'BN')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->where('id_bentuk_stand', $request->id_bentuk_stand)
            ->where('id_kelompok_jualan', $request->id_kelompok_jualan)
            ->where('id_lantai', $request->id_lantai)
            ->first();

        $tarif = [];
        $tarif[] = ['nama' => 'Biaya Balik Nama', 'tarif' => $tarif_bn->tarif*$request->luas];

        if ($request->denda) {
            $tarif[] = ['nama' => 'Biaya Denda Balik Nama', 'tarif' => $tarif_bn->tarif*$request->luas*0.1];
        }

        return response()->json($tarif);
    }

    public function getBiayaHer(Request $request) {
        $tarif_her = Tarif::where('nama', 'HER')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->where('id_bentuk_stand', $request->id_bentuk_stand)
            ->where('id_kelompok_jualan', $request->id_kelompok_jualan)
            ->first();

        $tarif = [];
        $tarif[] = ['nama' => 'Biaya Herregistrasi', 'tarif' => $tarif_her->tarif*$request->luas*$request->periode];

        if ($request->periode_denda >= 1) {
            if ($request->periode_denda == 1) $denda = 0.3;
            else if ($request->periode_denda == 2) $denda = 0.6;
            else $denda = 1;

            $tarif[] = ['nama' => 'Denda Herregistrasi', 'tarif' => $tarif_her->tarif*$request->luas*$denda];
        }

        return response()->json($tarif);
    }

    public function getBiayaSIB(Request $request) {
        $tarif_sib = Tarif::where('nama', 'SITB')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->where('id_bentuk_stand', $request->id_bentuk_stand)
            ->where('id_kelompok_jualan', $request->id_kelompok_jualan)
            ->first();

        $tarif = [];
        $tarif[] = ['nama' => 'Biaya SIB', 'tarif' => $tarif_sib->tarif*$request->luas];

        if ($request->denda) {
            $tarif[] = ['nama' => 'Biaya Denda SIB', 'tarif' => $tarif_sib->tarif*$request->luas];
        }

        return response()->json($tarif);
    }

    public function getBiayaSIJ(Request $request) {
        $id_kelompok_jualan = JenisJualan::findOrFail($request->id_jenis_jualan)->kelompok_jualan->id;
        $tarif_sij = Tarif::where('nama', 'BN')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->where('id_bentuk_stand', $request->id_bentuk_stand)
            ->where('id_kelompok_jualan', $id_kelompok_jualan)
            ->where('id_lantai', $request->id_lantai)
            ->first();

        $tarif = [];
        $tarif[] = ['nama' => 'Biaya SIJ', 'tarif' => $tarif_sij->tarif*$request->luas*0.2];

        if ($request->denda) {
            $tarif[] = ['nama' => 'Biaya Denda SIJ', 'tarif' => $tarif_sij->tarif*$request->luas*0.2];
        }

        return response()->json($tarif);
    }

    public function getBiayaIPS(Request $request) {
        $tarif_it = Tarif::where('nama', 'IPS')
            ->where('id_kelas_pasar', $request->id_kelas_pasar)
            ->first();

        $tarif = [];
        $tarif[] = ['nama' => 'Biaya IPS', 'tarif' => $tarif_it->tarif*$request->luas];

        return response()->json($tarif);
    }

    public function getBiayaBTU(Request $request) {
        $tarif_btu = Tarif::where('nama', 'BTU')->first();

        $tarif = ['nama' => 'BTU', 'tarif' =>  $tarif_btu->tarif];

        return response()->json($tarif);
    }

    public function getBiayaGantiBuku(Request $request) {
        $tarif_ganti_buku = Tarif::where('nama', 'BHPTU')->first();

        $tarif = ['nama' => 'Ganti Buku Baru', 'tarif' => $tarif_ganti_buku->tarif];

        return response()->json($tarif);
    }

    public function getBiayaPPN(Request $request) {
        $ppn = 10/100;
        $tarif = ['nama' => 'PPN (10%)', 'tarif' => $request->tarif*$ppn];

        return response()->json($tarif);
    }

    public function generateMoneyFormat(Request $request) {
        // return money_format('%n', $request->tarif);
        return $request->tarif;
    }
}