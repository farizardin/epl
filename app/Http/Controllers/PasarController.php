<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\KelasPasar;
use App\Pasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:pasar-read');
    }

    public function index() {
        $pasars = Pasar::with(['cabang', 'kelas'])->get();
        $kelas = KelasPasar::all()->pluck('nama', 'id');
        $cabang = Cabang::all()->pluck('nama', 'id');

        return view('pasar.index', compact('pasars', 'cabang', 'kelas'));
    }

    public function create() {

    }

    public function store(Request $request) {
        if (!Auth::user()->can('pasar-edit')) {
            return redirect(route('pasar'));
        }

        $pasar = Pasar::create($request->only('id_cabang', 'id_kelas_pasar', 'nama', 'alamat'));

        flash('Pasar baru berhasil ditambahkan.')->success();

        return redirect(route('pasar'));
    }

    public function edit() {

    }

    public function update(Request $request, $id) {
        if (!Auth::user()->can('pasar-edit')) {
            return redirect(route('pasar'));
        }

        $pasar = Pasar::findOrFail($id);
        $pasar->fill($request->only('id_cabang', 'id_kelas_pasar', 'nama', 'alamat'))->save();

        flash('Pasar berhasil diedit.')->success();

        return redirect(route('pasar'));
    }

    public function destroy($id) {
        if (!Auth::user()->can('pasar-edit')) {
            return redirect(route('pasar'));
        }

        $pasar = Pasar::findOrFail($id);
        $pasar->delete();

        flash('Pasar berhasil dihapus.')->success();

        return redirect(route('pasar'));
    }
}