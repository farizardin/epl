<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Blangko Permohonan</title>
	<style type="text/css">
		.bordered {
			border: 1px solid black;
		}

		.dotted {
			border-bottom: 1px black dotted;
		}

		.nma {
			padding-left: 0px;
		}

		.bottom td {
			padding-left: 10px;
		}

		#low {
			border-collapse: collapse;
		}

		#new {
			border-collapse: collapse;
			page-break-inside:auto;
		}

		#new tr{
			page-break-inside:avoid;
			page-break-after:auto;
		}

		.col2 td {
			border: none;
		}

		.r {
			border-right: 1px black solid;
		}

		.l {
			border-left: 1px black solid;
		}

		.t {
			border-top: 1px black solid;
			padding-top: 10px;
		}
	</style>
</head>
<body>
<div class="container" style="margin: 2% 4%; font-size: 10px;font-family: arial;">
	<div class="row">
		<table style="width: 100%;">
			<tbody>
			<tr>
				<td>Kepada Yth.</td>
				<td style="text-align: right;">Surabaya, {{ $transaksi->tgl_permohonan->format('d/m/Y') }}</td>
			</tr>
			<tr>
				<td>DIREKSI PD PASAR SURYA</td>
			</tr>
			<tr>
				<td>Jl. Manyar Kertoarjo V/ 2</td>
			</tr>
			<tr>
				<td>S&nbsp;u&nbsp;r&nbsp;a&nbsp;b&nbsp;a&nbsp;y&nbsp;a</td>
			</tr>
			<tr>
				<td colspan="2"><br><b>Perihal&nbsp;&nbsp;:&nbsp;Permohonan dan Rekomendasi <i><u>{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</u></i></b></td>
			</tr>
			</tbody>
		</table>
		<table style="width: 100%; padding-right: 30%;">
			<tbody>
			<tr>
				<td colspan="4"><br>Yang bertanda tangan di bawah ini, saya :</td>
			</tr>
			<tr>
				<td class="nma" style="width: 10%;">Nama</td>
				<td style="width: 1%;">:</td>
				<td style="width: 30%;" colspan="2">{{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</td>
			</tr>
			<tr>
				<td class="nma">Alamat</td>
				<td>:</td>
				<td colspan="2">{{ $detail_bn ? $detail_bn->alamat_baru : $transaksi->alamat }}</td>
			</tr>
			<tr>
				<td class="nma">Nomor Stand</td>
				<td>:</td>
				<td colspan="2">{{ $transaksi->stand->no_stand }}</td>
			</tr>
			<tr>
				<td class="nma">Jenis Jualan</td>
				<td>:</td>
				<td style="width: 10%"><b>{{ $transaksi->stand->jenis_jualan->nama }}</b></td>
				<td><b>Bentuk : <i>{{ $transaksi->stand->bentuk_stand->nama }}</i></b></td>
			</tr>
			<tr>
				<td class="nma">Unit Pasar</td>
				<td>:</td>
				<td style="width: 30%;" colspan="2">{{ $transaksi->stand->pasar->nama }}</td>
			</tr>
			</tbody>
		</table>
		<table style="width: 100%; padding-right: 30%;">
			<tbody>
			<tr>
				<td colspan="4">Mengajukan permohonan <b><i><u>{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}</u></i></b>, kepada :
				</td>
			</tr>
			<tr>
				<td class="nma" style="width: 10%;">Nama</td>
				<td style="width: 1%;">:</td>
				<td style="width: 30%;" colspan="2">{{ $transaksi->nama }}</td>
			</tr>
			<tr>
				<td class="nma">Alamat</td>
				<td>:</td>
				<td colspan="2">{{ $transaksi->alamat }}</td>
			</tr>
			<tr>
				<td class="nma">Nomor Stand</td>
				<td>:</td>
				<td colspan="2">{{ $transaksi->stand->no_stand }}</td>
			</tr>
			<tr>
				<td class="nma">Jenis Jualan</td>
				<td>:</td>
				<td style="width: 10%"><b>{{ $transaksi->stand->jenis_jualan->nama }}</b></td>
				<td><b>Bentuk : <i>{{ $transaksi->stand->bentuk_stand->nama }}</i></b></td>
			</tr>
			</tbody>
		</table>
		<table style="width: 100%;">
			<tbody>
			<tr>
				<td>Demikian permohonan ini disampaikan untuk mendapat persetujuan.<br><br></td>
			</tr>
			</tbody>
		</table>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td width="80%"></td>
					<td style="text-align: center; padding-right: 2%; margin-top:10%">Pemohon</td>
				</tr>
			</tbody>
		</table>
		<table style="width: 100%; padding-bottom: 1%; margin-top: 4%;">
			<tbody>
			<tr>
				<td width="80%"></td>
				<td style="text-align: center;padding-right: 2%;">{{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="row" style="font-size: 10px;font-family: arial;">
		<table id="new" style="width: 100%; border: 1px black solid;font-size: 10px;font-family: arial;">
			<tbody>
			<tr style="page-break-after: avoid;">
				<th align="center" class="bordered" style="width: 50%; "><b>PERSYARATAN</b></th>
				<th align="center" class="bordered" style="width: 50%; "><b>PERHITUNGAN BIAYA</b></th>
			</tr>
			<tr style="page-break-before: avoid;">
				<td class="r" style="width: 50%;">Dilengkapi oleh Pedagang :</td>
				<td rowspan="4">
					<table class="col2" style="width: 100%">
						<tbody>
						<tr>
							<td style="width: 50%;">
								<ul style="list-style-type: square;">
									@foreach (json_decode($transaksi->biaya_detail) as $biaya)
										<li>{{ $biaya->nama }}</li>										
									@endforeach
								</ul>
							</td>
							<td><ul style="list-style-type: none; text-align: right;">
									@foreach (json_decode($transaksi->biaya_detail) as $biaya)
										<li>{{ money_format('%n', $biaya->tarif) }}</li>										
									@endforeach
								</ul>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;border-top: 1px black solid">
								<ul style="list-style-type: square;"><li>T&nbsp;o&nbsp;t&nbsp;a&nbsp;l</li></ul>
							</td>
							<td style="border-top: 1px black solid">
								<ul style="list-style-type: none;">
									<li>{{ $transaksi->biaya }}</li>
								</ul>
							</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td class="r">
					<ul style="list-style-type:square">
					  <li>Copy. KTP & KK</li>
					  <li>Pas Foto berwarna 3 x 3 terbaru</li>
					  <li>Copy Buku Stand & Kartu Stand</li>
					  <li>Materai 6.000 (2 lembar)</li>
					  <li>Surat Pernyataan</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td class="r">Dilengkapi Petugas :</td>
			</tr>
			<tr>
				<td class="r">
					<ul style="list-style-type:square">
					  <li>Berita Acara Pemeriksaan Lapangan</li>
					  <li>Foto Stand</li>
					  <li>Denah Lokasi Stand</li>
					  <li>Surat Perjanjian</li>
					</ul>
				</td>
			</tr>
			</tbody>
		</table>
		<table id="low" class="bottom" style="width: 100%; border: 1px black solid;font-size: 10px;font-family: arial;">
			<tbody>
			<tr>
				<td align="center" colspan="4" class="bordered"><b>REKOMENDASI</b></td>
			</tr>
			<!-- no 1 -->
			<tr>
				<td class="r" rowspan="3" style="padding-top: 3px; width: 1%;">1</td>
				<td style="text-align: left;" class="t">Kepala Unit Pasar</td>
				<td class="l" style="padding-top: 10px;">No. : ....................</td>
				<td class="l">
					<table style="width: 100%;">
						<tbody>
						<tr>
							<td style="width: 40%;"><input type="checkbox"> Diteruskan</td>
							<td><input type="checkbox"> Ditolak</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="l" style="padding-top: 3px;">Tgl. : ....................</td>
				<td class="l"><i>Catatan :</i></td>
			</tr>
			<tr>
				<td style="margin-bottom: 10px;">{{ auth()->user()->name }}&nbsp;</td>
				<td class="l"></td>
				<td class="l"></td>
			</tr>
			<!-- no 2 -->
			<tr>
				<td class="r" rowspan="3" style="padding-top: 10px; width: 1%;border-top: 1px black solid;">2</td>
				<td style="text-align: left;border-top: 1px black solid;" class="t">Kepala Cabang</td>
				<td class="l" style="padding-top: 3px;border-top: 1px black solid;">No. : ....................</td>
				<td class="l" style="border-top: 1px black solid;">
					<table style="width: 100%;">
						<tbody>
						<tr>
							<td style="width: 40%;"><input type="checkbox"> Diteruskan</td>
							<td><input type="checkbox"> Ditolak</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="l" style="padding-top: 3px;">Tgl. : ....................</td>
				<td class="l"><i>Catatan :</i></td>
			</tr>
			<tr>
				<td style="margin-bottom: 10px;">{{ auth()->user()->pasar->cabang->kepala->name }}&nbsp;</td>
				<td class="l"></td>
				<td class="l"></td>
			</tr>
			<!-- no 3 -->
			<tr>
				<td class="r" rowspan="3" style="padding-top: 10px; width: 1%;border-top: 1px black solid;">3</td>
				<td style="text-align: left;border-top: 1px black solid;" class="t">Kepala Bagian Bendahara</td>
				<td class="l" style="padding-top: 10px;border-top: 1px black solid;">No. : ....................</td>
				<td class="l" style="border-top: 1px black solid;">
					<table style="width: 100%;">
						<tbody>
						<tr>
							<td style="width: 40%;"><input type="checkbox"> Diteruskan</td>
							<td><input type="checkbox"> Ditolak</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="l" style="padding-top: 3px;">Tgl. : ....................</td>
				<td class="l"><i>Catatan :</i></td>
			</tr>
			<tr>
				<td style="margin-bottom: 10px;">...............................&nbsp;</td>
				<td class="l"></td>
				<td class="l"></td>
			</tr>
			<!-- no 4 -->
			<tr>
				<td class="r" rowspan="3" style="padding-top: 10px; width: 1%;border-top: 1px black solid;">4</td>
				<td style="text-align: left;border-top: 1px black solid;" class="t">Kepala Bagian Pemasaran</td>
				<td class="l" style="padding-top: 10px;border-top: 1px black solid;">No. : ....................</td>
				<td class="l" style="border-top: 1px black solid;">
					<table style="width: 100%;">
						<tbody>
						<tr>
							<td style="width: 40%;"><input type="checkbox"> Diteruskan</td>
							<td><input type="checkbox"> Ditolak</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="l" style="padding-top: 3px;">Tgl. : ....................</td>
				<td class="l"><i>Catatan :</i></td>
			</tr>
			<tr>
				<td style="margin-bottom: 10px;">{{ \App\User::getKPemasaran() }}&nbsp;</td>
				<td class="l"></td>
				<td class="l"></td>
			</tr>
		</tbody></table></div>
	</div>
</div>
</body>
</html>