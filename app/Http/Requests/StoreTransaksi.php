<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Proses;

class StoreTransaksi extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_stand' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telp' => 'required',
            'tgl_lahir' => 'required',
            'foto' => 'image|nullable',
            'biaya' => 'required',
            'biaya_detail' => 'required',
            'keterangan' => 'nullable',
            'jenisproses' => 'required|array',
            'biaya_it' => 'required_with:jenisproses.'.Proses::IT,
            'biaya_detail_it' => 'required_with:jenisproses.'.Proses::IT,
            'nik_it' => 'required_with:jenisproses.'.Proses::IT,
            'nama_it' => 'required_with:jenisproses.'.Proses::IT,
            'alamat_it' => 'required_with:jenisproses.'.Proses::IT,
            'kota_it' => 'required_with:jenisproses.'.Proses::IT,
            'telp_it' => 'required_with:jenisproses.'.Proses::IT,
            'tgl_lahir_it' => 'required_with:jenisproses.'.Proses::IT,
            'foto_it' => 'nullable',
            'biaya_bn' => 'required_with:jenisproses.'.Proses::BN,
            'biaya_detail_bn' => 'required_with:jenisproses.'.Proses::BN,
            'nik_baru' => 'required_with:jenisproses.'.Proses::BN,
            'nama_baru' => 'required_with:jenisproses.'.Proses::BN,
            'alamat_baru' => 'required_with:jenisproses.'.Proses::BN,
            'kota_baru' => 'required_with:jenisproses.'.Proses::BN,
            'telp_baru' => 'required_with:jenisproses.'.Proses::BN,
            'tgl_lahir_baru' => 'required_with:jenisproses.'.Proses::BN,
            'foto_baru' => 'nullable',
            'biaya_her' => 'required_with:jenisproses.'.Proses::Her,
            'biaya_detail_her' => 'required_with:jenisproses.'.Proses::Her,
            'biaya_sij' => 'required_with:jenisproses.'.Proses::SIJ,
            'biaya_detail_sij' => 'required_with:jenisproses.'.Proses::SIJ,
            'id_jenis_jualan_lama' => 'required_with:jenisproses.'.Proses::SIJ,
            'id_jenis_jualan_baru' => 'required_with:jenisproses.'.Proses::SIJ,
            'biaya_sib' => 'required_with:jenisproses.'.Proses::SIB,
            'biaya_detail_sib' => 'required_with:jenisproses.'.Proses::SIB,
            'id_bentuk_stand_lama' => 'required_with:jenisproses.'.Proses::SIB,
            'id_bentuk_stand_baru' => 'required_with:jenisproses.'.Proses::SIB,
            'biaya_ips' => 'required_with:jenisproses.'.Proses::IPS,
            'biaya_detail_ips' => 'required_with:jenisproses.'.Proses::IPS,
            'biaya_ganti_buku' => 'required_with:jenisproses.'.Proses::BHPTU,
            'biaya_detail_ganti_buku' => 'required_with:jenisproses.'.Proses::BHPTU,
        ];
    }
}
