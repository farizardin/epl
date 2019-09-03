<?php

namespace App\Http\Controllers;

use App\BentukStand;
use App\Bhptu;
use App\JenisJualan;
use App\JenisProses;
use App\Pedagang;
use App\Penomoran;
use App\Pptu;
use App\Proses;
use App\ProsesBN;
use App\ProsesIT;
use App\ProsesSIB;
use App\ProsesSIJ;
use App\Stand;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreTransaksi;

class ProsesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        if (Auth::user()->hasRole(User::ROLE_KUNIT)) {
            $transaksi = Transaksi::with('proses.jenis_proses', 'stand')
                ->where('status', '!=', Transaksi::STATUS_SUCCESS)
                ->pasar(Auth::user()->id_pasar)
                ->get();

            $transaksi_sukses = Transaksi::with('proses.jenis_proses', 'stand')
                ->where('status', Transaksi::STATUS_SUCCESS)
                ->pasar(Auth::user()->id_pasar)
                ->get();

            return view('proses.index', compact('transaksi', 'transaksi_sukses'));
        } else if (Auth::user()->hasRole(User::ROLE_KCABANG)) {
            $transaksi = Transaksi::with('proses.jenis_proses', 'stand')
                ->where('status', '=', Transaksi::STATUS_WAIT_CABANG)
                ->cabang(Auth::user()->id_cabang)
                ->get();
        } else if (Auth::user()->hasRole(User::ROLE_KPEMASARAN)) {
            $transaksi = Transaksi::with('proses.jenis_proses', 'stand')
                ->where('status', '=', Transaksi::STATUS_WAIT_PEMASARAN)
                ->get();

            $transaksi_sukses = Transaksi::with('proses.jenis_proses', 'stand')
                ->where('status', Transaksi::STATUS_SUCCESS)
                ->get();

            return view('proses.index', compact('transaksi', 'transaksi_sukses'));
        } else if (Auth::user()->hasRole(User::ROLE_DIREKTUR)) {
            $transaksi = Transaksi::with('proses.jenis_proses', 'stand')
                ->where('status', '=', Transaksi::STATUS_WAIT_DIREKTUR)
                ->get();
        } else {
            return redirect(route('home'));
        }

        return view('proses.index', compact('transaksi'));
    }

    public function detail($id) {
        $transaksi = Transaksi::with('proses.jenis_proses', 'stand')->find($id);
        $transaksi_terakhir = $transaksi->stand->transaksi()->where('status', Transaksi::STATUS_SUCCESS)->latest('created_at')->first();

        $proses_bn = $transaksi->proses->where('id_jenis_proses', Proses::BN)->first();
        $detail_bn = null;
        if ($proses_bn) $detail_bn = $proses_bn->detail_proses();

        $proses_sib = $transaksi->proses->where('id_jenis_proses', Proses::SIB)->first();
        $detail_sib = null;
        if ($proses_sib) $detail_sib = $proses_sib->detail_proses();

        $proses_sij = $transaksi->proses->where('id_jenis_proses', Proses::SIJ)->first();
        $detail_sij = null;
        if ($detail_sij) $detail_sij = $proses_sij->detail_proses();

        return view('proses.detail', compact('transaksi', 'transaksi_terakhir', 'detail_bn', 'detail_sib', 'detail_sij'));
    }

    public function create() {
        $jenis_proses = JenisProses::all();
        $jenis_jualan = JenisJualan::all()->pluck('nama', 'id');
        $bentuk_stand = BentukStand::all()->pluck('nama', 'id');
        $stands = Stand::where('id_pasar', Auth::user()->id_pasar)->get()->pluck('no_stand', 'id');
        $pedagang = Pedagang::all();

        return view('proses.create', compact('jenis_proses', 'stands', 'jenis_jualan', 'bentuk_stand', 'pedagang'));
    }

    public function store(StoreTransaksi $request) {
        if (!isset($request->jenisproses)) {
            return redirect(route('proses.create'));
        }

        $stand = Stand::find($request->id_stand);

         if (!in_array(Proses::IT, $request->jenisproses) && !$stand->bhptu) {
             flash("Buku tidak ditemukan, tidak dapat melanjutkan perizinan.")->error();

            return redirect()->back();
         }

        $transaksi = new Transaksi();
        $transaksi->id_stand = $request->id_stand;
        $transaksi->nik = $request->nik;
        $transaksi->nama = $request->nama;
        $transaksi->alamat = $request->alamat;
        $transaksi->kota = $request->kota;
        $transaksi->telp = $request->telp;
        if ($request->tgl_lahir) $transaksi->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y-m-d');

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $foto_path = $foto->store('public/uploads');
            $transaksi->foto = $foto_path;
        }

        $transaksi->tgl_permohonan = Carbon::now()->toDateString();
        $transaksi->biaya = $request->biaya;
        $transaksi->biaya_detail = $request->biaya_detail;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->status = Transaksi::STATUS_WAIT_CABANG;
        $transaksi->save();

        $it = false;

        foreach ($request->jenisproses as $jp) {
            $proses = new Proses();
            $proses->id_transaksi = $transaksi->id;

            if ($jp == Proses::IT) {
                $proses->id_jenis_proses = Proses::IT;
                $proses->biaya = $request->biaya_it;
                $proses->biaya_detail = $request->biaya_detail_it;
                $proses->save();

                $transaksi->nik = $request->nik_it;
                $transaksi->nama = $request->nama_it;
                $transaksi->alamat = $request->alamat_it;
                $transaksi->kota = $request->kota_it;
                $transaksi->telp = $request->telp_it;
                $transaksi->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir_it)->format('Y-m-d');
                $foto = $request->file('foto_it');
                $foto_it = $foto->store('public/uploads');
                $transaksi->foto = $foto_it;
                $transaksi->save();

                $detail = new ProsesIT();
                $detail->id_proses = $proses->id;
                $detail->pedagang_baru = $request->pedagang_baru;
                $detail->save();

                $nomor = Penomoran::generateNomor($stand->pasar->id);

                $bhptu_old = $stand->bhptu;
                $pptu_old = $stand->pptu;

                $bhptu = new Bhptu();
                $bhptu->id_stand = $stand->id;
                $bhptu->id_transaksi = $transaksi->id;
                $bhptu->nomor = $nomor;
                $bhptu->tanggal = Carbon::now()->toDateString();
                $bhptu->tgl_berlaku = $bhptu_old && $bhptu_old->tgl_berlaku ? $bhptu_old->tgl_berlaku->addYears(20)->toDateString() : Carbon::now()->addYears(20)->toDateString();
                $bhptu->save();

                if ($request->periode_her) {
                    $tmp = 2 * $request->periode_her;
                } else {
                    $tmp = 2;
                }

                $pptu = new Pptu();
                $pptu->id_stand = $stand->id;
                $pptu->id_transaksi = $transaksi->id;
                $pptu->nomor = "PPTU".$nomor;
                $pptu->tanggal = Carbon::now()->toDateString();
                $pptu->tgl_berlaku = $pptu_old && $pptu_old->tgl_berlaku ? $pptu_old->tgl_berlaku->addYears($tmp)->toDateString() : Carbon::now()->addYears($tmp)->toDateString();
                $pptu->save();

                $transaksi->id_bhptu = $bhptu->id;
                $transaksi->id_pptu = $pptu->id;
                $transaksi->save();

                $it = true;
            } else if ($jp == Proses::BN) {
                $proses->id_jenis_proses = Proses::BN;
                $proses->biaya = $request->biaya_bn;
                $proses->biaya_detail = $request->biaya_detail_bn;
                $proses->save();

                $detail = new ProsesBN();
                $detail->id_proses = $proses->id;
                $detail->nik_lama = $request->nik;
                $detail->nik_baru = $request->nik_baru;
                $detail->nama_lama = $request->nama;
                $detail->nama_baru = $request->nama_baru;
                $detail->alamat_lama = $request->alamat;
                $detail->alamat_baru = $request->alamat_baru;
                $detail->kota_lama = $request->kota;
                $detail->kota_baru = $request->kota_baru;
                $detail->telp_lama = $request->telp;
                $detail->telp_baru = $request->telp_baru;
                $detail->tgl_lahir_lama = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y-m-d');
                $detail->tgl_lahir_baru = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir_baru)->format('Y-m-d');
