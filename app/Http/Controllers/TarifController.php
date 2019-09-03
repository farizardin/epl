<?php

namespace App\Http\Controllers;

use App\BentukStand;
use App\JenisProses;
use App\KelasPasar;
use App\KelompokJualan;
use App\Lantai;
use App\Tarif;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:tarif-read');
    }

    public function index() {
        $tarifs = Tarif::all();
        $kelas_pasar = KelasPasar::all()->pluck('nama', 'id');
        $bentuk_stand = BentukStand::all()->pluck('nama', 'id');
        $kelompok_jualan = KelompokJualan::all()->pluck('nama', 'id');
        $lantai = Lantai::all()->pluck('nama', 'id');

        return view('tarif.index', compact('tarifs', 'kelas_pasar', 'bentuk_stand', 'kelompok_jualan', 'lantai'));
    }

    public function create() {

    }

    public function store(Request $request) {
        if (!Auth::user()->can('tarif-edit')) {
            return redirect(route('tarif'));
        }

        Tarif::create($request->only('id_kelas_pasar', 'id_bentuk_stand', 'id_kelompok_jualan', 'id_lantai', 'nama', 'tarif'));

        flash('Tarif berhasil ditambahkan.')->success();

        return redirect(route('tarif'));
    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {
        if (!Auth::user()->can('tarif-edit')) {
            return redirect(route('tarif'));
        }

        $tarif = Tarif::findOrFail($id);
        $tarif->fill($request->only('id_kelas_pasar', 'id_bentuk_stand', 'id_kelompok_jualan', 'id_lantai', 'nama', 'tarif'))->save();

        flash('Tarif berhasil diedit.')->success();

        return redirect(route('tarif'));
    }

    public function destroy($id) {
        if (!Auth::user()->can('tarif-edit')) {
            return redirect(route('tarif'));
        }

        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        flash('Tarif berhasil dihapus.')->success();

        return redirect(route('tarif'));
    }
}