<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blanko Rekapitulasi | PD Pasar Surya</title>

    <style type="text/css">
        @page {
            margin-bottom: 0;
        }

        .title {
            text-align: center;
            margin-bottom: .8cm;
        }

        .table {
            border-collapse: collapse;
            margin: auto;
            width: 100%;
            margin-bottom: 1cm;
        }

        .table td, th {
            border: 1px solid black;
            padding: 0.1cm;
            text-align: center;
        }
    </style>
</head>
<body>
<div>
    {{ $tanggal }}
</div>
<div class="title">
    REKAP PENGAJUAN PROSES PERPASARAN
</div>

<table class="table">
    <thead>
    <tr>
        <td>No.</td>
        <td>Nama Pedagang</td>
        <td>Pasar</td>
        <td>Lantai</td>
        <td>Std/Reg</td>
        <td>Luas</td>
        <td>Bentuk</td>
        <td>Jenis Jualan</td>
        <td>Proses</td>
        <td>Keterangan</td>
    </tr>
    </thead>
    <tbody>
    @foreach($transaksi as $i => $t)
        <tr>
            <td height="50">{{ $i+1 }}</td>
            <td>{{ $t->nama }}</td>
            <td>{{ $t->stand->pasar->nama }}</td>
            <td>{{ $t->stand->lantai ? $t->stand->lantai->nama : '-' }}</td>
            <td>{{ $t->stand->no_reg }}</td>
            <td>{{ $t->stand->luas }}</td>
            <td>{{ $t->stand->bentuk_stand ? $t->stand->bentuk_stand->nama : '-' }}</td>
            <td>{{ $t->stand->jenis_jualan ? $t->stand->jenis_jualan->nama : '-' }}</td>
            <td>{{ implode(', ', $t->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
            <td>{{ $t->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table style="margin: auto; width: 80%; text-align: center">
    <tbody>
    <tr>
        <td width="30%">Pemasaran</td>
        <td width="5%"></td>
        <td width="30%">Cabang</td>
        <td width="5%"></td>
        <td width="30%">Unit</td>
    </tr>
    <tr>
        <td height="60" style="border-bottom: 1px solid black"></td>
        <td></td>
        <td style="border-bottom: 1px solid black"></td>
        <td></td>
        <td style="border-bottom: 1px solid black"></td>
    </tr>
    </tbody>
</table>
</body>
</html>