<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BKMC | PD Pasar Surya</title>

    <style type="text/css">
        @page {
            margin: .7cm;
        }

        body {
            font-size: x-small;
        }

        table {
            border-collapse: collapse;
            margin: auto;
        }

        .table td, th {
            border: 1px solid black;
            text-align: center;
            padding: .1cm;
        }

        .nomor {
            width: 20%;
            margin-left: 80%;
        }

        .unborder td {
            border: unset;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="nomor" style="margin-bottom: .3cm">
        No.
    </div>
    <table class="table" width="100%">
        <tbody>
        <tr>
            <td width="20%" rowspan="2"><img src="{{ asset('img/logo.png') }}" style="width: 2cm;"></td>
            <td rowspan="2">BUKTI KAS MASUK CABANG</td>
            <td rowspan="2">B K M C</td>
            <td style="text-align: left">NO. :</td>
        </tr>
        <tr>
            <td style="text-align: left">TGL. :</td>
        </tr>
        </tbody>
    </table>

    <table class="table" width="100%">
        <tbody>
        <tr>
            <td width="40%" style="text-align: left">DARI UNIT PASAR: {{ $transaksi->stand->pasar->nama }}</td>
            <td width="15%" style="text-align: left">KODE: {{ $transaksi->stand->pasar->id }}</td>
            <td width="30%" style="text-align: left">CABANG: {{ $transaksi->stand->pasar->cabang->nama }}</td>
            <td width="15%" style="text-align: left">KODE: {{ $transaksi->stand->pasar->cabang->id }}</td>
        </tr>
        </tbody>
    </table>

    <table class="table" width="100%">
        <tbody>
        <tr>
            <td style="padding: .4cm">
                <table class="unborder" width="100%">
                    <tbody>
                    <tr>
                        <td width="25%">DITERIMA DARI</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td>{{ $detail_bn ? strtoupper($detail_bn->nama_baru) : strtoupper($transaksi->nama) }}</td>
                    </tr>
                    <tr>
                        <td>ALAMAT</td>
                        <td>:</td>
                        <td>{{ $detail_bn ? strtoupper($detail_bn->alamat_baru) : strtoupper($transaksi->alamat) }}</td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>UANG SEJUMLAH</td>
                        <td>:</td>
                        <td>{{ $transaksi->biaya }}</td>
                    </tr>
                    </tbody>
                </table>
                
                <table class="unborder" width="100%" style="margin-top: 3px">
                    <tbody>
                    <tr>
                        <td width="10%" height="15"></td>
                        <td style="background: lightgrey;">{{ strtoupper(trim(\App\Helper::terbilang($transaksi->tarif))) }}</td>
                    </tr>
                    </tbody>
                </table>

                <table class="unborder" width="100%" style="margin-top: 5px">
                    <tbody>
                    <tr>
                        <td width="30%">UNTUK PEMBAYARAN</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

                <table class="unborder" width="100%">
                    <tbody>
                    <tr>
                        <td width="10%" height="15"></td>
                        <td style="border-bottom: 1px solid black; font-size: small; word-wrap:break-word">
                            @foreach (json_decode($transaksi->biaya_detail) as $biaya)
                                {{ $biaya->nama . ": " . money_format("%n", $biaya->tarif) }}
                                @if (!$loop->last) , @endif
                            @endforeach
                        </td>
                    </tr>
                    {{-- <tr>
                        <td height="15"></td>
                        <td style="border-bottom: 1px solid black"></td>
                    </tr>
                    <tr>
                        <td height="15"></td>
                        <td style="border-bottom: 1px solid black"></td>
                    </tr>
                    <tr>
                        <td height="15"></td>
                        <td style="border-bottom: 1px solid black"></td>
                    </tr> --}}
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="table" width="100%">
        <tbody>
        <tr>
            <td width="25%">DISETOR OLEH</td>
            <td width="25%">DITERIMA OLEH</td>
            <td width="25%">MENYETUJUI</td>
            <td width="25%">DITELITI OLEH</td>
        </tr>
        <tr>
            <td height="50"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>KA KANTOR CABANG</td>
            <td>SUB. BAG. AKT. UMUM</td>
        </tr>
        <tr>
            <td colspan="4">REKAPITULASI<br>( diisi oleh SUB. BAG. AKUNTANSI UMUM )</td>
        </tr>
        <tr>
            <td colspan="2">KODE PERKIRAAN</td>
            <td>DEBET</td>
            <td>KREDIT</td>
        </tr>
        <tr>
            <td colspan="2" height="50"></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</body>
</html>