<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blangko Permohonan</title>
    <style>
        table.bordered {
            border-collapse: collapse;
        }

        table.bordered td,
        table.bordered th {
            border: 1px solid black;
        }

        table.unbordered td,
        table.unbordered th {
            border: none;
        }
    </style>
</head>
<body style="font-size:10px; padding: 2% 4%; font-family: arial">
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>Kepada Yth.</td>
                <td valign="top" style="text-align: right;">Surabaya, {{ $transaksi->tgl_permohonan->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td colspan="2">DIREKSI PD PASAR SURYA</td>
            </tr>
            <tr>
                <td colspan="2">Jl. Manyar Kertoarjo V/2</td>
            </tr>
            <tr>
                <td colspan="2">S u r a b a y a</td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <b>Perihal : Permohonan dan Rekomendasi <i><u>{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</u></i></b>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table style="width:100%">
        <tbody>
            <tr>
                <td colspan="4">Yang bertanda tangan di bawah ini, saya :</td>
            </tr>
            <tr>
                <td width="17%">Nama</td>
                <td width="1%">:</td>
                <td colspan="2">{{ $transaksi->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="2">{{ $transaksi->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor Stand</td>
                <td>:</td>
                <td colspan="2">{{ $transaksi->stand->no_stand }}</td>
            </tr>
            <tr>
                <td>Jenis Jualan</td>
                <td>:</td>
                <td width="25%"><b>{{ $transaksi->stand->jenis_jualan->nama }}</b></td>
                <td><b>Bentuk : <i>{{ $transaksi->stand->bentuk_stand->nama }}</i></b></td>
            </tr>
            <tr>
                <td>Unit Pasar</td>
                <td>:</td>
                <td colspan="2">{{ $transaksi->stand->pasar->nama }}</td>
            </tr>
            <tr>
                <td colspan="4">Mengajukan permohonan <b><i><u>{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</u></i></b>, kepada : </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td colspan="2">{{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="2">{{ $detail_bn ? $detail_bn->alamat_baru : $transaksi->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor Stand</td>
                <td>:</td>
                <td colspan="2">{{ $transaksi->stand->no_stand }}</td>
            </tr>
            <tr>
                <td>Jenis Jualan</td>
                <td>:</td>
                <td><b>{{ $transaksi->stand->jenis_jualan->nama }}</b></td>
                <td><b>Bentuk : <i>{{ $transaksi->stand->bentuk_stand->nama }}</i></b></td>
            </tr>
            <tr>
                <td colspan="4">Demikian permohonan ini disampaikan untuk mendapatkan persetujuan.</td>
            </tr>
        </tbody>
    </table>

    <br>

    <table style="width:100%">
        <tbody>
            <tr>
                <td width="80%"></td>
                <td style="text-align:center">
                    Pemohon <br><br><br><br>
                    {{ $transaksi->nama }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table class="bordered" style="width:100%;">
        <thead>
            <tr style="text-align:center">
                <th style="width: 50%"><b>PERSYARATAN</b></th>
                <th><b>PERHITUNGAN BIAYA</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border-bottom:none; padding:4px 0 0 4px">
                    Dilengkapi oleh Pedagang :
                    <ul style="list-style-type:square">
                        <li>Copy. KTP & KK</li>
                        <li>Pas Foto berwarna 3 x 3 terbaru</li>
                        <li>Materai 6.000 (2 lembar)</li>
                        <li>Copy Buku Stand & Kartu Stand</li>
                        <li>Surat Pernyataan</li>
                    </ul>
                    Dilengkapi Petugas : <br>
                    <ul style="list-style-type:square">
                        <li>Berita Acara Pemeriksaan Lapangan</li>
                        <li>Foto Stand</li>
                        <li>Denah Lokasi Stand</li>
                        <li>Surat Perjanjian</li>
                    </ul>
                </td>
                <td valign="bottom">
                    <table class="unbordered" style="width:100%">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <ul style="list-style-type: square;">
                                        @foreach (json_decode($transaksi->biaya_detail) as $biaya)
                                            <li>{{ $biaya->nama }}</li>										
                                        @endforeach
                                    </ul>
                                </td>
                                <td style="text-align: right">
                                    <ul style="list-style-type: none; text-align: right;">
                                        @foreach (json_decode($transaksi->biaya_detail) as $biaya)
                                            <li>{{ money_format('%n', $biaya->tarif) }}</li>										
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="border-top: none"></td>
                <td>
                    <table class="unbordered" style="width:100%">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <ul style="list-style-type: square;"><li>T o t a l</li></ul>
                                </td>
                                <td style="text-align:right">
                                    {{ $transaksi->biaya }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <br><br><br>

    <table class="bordered" style="width:100%">
        <thead>
            <tr>
                <th colspan="4" style="text-align:center"><b>REKOMENDASI</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="3%" style="text-align:center">1</td>
                <td width="35%" style="padding: 8px">
                    Kepala Unit Pasar <br><br><br>
                    {{ auth()->user()->name }}
                </td>
                <td width="28%" style="padding: 8px">
                    No.  : ............... <br><br>
                    Tgl. : ...............
                </td>
                <td style="padding: 8px">
                    <table class="unbordered" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><input type="checkbox"> Diteruskan</td>
                                <td><input type="checkbox"> Ditolak</td>
                            </tr>
                        </tbody>
                    </table>
                    <i>Catatan :</i>
                </td>
            </tr>
            <tr>
                <td style="text-align:center">2</td>
                <td style="padding: 8px">
                    Kepala Cabang <br><br><br>
                    {{ auth()->user()->pasar->cabang->kepala->name }}
                </td>
                <td style="padding: 8px">
                    No.  : ............... <br><br>
                    Tgl. : ...............
                </td>
                <td style="padding: 8px">
                    <table class="unbordered" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><input type="checkbox"> Diteruskan</td>
                                <td><input type="checkbox"> Ditolak</td>
                            </tr>
                        </tbody>
                    </table>
                    <i>Catatan :</i>
                </td>
            </tr>
            <tr>
                <td style="text-align:center">3</td>
                <td style="padding: 8px">
                    Kepala Bagian Bendahara <br><br><br>
                    ..................................
                </td>
                <td style="padding: 8px">
                    No.  : ............... <br><br>
                    Tgl. : ...............
                </td>
                <td style="padding: 8px">
                    <table class="unbordered" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><input type="checkbox"> Diteruskan</td>
                                <td><input type="checkbox"> Ditolak</td>
                            </tr>
                        </tbody>
                    </table>
                    <i>Catatan :</i>
                </td>
            </tr>
            <tr>
                <td style="text-align:center">4</td>
                <td style="padding: 8px">
                    Kepala Bagian Pemasaran <br><br><br>
                    {{ \App\User::getKPemasaran() }}
                </td>
                <td style="padding: 8px">
                    No.  : ............... <br><br>
                    Tgl. : ...............
                </td>
                <td style="padding: 8px">
                    <table class="unbordered" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><input type="checkbox"> Diteruskan</td>
                                <td><input type="checkbox"> Ditolak</td>
                            </tr>
                        </tbody>
                    </table>
                    <i>Catatan :</i>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>