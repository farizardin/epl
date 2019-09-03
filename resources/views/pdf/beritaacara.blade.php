<!DOCTYPE html>
<html>
<head>
	<title>Berita Acara</title>
	<style type="text/css">
		ul, li{
			margin: 0;
		}

		table {
			border-collapse: collapse;
		}

		.bordered td {
			border: 1px solid black;
			padding-left: 8px;
		}

		.non-bordered td {
			border: unset;
		}
		#tbl tr td table tr td{
			vertical-align: top;
		}
	</style>
</head>
<body>
	<div class="container" style="padding: 0 32px; font-size: 11px; font-family: arial;">
		<div class="row" style="text-align: center;">
			<p><h3>BERITA ACARA PEMERIKSAAN<br></h3></p>
		</div>
		<hr>
		<br>
		<div class="row">
			<p>Pada hari ini {{ @$hari }} Tanggal {{ @$tgl }} Bulan {{ @$bulan  }} Tahun {{ @$tahun }}, berdasarkan permohonan {{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama')->toArray()) }}  :</p>
		</div>
		<div class="row">
			<table style="width: 100%;" id="tbl">
				<tr>
					<td style="width: 50%;"><b>I. PIHAK KE-1</b></td>
					<td><b>II. PIHAK KE-2*</b></td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Nama</td>
								<td>: {{ @$transaksi->nama }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Nama</td>
								<td>: {{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Alamat</td>
								<td>: {{ @$transaksi->alamat }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%">Alamat</td>
								<td>: {{ $detail_bn ? $detail_bn->alamat_baru : $transaksi->alamat }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%">KTP</td>
								<td>: {{ @$transaksi->nik }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">KTP</td>
								<td>: {{ $detail_bn ? $detail_bn->nik_baru : $transaksi->nik }}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div class="row">
			<p>Telah dilakukan pemeriksaan administrasi dan tinjauan lokasi di Unit Pasar {{ @title_case($transaksi->stand->pasar->nama) }} dengan hasil sebagai berikut :</p>
		</div>
		<div class="row">
			<table style="width: 100%;" id="tbl">
				<tr>
					<td style="width: 50%;"><b>I. DATA ADMINISTRASI/ REGIN</b></td>
					<td><b>II. DATA SESUAI LAPANGAN</b></td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">No Regin</td>
								<td>: {{ @$transaksi->stand->no_reg }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">No. Regin</td>
								<td>: {{ @$transaksi->stand->no_reg }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">No Stand</td>
								<td>: {{ @$transaksi->stand->no_stand }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">No Stand</td>
								<td>: {{ @$transaksi->stand->no_stand }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Bentuk </td>
								<td>: {{ @$transaksi->stand->bentuk_stand->nama }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Bentuk </td>
								<td>: {{ $detail_sib ? $detail_sib->bentuk_stand_baru->nama : $transaksi->stand->bentuk_stand->nama }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Jenis Jualan</td>
								<td>: {{ @$transaksi->stand->jenis_jualan->nama }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Jenis Jualan</td>
								<td>: {{ $detail_sij ? $detail_sij->jenis_jualan_baru->nama : $transaksi->stand->jenis_jualan->nama }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Luas</td>
								<td>: {{ @$transaksi->stand->panjang.' M' }} X {{ @$transaksi->stand->lebar.' M' }} = {{ @$transaksi->stand->luas.' M' }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Luas</td>
								<td>: {{ @$transaksi->stand->panjang.' M' }} X {{ @$transaksi->stand->lebar.' M' }} = {{ @$transaksi->stand->luas.' M' }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Listrik</td>
								<td>: {{ $transaksi->stand->daya_listrik ? $transaksi->stand->daya_listrik->nama : '-' }} Watt</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Listrik</td>
								<td>: {{ $transaksi->stand->daya_listrik ? $transaksi->stand->daya_listrik->nama : '-' }} Watt</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Air </td>
								<td>: {{ @$transaksi->stand->air ? 'ADA' : 'TIDAK ADA' }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Air </td>
								<td>: {{ @$transaksi->stand->air ? 'ADA' : 'TIDAK ADA' }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Status</td>
								<td>: {{ @$transaksi->stand->status }}</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width: 100%;" class="non-bordered">
							<tr>
								<td style="width: 20%;">Status</td>
								<td>: {{ @$transaksi->stand->status }}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div><br>
		<div class="row">
			<div>III. Kesimpulan :</div><br>
			<table style="width: 100%;">
				<tr>
					<td><ul><li>Nama</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>proses BN/ IT/ HER*</td>
				</tr>
				<tr>
					<td><ul><li>Bentuk Stand</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>proses SIB/ IPS*</td>
				</tr>
				<tr>
					<td><ul><li>Jenis Jualan</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>proses SIJ</td>
				</tr>
				<tr>
					<td><ul><li>Luas</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>Penambahan Luas / IT</td>
				</tr>
				<tr>
					<td><ul><li>Listrik</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>Proses Pasang Baru</td>
				</tr>
				<tr>
					<td><ul><li>Air</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>Proses Pasang Baru</td>
				</tr>
				<tr>
					<td><ul><li>Buku</li></ul></td>
					<td>:</td>
					<td>Tidak/ Terjadi perubahan*</td>
					<td>Tindak lanjut :</td>
					<td>Ganti Buku / BHPTU</td>
				</tr>
			</table>
		</div><br>
		<div class="row">Demikian Berita Acara ini dibuat dan ditandatangani dengan sebenar-benarnya. Apabila dikemudian hari ternyata keterangan yang dibuat ini tidak benar, maka kami bersedia menerima sanksi sesuai peraturan yang berlaku.</div><br>
		<div class="row">
			<table style="width: 100%;">
				<tr>
					<td style="width: 50%; text-align: center;">Pemohon/ Pedagang</td>
					<td>Pemeriksa : </td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td>1. _________________</td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;&nbsp;&nbsp;Kasie Tapas Cabang</td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td>2. _________________</td>
				</tr>
				<tr>
					<td style="text-align: center;">{{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</td>
					<td>&nbsp;&nbsp;&nbsp;Kaur Umum Pasar</td>
				</tr>
			</table>
		</div>
		<br><br>
		<div class="row">
			<table style="width: 100%;" class="bordered">
				<tbody>
					<tr>
						<td colspan="2" style="text-align: center;">Mengetahui</td>
					</tr>
					<tr>
						<td style="text-align: center;">
							Kepala Cabang {{ title_case(auth()->user()->pasar->cabang->nama) }}
							<br><br><br><br>
							{{ auth()->user()->pasar->cabang->kepala->name }}
						</td>
						<td style="text-align: center;">
							Kepala Unit Pasar {{ title_case(auth()->user()->pasar->nama) }}<br><br><br><br>
							{{ auth()->user()->name }}
						</td>
					</tr>
					<tr>
						<td>Tgl.</td>
						<td>Tgl.</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br><br><br>
		<div class="row" style="font-size: 11px; font-family: arial;">
			*) CORET YANG TIDAK PERLU
		</div>
	</div>
</body>
</html>
