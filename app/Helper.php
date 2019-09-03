<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    public static function tgl_indo($tanggal){
        $bulan = array (
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $tmp = explode('-', $tanggal);
        
        return $tmp[2] . ' ' . $bulan[ (int)$tmp[1] - 1 ] . ' ' . $tmp[0];
    }

    public static function getHari($dayOfWeek) {
        $hari = [
            'Minggu',
            'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
        ];

        return $hari[$dayOfWeek];
    }

    public static function getBulan($bulan) {
        $nama_bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return $nama_bulan[$bulan - 1];
    }

    public static function terbilang($nilai) {
        $nilai = abs($nilai);
        $huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $temp = "";

        if ($nilai < 12) {
            $temp = $nilai > 0 ? " ". $huruf[$nilai] : "";
        } else if ($nilai < 20) {
            $temp = self::terbilang($nilai % 10). " belas";
        } else if ($nilai < 100) {
            $temp = self::terbilang($nilai / 10)." puluh". self::terbilang($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . self::terbilang($nilai % 100);
        } else if ($nilai < 1000) {
            $temp = self::terbilang($nilai / 100) . " ratus" . self::terbilang($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . self::terbilang($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::terbilang($nilai/1000) . " ribu" . self::terbilang($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::terbilang($nilai/1000000) . " juta" . self::terbilang($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::terbilang($nilai/1000000000) . " milyar" . self::terbilang(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::terbilang($nilai/1000000000000) . " trilyun" . self::terbilang(fmod($nilai,1000000000000));
        }

        return $temp;
    }
}