<!DOCTYPE html>
<html>
<head>
	<title>Surat Pernyataan</title>
	<style type="text/css">
		.dotted {
			border-bottom: 1px black dashed;
			text-align: left;
			width: 70%;
		}
		.valg tr td{
			vertical-align: top;
		}
	</style>
	@php
		$detail_proses = $proses_bn->detail_proses();
		//$detail_proses = \App\ProsesBN::where('id_proses', 64)->first();
		//dd($proses_bn->id);
	@endphp
</head>
<body>
	<div class="container" style="padding: 3% 5% 0 5%; font-size: .75rem; font-family: arial;">
		<div class="row" style="text-align: center;"><h2>SURAT - PERNYATAAN</h2><br></div>
		<div class="row">
			<p>Pada hari ini {{ $hari }} Tanggal {{ $tgl }} Bulan {{ $bulan }} Tahun {{ $tahun }}, Saya yang bertanda tangan dalam pernyataan ini :</p>
		</div>
		<div class="row">
			<table style="width: 100%;" class="valg"><tbody>
				<tr>
					<td style="width: 30%;">Nama</td>
					<td style="width: 1%;">:</td>
					<td  >{{ $detail_proses->nama_baru }}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td  >{{ $detail_proses->alamat_baru }}</td>
				</tr>
				<tr>
					<td>Nomor KTP</td>
					<td>:</td>
					<td  >{{ $detail_proses->nik_baru }}</td>
				</tr>
			</tbody></table>
		</div>
		<div class="row">
			<p>( Selanjutnya sebagai <b>PIHAK KEDUA</b> )</p>
		</div>
		<div class="row">
			<p>Dengan ini menyatakan bahwa saya telah <b>mengambil alih pemakaian stand</b> dari :</p>
		</div>
		<div class="row">
			<table style="width: 100%;" class="valg"><tbody>
				<tr>
					<td style="width: 30%;">Nama</td>
					<td style="width: 1%;">:</td>
					<td  >{{ $detail_proses->nama_lama }}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td  >{{ $detail_proses->alamat_lama }}</td>
				</tr>
				<tr>
					<td>Nomor KTP</td>
					<td>:</td>
					<td  >{{ $detail_proses->nik_lama }}</td>
				</tr>
			</tbody></table>
		</div>
		<div class="row">
			<p>( Selanjutnya sebagai <b>PIHAK PERTAMA</b> )</p>
		</div>
		<div class="row">
			<table style="width: 100%;" class="valg"><tbody>
				<tr>
					<td style="width: 30%;">Yang terletak di Pasar</td>
					<td style="width: 1%;">:</td>
					<td  >{{ $transaksi->stand->pasar->nama }}</td>
				</tr>
				<tr>
					<td>No. Stand/Lantai</td>
					<td>:</td>
					<td  >{{ $transaksi->stand->no_stand }} / {{ $transaksi->stand->lantai->nama }}</td>
				</tr>
				<tr>
					<td>Luas Stand</td>
					<td>:</td>
					<td  >{{ $transaksi->stand->luas }} m<sup>2</sup></td>
				</tr>
				<tr>
					<td>Bentuk Stand</td>
					<td>:</td>
					<td  >{{ $transaksi->stand->bentuk_stand->nama }}</td>
				</tr>
				<tr>
					<td>No. Regin</td>
					<td>:</td>
					<td  >{{ $transaksi->stand->no_reg }}</td>
				</tr>
				<tr>
					<td>No. Buku/ No. PPTU</td>
					<td>:</td>
					<td  >{{ @$transaksi->stand->bhptu->nomor }}</td>
				</tr>
				<tr>
					<td>Jenis Jualan</td>
					<td>:</td>
					<td  >{{ $transaksi->stand->jenis_jualan->nama }}</td>
				</tr>
			</tbody></table>
		</div>
		<div class="row">
			<p style="text-align: justify;">
				Sehubungan dengan penertiban administrasi yang dilakukan oleh PD. Pasar Surya atas pemakaian stand-stand pasar dibawah pengelolaan PD.Pasar Surya, maka demi memberikan kepastian kepada PD. Pasar Surya dengan ini saya memberikan pernyataan sebenar-benarnya dan sanggup diangkat sumpah,sebagai berikut :<br><br>
			</p>
			<table style="width: 100%; text-align: justify;" class="valg">
				<tbody>
					<tr>
						<td>1.</td>
						<td>Bahwa saya bertanggung jawab sepenuhnya dengan melepaskan pihak lain dari tanggungjawab berkenaan dengan pemakaian tersebut diatas.</td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Bahwa saya memperoleh/menguasai pemakaian stand tersebut diatas dengan cara mengambil alih pemakaian stand dari PIHAK PERTAMA secara dibawah tangan dengan mendahului persetujuan dari PD. Pasar Surya.</td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Bahwa saya sanggup mematuhi dan mentaati segala peraturan yang ditetapkan olehPD. Pasar Surya, serta bertanggung jawab sepenuhnya apabila ada tuntutan dalam bentuk apapun baik pidana maupun perdata sehubungan dengan pernyataan ini dengan melepaskan semua pihak dari tanggung jawab atas tuntutan tersebut.</td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Bahwa bilamana terjadi atau ada tuntutan baik perdata maupun pidana dari pihak manapun juga, maka saya seketika itu juga akan mengembalikan hak pemakaian terhadap stand tersebut diatas kepada PD. Pasar Surya tanpa untuk itu tidak meminta ganti rugi berupa apapun juga dari PD. Pasar Surya.</td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Bahwa segala akibat sehubungan dengan pernyataan ini saya memilih tempat dan kedudukan hukum yang umum dan tetap di Kepaniteraan Pengadilan Negeri Surabaya.</td>
					</tr>
				</tbody>
			</table>
			<p>Demikian pernyataan ini dibuat dan diselesaikan di Surabaya tanpa adanya unsur paksaan dari pihak manapun.<br><br></p>
		</div>
		<div class="row" style="text-align:right">
			Surabaya, {{ $tanggal }}<br><br><br>
			Yang Menyatakan,<br><br><br>
			Materai 6000<br><br><br>
			{{ $detail_proses->nama_baru }}<br><br><br>
		</div>
	</div>
</body>
</html>
