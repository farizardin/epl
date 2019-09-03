<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Kartu Stand | PD Pasar Surya</title>

	<style type="text/css">
		@page {
			margin-bottom: 0;
		}

		.logo {
			text-align: center;
		}

		.logo img {
			height: 3cm;
		}

		.contact {
			text-align: center;
			margin-top: .3cm;
			margin-bottom: .5cm;
		}

		.table {
			border-collapse: collapse;
		}

		.table td, th {
			border: 1px solid black;
			padding: 0.2cm;
		}

		.form {
			margin-top: .7cm;
		}

		.form td {
			padding: .2cm 0 .2cm 0;
		}

		.foto img {
			width: 4.1cm;
			max-height: 5.47cm;
		}

		.dotted {
  			border-bottom: 1px black dashed;
		}

		.ttd {
			text-align: center;
			margin-top: 1cm;
		}

		.ttd p {
			margin-top: 2cm;
		}
	</style>
</head>
<body>
	<div class="proses">
		<b>PROSES</b><br>
		<b>{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama')->toArray()) }}</b>
	</div>
	<!-- {{-- <div class="logo">
		<img src="{{ asset('template/images/logo.png') }}" alt="logo" style="opacity: .8">
	</div>
	<div class="contact">
		Jl. Manyar Kertoarjo V / 2 Surabaya 60285 | (031) 5947573 |<br>
		Fax: (031) 5944747 | info@pasarsurya.com | pasarsurya.com
	</div> --}} -->
	<div style="margin-top: 15%;">
		<table class="table" style="width: 50%; margin: auto;">
			<tbody>
			<tr>
				<td style="font-size: 24px; text-align: center"><b>KARTU STAND</b></td>
			</tr>
			<tr>
				<td style="text-align: center"><b>Nomor</b> : {{ @$transaksi->stand->bhptu->nomor }}</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="form">
		<table style="width: 90%; margin: auto;">
			<tr>
				<td style="width: 43%">NAMA PEMEGANG</td>
				<td width="2%">:</td>
				<td rowspan="4" style="width: 25%;padding: 0"	 class="foto">
					<img src="{{ asset(Storage::url($transaksi->stand->pedagang->foto)) }}" alt="foto">
				</td>
				<td class="dotted"><b>{{ strtoupper($transaksi->stand->pedagang->nama) }}</b></td>
			</tr>
			<tr>
				<td>A L A M A T</td>
				<td>:</td>
				<td class="dotted"><b>{{ strtoupper($transaksi->stand->pedagang->alamat) }}</b></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td class="dotted"><b>{{ strtoupper($transaksi->stand->pedagang->kota) }}</b></td>
			</tr>
			<tr>
				<td>NO. KTP</td>
				<td>:</td>
				<td class="dotted"><b>{{ $transaksi->stand->pedagang->nik }}</b></td>
			</tr>
			<tr>
				<td>NOMOR REGISTER INDUK</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ $transaksi->stand->no_reg }}</b></td>
			</tr>
			<tr>
				<td>NOMOR STAND</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ $transaksi->stand->no_stand }}</b></td>
			</tr>
			<tr>
				<td>BENTUK STAND</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ strtoupper($transaksi->stand->bentuk_stand->nama) }}</b></td>
			</tr>
			<tr>
				<td>P A S A R</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ strtoupper($transaksi->stand->pasar->nama) }}</b></td>
			</tr>
			<tr>
				<td>LANTAI</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ strtoupper($transaksi->stand->lantai ? $transaksi->stand->lantai->nama : '-') }}</b></td>
			</tr>
			<tr>
				<td>JENIS JUALAN</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ strtoupper($transaksi->stand->jenis_jualan->nama) }}</b></td>
			</tr>
			<tr>
				<td>LUAS</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ $transaksi->stand->luas }}</b></td>
			</tr>
			<tr>
				<td>AIR</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ $transaksi->stand->air ? 'ADA' : 'TIDAK ADA' }}</b></td>
			</tr>
			<tr>
				<td>DAYA LISTRIK</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ strtoupper($transaksi->stand->daya_listrik ? $transaksi->stand->daya_listrik->nama : '-') }} WATT</b></td>
			</tr>
			<tr>
				<td>TELP</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ strtoupper($transaksi->stand->pedagang->telp) }}</b></td>
			</tr>
			<tr>
				<td>MASA BERLAKU SAMPAI DENGAN</td>
				<td>:</td>
				<td class="dotted" colspan="2"><b>{{ date('d-m-Y', strtotime(@$transaksi->stand->pptu->tgl_berlaku)) }}</b></td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td>DIKELUARKAN DI : <b>SURABAYA</b></td>
				<td></td>
				<td colspan="2">PADA TANGGAL : <b>{{ date('d-m-Y', strtotime(@$transaksi->stand->pptu->tanggal)) }}</b></td>
			</tr>
		</table>
	</div>

	<div class="ttd">
		<b>A. n Perusahaan Daerah Pasar Surya<br>
			Kota Surabaya<br>
			@if ($only_her)
				KEPALA BAGIAN PEMASARAN
			@else
				DIREKTUR TEKNIK DAN USAHA
			@endif
		</b>
		<p><b>{{ $only_her ? strtoupper(\App\User::getKPemasaran()) : strtoupper(\App\User::getDirektur()) }}</b></p>
	</div>

</body>
</html>
