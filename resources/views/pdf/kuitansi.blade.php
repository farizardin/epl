<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>PD Pasar Surya</title>

    <style>
        @page { margin: 0; }
        body {
            margin: 3%;
        }

        .td {
            border: 1px solid black;
        }

        .container {
            width: 100%;
        }

        .logo {
            width: 20%;
        }

        .logo img {
            width: 130px
        }

        .separator {
            border-top: 1px dotted;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
    <section>
        <div class="container">
            <table style="width:100%">
                <tbody>
                    <tr>
                        <td rowspan="2" class="logo"><img src="{{ asset('img/logo.png') }}" alt="logo"></td>
                        <td style="width:20%">Telah terima dari</td>
                        <td style="width:2%">:</td>
                        <td style="background-color: #e1e1ea; padding: 0 8px;">{{ strtoupper($detail_bn ? $detail_bn->nama_baru : $transaksi->nama) }}</td>
                    </tr>
                    <tr>
                        <td>Uang Sejumlah</td>
                        <td>:</td>
                        <td style="background-color: #e1e1ea; padding: 8px 8px;">{{ strtoupper(trim(\App\Helper::terbilang($transaksi->tarif))) }}</td>
                    </tr>
                    <tr>
                        <td><h2 style="margin: 4px">&nbsp;</h2></td>
                        <td>Untuk pembayaran</td>
                        <td>:</td>
                        <td style="background-color: #e1e1ea; padding: 0 8px;">{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</td>
                    </tr>
                    <tr>
                        <td><h2 style=" margin: 0">KUITANSI</h3></td>
                        <td colspan="3" style="background-color: #e1e1ea;"></td>
                    </tr>
                    <tr>
                        <td>No. :</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right; padding-right: 15%;">Surabaya, {{ $tgl }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">Penerima</td>
                    </tr>
                    <tr>
                        <td>&nbsp;<br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; padding: 10px; background-color: #e1e1ea;">{{ $transaksi->biaya }}</td>
                        <td></td>
                        <td style="width: 40%; text-align: center">{{ Auth::user()->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div class="separator"></div>

    <section style="padding-top: 20px">
        <div class="container">
            <table style="width:100%">
                <tbody>
                    <tr>
                        <td rowspan="2" class="logo"><img src="{{ asset('img/logo.png') }}" alt="logo"></td>
                        <td style="width:20%">Telah terima dari</td>
                        <td style="width:2%">:</td>
                        <td style="background-color: #e1e1ea; padding: 0 8px;">{{ strtoupper($detail_bn ? $detail_bn->nama_baru : $transaksi->nama) }}</td>
                    </tr>
                    <tr>
                        <td>Uang Sejumlah</td>
                        <td>:</td>
                        <td style="background-color: #e1e1ea; padding: 8px 8px;">{{ strtoupper(trim(\App\Helper::terbilang($transaksi->tarif))) }}</td>
                    </tr>
                    <tr>
                        <td><h2 style="margin: 4px">&nbsp;</h2></td>
                        <td>Untuk pembayaran</td>
                        <td>:</td>
                        <td style="background-color: #e1e1ea; padding: 0 8px;">{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</td>
                    </tr>
                    <tr>
                        <td><h2 style=" margin: 0">KUITANSI</h3></td>
                        <td colspan="3" style="background-color: #e1e1ea;"></td>
                    </tr>
                    <tr>
                        <td>No. :</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;padding-right: 15%;">Surabaya, {{ $tgl }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">Penerima</td>
                    </tr>
                    <tr>
                        <td>&nbsp;<br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; padding: 10px; background-color: #e1e1ea;">{{ $transaksi->biaya }}</td>
                        <td></td>
                        <td style="width: 40%; text-align: center">{{ Auth::user()->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div class="separator"></div>

    <section style="padding-top: 20px">
        <div class="container">
            <table style="width:100%">
                <tbody>
                    <tr>
                        <td rowspan="2" class="logo"><img src="{{ asset('img/logo.png') }}" alt="logo"></td>
                        <td style="width:20%">Telah terima dari</td>
                        <td style="width:2%">:</td>
                        <td style="background-color: #e1e1ea; padding: 0 8px;">{{ strtoupper($detail_bn ? $detail_bn->nama_baru : $transaksi->nama) }}</td>
                    </tr>
                    <tr>
                        <td>Uang Sejumlah</td>
                        <td>:</td>
                        <td style="background-color: #e1e1ea; padding: 8px 8px;">{{ strtoupper(trim(\App\Helper::terbilang($transaksi->tarif))) }}</td>
                    </tr>
                    <tr>
                        <td><h2 style="margin: 4px">&nbsp;</h2></td>
                        <td>Untuk pembayaran</td>
                        <td>:</td>
                        <td style="background-color: #e1e1ea; padding: 0 8px;">{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</td>
                    </tr>
                    <tr>
                        <td><h2 style=" margin: 0">KUITANSI</h3></td>
                        <td colspan="3" style="background-color: #e1e1ea;"></td>
                    </tr>
                    <tr>
                        <td>No. :</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;padding-right: 15%;">Surabaya, {{ $tgl }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">Penerima</td>
                    </tr>
                    <tr>
                        <td>&nbsp;<br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; padding: 10px; background-color: #e1e1ea;">{{ $transaksi->biaya }}</td>
                        <td></td>
                        <td style="width: 40%; text-align: center">{{ Auth::user()->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</body>
</html>