//              $detail->foto_lama = $request->foto_lama;
                $foto = $request->file('foto_baru');
                $foto_baru = $foto->store('public/uploads');
                $detail->foto_baru = $foto_baru;
                $detail->save();
            } else if ($jp == Proses::Her) {
                $proses->id_jenis_proses = Proses::Her;
                $proses->biaya = $request->biaya_her;
                $proses->biaya_detail = $request->biaya_detail_her;
                $proses->save();

                if (!$it) {
                    $bhptu_old = $stand->bhptu;
                    $pptu_old = $stand->pptu;
                    $nomor = Penomoran::generateNomor($stand->pasar->id);

                    $bhptu = new Bhptu();
                    $bhptu->id_stand = $stand->id;
                    $bhptu->id_transaksi = $transaksi->id;
                    $bhptu->nomor = $nomor;
                    $bhptu->tanggal = $bhptu_old->tanggal ? $bhptu_old->tanggal : Carbon::now()->toDateString();
                    $bhptu->tgl_berlaku = $bhptu_old->tgl_berlaku;
                    $bhptu->save();

                    $pptu = new Pptu();
                    $pptu->id_stand = $stand->id;
                    $pptu->id_transaksi = $transaksi->id;
                    $pptu->nomor = "PPTU".$nomor;
                    $pptu->tanggal = Carbon::now()->toDateString();
                    $pptu->tgl_berlaku = $pptu_old && $pptu_old->tgl_berlaku ? $pptu_old->tgl_berlaku->addYears($request->periode_her * 2)->toDateString() : Carbon::now()->addYears($request->periode_her * 2)->toDateString();
                    $pptu->save();

                    $transaksi->id_bhptu = $bhptu->id;
                    $transaksi->id_pptu = $pptu->id;
                    $transaksi->save();
                }
            } else if ($jp == Proses::SIJ) {
                $proses->id_jenis_proses = Proses::SIJ;
                $proses->biaya = $request->biaya_sij;
                $proses->biaya_detail = $request->biaya_detail_sij;
                $proses->save();

                $detail = new ProsesSIJ();
                $detail->id_proses = $proses->id;
                $detail->id_jenis_jualan_lama = $request->id_jenis_jualan_lama;
                $detail->id_jenis_jualan_baru = $request->id_jenis_jualan_baru;
                $detail->save();
            } else if ($jp == Proses::SIB) {
                $proses->id_jenis_proses = Proses::SIB;
                $proses->biaya = $request->biaya_sib;
                $proses->biaya_detail = $request->biaya_detail_sib;
                $proses->save();

                $detail = new ProsesSIB();
                $detail->id_proses = $proses->id;
                $detail->id_bentuk_stand_lama = $request->id_bentuk_stand_lama;
                $detail->id_bentuk_stand_baru = $request->id_bentuk_stand_baru;
                $detail->save();
            } else if ($jp == Proses::IPS) {
                $proses->id_jenis_proses = Proses::IPS;
                $proses->biaya = $request->biaya_ips;
                $proses->biaya_detail = $request->biaya_detail_ips;
                $proses->save();
            } else if ($jp == Proses::BHPTU) {
                $proses->id_jenis_proses = Proses::BHPTU;
                $proses->biaya = $request->biaya_ganti_buku;
                $proses->biaya_detail = $request->biaya_detail_ganti_buku;
                $proses->save();
            }
        }

        flash('Proses berhasil ditambahkan.')->success();

        return redirect(route('proses.detail', $transaksi->id));
    }

    public function edit() {

    }

    public function update(Request $request, $id) {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->nik = $request->nik;
        $transaksi->nama = $request->nama;
        $transaksi->alamat = $request->alamat;
        $transaksi->kota = $request->kota;
        $transaksi->telp = $request->telp;
        $transaksi->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y-m-d');
        $transaksi->save();

        flash('Proses berhasil diedit.')->success();

        return redirect(route('proses.detail', $transaksi->id));
    }

    public function destroy($id) {

    }

    public function validasi(Request $request, $id) {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status == Transaksi::STATUS_WAIT_CABANG) {
            $transaksi->status = Transaksi::STATUS_WAIT_PEMASARAN;
            $transaksi->keterangan_kcabang = $request->keterangan;
            $transaksi->tgl_valid_kcabang = Carbon::now()->toDateString();
            $transaksi->save();
        } else if ($transaksi->status == Transaksi::STATUS_WAIT_PEMASARAN) {
            $only_her = true;
            foreach($transaksi->proses as $proses) {
                echo $proses->id_jenis_proses . "==" . Proses::Her;
                if ($proses->id_jenis_proses != Proses::Her) $only_her = false;
            }

            if ($only_her) {
                $stand = $transaksi->stand;

                $stand->id_bhptu = $transaksi->id_bhptu;
                $stand->id_pptu = $transaksi->id_pptu;
                $stand->save();

                $transaksi->status = Transaksi::STATUS_SUCCESS;
                $transaksi->tgl_acc = Carbon::now()->toDateString();
                $transaksi->tgl_penetapan = Carbon::now()->toDateString();
            } else {
                $transaksi->status = Transaksi::STATUS_WAIT_DIREKTUR;
            }

            $transaksi->tgl_valid_kpemasaran = Carbon::now()->toDateString();
            $transaksi->save();
        } else if ($transaksi->status == Transaksi::STATUS_WAIT_DIREKTUR) {
            $transaksi->status = Transaksi::STATUS_SUCCESS;
            $transaksi->tgl_acc = Carbon::now()->toDateString();
            $transaksi->tgl_penetapan = Carbon::now()->toDateString();
            $transaksi->tgl_valid_direksi = Carbon::now()->toDateString();
            $transaksi->save();

            $proses = $transaksi->proses;
            $stand = $transaksi->stand;

            $it_bn = false;

            foreach ($proses as $p) {
                if ($p->id_jenis_proses == Proses::IT) {
                    $it_bn = true;
                    $proses_it = ProsesIT::where('id_proses', $p->id)->first();

                    $stand->id_bhptu = $transaksi->id_bhptu;
                    $stand->id_pptu = $transaksi->id_pptu;

                    if ($proses_it->pedagang_baru) {
                        $pedagang = new Pedagang();
                        $pedagang->nik = $transaksi->nik;
                        $pedagang->nama = $transaksi->nama;
                        $pedagang->alamat = $transaksi->alamat;
                        $pedagang->kota = $transaksi->kota;
                        $pedagang->telp = $transaksi->telp;
                        $pedagang->tgl_lahir = $transaksi->tgl_lahir;
                        $pedagang->foto = $transaksi->foto;
                        $pedagang->save();

                        $stand->id_pedagang = $pedagang->id;
                        $stand->save();
                    } else {
                        $stand->id_pedagang = $proses_it->id_pedagang;
                        $stand->save();
                    }

                } else if ($p->id_jenis_proses == Proses::BN) {
                    $it_bn = true;
                    $proses_bn = ProsesBN::where('id_proses', $p->id)->first();
                    $pedagang = $stand->pedagang;
                    $pedagang->nik = $proses_bn->nik_baru;
                    $pedagang->nama = $proses_bn->nama_baru;
                    $pedagang->alamat = $proses_bn->alamat_baru;
                    $pedagang->kota = $proses_bn->kota_baru;
                    $pedagang->telp = $proses_bn->telp_baru;
                    $pedagang->tgl_lahir = $proses_bn->tgl_lahir_baru;
                    $pedagang->foto = $proses_bn->foto_baru;
                    $pedagang->save();

                } else if ($p->id_jenis_proses == Proses::SIJ) {
                    $proses_sij = ProsesSIJ::where('id_proses', $p->id)->first();
                    $stand->id_jenis_jualan = $proses_sij->id_jenis_jualan_baru;
                    $stand->save();

                } else if ($p->id_jenis_proses == Proses::SIB) {
                    $proses_sib = ProsesSIB::where('id_proses', $p->id)->first();
                    $stand->id_bentuk_stand = $proses_sib->id_bentuk_stand_baru;
                    $stand->save();
                } else if ($p->id_jenis_proses == Proses::Her) {
                    $stand->id_bhptu = $transaksi->id_bhptu;
                    $stand->id_pptu = $transaksi->id_pptu;
                    $stand->save();
                }
            }

            if (!$it_bn) {
                $pedagang = $stand->pedagang;
                $pedagang->nik = $transaksi->nik;
                $pedagang->nama = $transaksi->nama;
                $pedagang->alamat = $transaksi->alamat;
                $pedagang->kota = $transaksi->kota;
                $pedagang->telp = $transaksi->telp;
                $pedagang->tgl_lahir = $transaksi->tgl_lahir;
                if ($transaksi->foto) $pedagang->foto = $transaksi->foto;
                $pedagang->save();
            }
        }

        flash('Proses perizinan berhasil di validasi.')->success();

        return redirect(route('proses'));
    }
}