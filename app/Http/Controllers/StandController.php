<?php

namespace App\Http\Controllers;

use App\BentukStand;
use App\DayaListrik;
use App\JenisJualan;
use App\Lantai;
use App\Pasar;
use App\Stand;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class StandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:stand-read');
    }

    public function index() {
        if (Auth::user()->hasRole(User::ROLE_KUNIT)) $id_pasar = Auth::user()->id_pasar;
        else $id_pasar = Input::get('p');
        $pasar_valid = Pasar::find($id_pasar);
        $pasar = Pasar::all()->pluck('nama', 'id');

        if ($pasar_valid) {
            $stands = Stand::with('pasar', 'bentuk_stand', 'jenis_jualan', 'bhptu', 'pptu', 'pedagang', 'lantai', 'daya_listrik')
                ->where('id_pasar', $id_pasar)
                ->get();
            $bentuk_stand = BentukStand::all()->pluck('nama', 'id');
            $jenis_jualan = JenisJualan::all()->pluck('nama', 'id');
            $lantai = Lantai::all()->pluck('nama', 'id');
            $daya_listrik = DayaListrik::all()->pluck('nama', 'id');

            return view('stand.index', compact('stands', 'bentuk_stand', 'jenis_jualan', 'lantai', 'daya_listrik', 'pasar'));
        } else {
            return view('stand.index', compact('pasar'));
        }
    }

    public function create() {

    }

    public function store(Request $request) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::create($request->only('id_pasar', 'id_bentuk_stand', 'id_jenis_jualan', 'id_bhptu', 'id_pptu', 'id_pedagang', 'id_lantai',
            'id_daya_listrik', 'no_reg', 'no_rekening', 'no_stand','panjang', 'lebar', 'luas', 'air', 'status', 'keterangan'));

        flash('Stand berhasil ditambahkan.')->success();

        return redirect(route('stand', ['p' => $request->id_pasar]));
    }

    public function edit($id) {
        $stand = Stand::with('pasar', 'bentuk_stand', 'jenis_jualan', 'bhptu', 'pptu', 'pedagang', 'lantai', 'daya_listrik')
            ->find($id);
        $bentuk_stand = BentukStand::all()->pluck('nama', 'id');
        $jenis_jualan = JenisJualan::all()->pluck('nama', 'id');
        $lantai = Lantai::all()->pluck('nama', 'id');
        $daya_listrik = DayaListrik::all()->pluck('nama', 'id');

        return view('stand.edit', compact('stand', 'bentuk_stand', 'jenis_jualan', 'lantai', 'daya_listrik'));
    }

    public function update(Request $request, $id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::findOrFail($id);
        $stand->fill($request->only('id_pasar', 'id_bentuk_stand', 'id_jenis_jualan', 'id_bhptu', 'id_pptu', 'id_pedagang', 'id_lantai',
            'id_daya_listrik', 'no_reg', 'no_rekening', 'panjang', 'lebar', 'luas', 'air', 'status', 'keterangan'))->save();

        flash('Stand berhasil diedit.')->success();

        return redirect(route('stand.edit', $stand->id));
    }

    public function edit_pedagang($id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::with('pedagang')->find($id);

        return view('stand.edit_pedagang', compact('stand'));
    }

    public function update_pedagang(Request $request, $id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::findOrFail($id);
        $pedagang = $stand->pedagang;
        $pedagang->nik = $request->nik;
        $pedagang->nama = $request->nama;
        $pedagang->alamat = $request->alamat;
        $pedagang->kota = $request->kota;
        $pedagang->telp = $request->telp;
        $pedagang->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y-m-d');

        if ($foto = $request->file('foto')) {
            if ($pedagang->foto) {
                $foto->storeAs('public/uploads', substr($pedagang->foto, 15));
            } else {
                $foto_path = $foto->store('public/uploads');
                $pedagang->foto = $foto_path;
            }
        }

        $pedagang->save();

        flash('Pedagang berhasil di edit.')->success();

        return redirect(route('stand.edit', $stand->id));
    }

    public function update_bhptu(Request $request, $id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::find($id);
        $bhptu = $stand->bhptu;
        $bhptu->nomor = $request->no_bhptu;
        $bhptu->tanggal = Carbon::createFromFormat('d/m/Y', $request->tgl_bhptu)->format('Y-m-d');
        $bhptu->tgl_berlaku = Carbon::createFromFormat('d/m/Y', $request->tgl_berlaku_bhptu)->format('Y-m-d');
        $bhptu->save();

        flash('Buku berhasil di edit.')->success();

        return redirect(route('stand.edit', $stand->id));
    }

    public function update_pptu(Request $request, $id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::findOrFail($id);
        $pptu = $stand->pptu;
        $pptu->nomor = $request->no_pptu;
        $pptu->tanggal = Carbon::createFromFormat('d/m/Y', $request->tgl_pptu)->format('Y-m-d');
        $pptu->tgl_berlaku = Carbon::createFromFormat('d/m/Y', $request->tgl_berlaku_pptu)->format('Y-m-d');
        $pptu->save();

        flash('Kartu berhasil di edit.')->success();

        return redirect(route('stand.edit', $stand->id));
    }

    public function destroy($id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::findOrFail($id);
        $stand->delete();

        flash('Stand berhasil dihapus.')->success();

        return redirect(route('stand', ['p' => $stand->id_pasar]));
    }

    public function segel(Request $request, $id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::findOrFail($id);
        $stand->update([
            'status' => 'SEGEL',
            'keterangan' => $request->keterangan
        ]);

        flash('Stand berhasil di segel.')->success();

        return redirect(route('stand.edit', $stand->id));
    }

    public function cabut(Request $request, $id) {
        if (!Auth::user()->can('stand-edit')) {
            return redirect(route('stand'));
        }

        $stand = Stand::findOrFail($id);
        $stand->update([
            'status' => 'CABUT',
            'keterangan' => $request->keterangan,
            'id_bhptu' => null,
            'id_pptu' => null,
        ]);

        flash('Stand berhasil di cabut.')->success();

        return redirect(route('stand.edit', $stand->id));
    }
}