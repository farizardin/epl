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
            margin: 20px;
			font-size: .8rem;
        }

		td {
			vertical-align: top;
		}

		.td {
			border: 1px solid black;
		}

		.container {
			width: 100%;
		}

		.logo img {
			width: 130px;
		}

		input {
			height: 17px;
		}

		.separator {
            border-top: 1px dotted;
            margin-top: 10px;
        }
	</style>
</head>
<body>

	<section>
		<div class="container">
			<table style="width: 100%">
				<tbody>
					<tr>
						<td style="width: 30%;">Surabaya, {{ $tgl }}</td>
						<td style="width: 40%">Telah mengajukan permohonan perpasaran:</td>
						<td rowspan="4">
							<table>
								<tbody>
									<tr>
										<td><h1 style="margin:0">TANDA TERIMA</h1></td>
									</tr>
									<tr>
										<td style="border:1px solid black; text-align:center; padding: 3px"><b>UNTUK PEDAGANG</b></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td class="logo" rowspan="4"><img src="{{ asset('img/logo.png') }}"></td>
						<td>Proses : {{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
					</tr>
					<tr>
						<td>Dengan data sebagai berikut :</td>
					</tr>
					<tr>
						<td colspan="2">
							<table style="width:100%">
								<tbody>
									<tr>
										<td height="20" style="width: 20%">NAMA</td>
										<td style="width: 5%">:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? strtoupper($detail_bn->nama_baru) : strtoupper($transaksi->nama) }}</td>
									</tr>
									<tr>
										<td height="20">ALAMAT</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? strtoupper($detail_bn->alamat_baru) : strtoupper($transaksi->alamat) }}</td>
									</tr>
									<tr>
										<td height="20">NO. TELP</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? $detail_bn->telp_baru : $transaksi->telp }}</td>
									</tr>
									<tr>
										<td height="20">NO. STAND</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $transaksi->stand->no_stand }}</td>
									</tr>
									<tr>
										<td height="20">UNIT PASAR</td>
										<td>:</td>
										<td style="border-bottom: .5px solid black">{{ $transaksi->stand->pasar->nama }}</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
	
			<table style="width: 100%">
				<tbody>
					<tr>
						<td style="width:65%"><b>Persyaratan</b></td>
						<td style="text-align: center;">Petugas</td>
					</tr>
					<tr>
						<td>
							<table style="width: 100%; font-size: .8rem">
								<tbody>
									<tr>
										<td><input type="checkbox" > FC. KTP</td>
										<td><input type="checkbox" > Buku Stan</td>
										<td rowspan="2"><label><input type="checkbox" > Surat kuasa penunjukan <br> salah satu ahli waris</label></td>
									</tr>
									<tr>
										<td><input type="checkbox" > FC. Kartu Keluarga</td>
										<td><input type="checkbox" > Kartu Stan</td>
									</tr>
									<tr>
										<td><input type="checkbox" > Foto Warna</td>
										<td rowspan="2"><input type="checkbox" > Surat keterangan kematian/ <br> Akta kematian</td>
										<td rowspan="2"><input type="checkbox" > Surat waris legalisir <br> kelurahan</td>
									</tr>
									<tr>
										<td><input type="checkbox" > Surat pernyataan</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="text-align: center; vertical-align: bottom">{{ Auth::user()->name }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator"></div>

	<section style="padding-top: 10px">
		<div class="container">
			<table style="width: 100%">
				<tbody>
					<tr>
						<td style="width: 30%;">Surabaya, {{ $tgl }}</td>
						<td style="width: 40%">Telah mengajukan permohonan perpasaran:</td>
						<td rowspan="4">
							<table>
								<tbody>
									<tr>
										<td><h1 style="margin:0">TANDA TERIMA</h1></td>
									</tr>
									<tr>
										<td style="border:1px solid black; text-align:center; padding: 3px"><b>UNTUK UNIT PASAR</b></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td class="logo" rowspan="4"><img src="{{ asset('img/logo.png') }}"></td>
						<td>Proses : {{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
					</tr>
					<tr>
						<td>Dengan data sebagai berikut :</td>
					</tr>
					<tr>
						<td colspan="2">
							<table style="width:100%">
								<tbody>
									<tr>
										<td height="20" style="width: 20%">NAMA</td>
										<td style="width: 5%">:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? strtoupper($detail_bn->nama_baru) : strtoupper($transaksi->nama) }}</td>
									</tr>
									<tr>
										<td height="20">ALAMAT</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? strtoupper($detail_bn->alamat_baru) : strtoupper($transaksi->alamat) }}</td>
									</tr>
									<tr>
										<td height="20">NO. TELP</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? $detail_bn->telp_baru : $transaksi->telp }}</td>
									</tr>
									<tr>
										<td height="20">NO. STAND</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $transaksi->stand->no_stand }}</td>
									</tr>
									<tr>
										<td height="20">UNIT PASAR</td>
										<td>:</td>
										<td style="border-bottom: .5px solid black">{{ $transaksi->stand->pasar->nama }}</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
	
			<table style="width: 100%">
				<tbody>
					<tr>
						<td style="width:65%"><b>Persyaratan</b></td>
						<td style="text-align: center;">Petugas</td>
					</tr>
					<tr>
						<td>
							<table style="width: 100%; font-size: .8rem">
								<tbody>
									<tr>
										<td><input type="checkbox" > FC. KTP</td>
										<td><input type="checkbox" > Buku Stan</td>
										<td rowspan="2"><label><input type="checkbox" > Surat kuasa penunjukan <br> salah satu ahli waris</label></td>
									</tr>
									<tr>
										<td><input type="checkbox" > FC. Kartu Keluarga</td>
										<td><input type="checkbox" > Kartu Stan</td>
									</tr>
									<tr>
										<td><input type="checkbox" > Foto Warna</td>
										<td rowspan="2"><input type="checkbox" > Surat keterangan kematian/ <br> Akta kematian</td>
										<td rowspan="2"><input type="checkbox" > Surat waris legalisir <br> kelurahan</td>
									</tr>
									<tr>
										<td><input type="checkbox" > Surat pernyataan</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="text-align: center; vertical-align: bottom">{{ Auth::user()->name }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator"></div>

	<section style="padding-top: 10px">
		<div class="container">
			<table style="width: 100%">
				<tbody>
					<tr>
						<td style="width: 30%;">Surabaya, {{ $tgl }}</td>
						<td style="width: 40%">Telah mengajukan permohonan perpasaran:</td>
						<td rowspan="4">
							<table>
								<tbody>
									<tr>
										<td><h1 style="margin:0">TANDA TERIMA</h1></td>
									</tr>
									<tr>
										<td style="border:1px solid black; text-align:center; padding: 3px"><b>UNTUK PROSES</b></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td class="logo" rowspan="4"><img src="{{ asset('img/logo.png') }}"></td>
						<td>Proses : {{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
					</tr>
					<tr>
						<td>Dengan data sebagai berikut :</td>
					</tr>
					<tr>
						<td colspan="2">
							<table style="width:100%">
								<tbody>
									<tr>
										<td height="20" style="width: 20%">NAMA</td>
										<td style="width: 5%">:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? strtoupper($detail_bn->nama_baru) : strtoupper($transaksi->nama) }}</td>
									</tr>
									<tr>
										<td height="20">ALAMAT</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? strtoupper($detail_bn->alamat_baru) : strtoupper($transaksi->alamat) }}</td>
									</tr>
									<tr>
										<td height="20">NO. TELP</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $detail_bn ? $detail_bn->telp_baru : $transaksi->telp }}</td>
									</tr>
									<tr>
										<td height="20">NO. STAND</td>
										<td>:</td>
										<td style="border-bottom: 1px solid black">{{ $transaksi->stand->no_stand }}</td>
									</tr>
									<tr>
										<td height="20">UNIT PASAR</td>
										<td>:</td>
										<td style="border-bottom: .5px solid black">{{ $transaksi->stand->pasar->nama }}</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
	
			<table style="width: 100%">
				<tbody>
					<tr>
						<td style="width:65%"><b>Persyaratan</b></td>
						<td style="text-align: center;">Petugas</td>
					</tr>
					<tr>
						<td>
							<table style="width: 100%; font-size: .8rem">
								<tbody>
									<tr>
										<td><input type="checkbox" > FC. KTP</td>
										<td><input type="checkbox" > Buku Stan</td>
										<td rowspan="2"><label><input type="checkbox" > Surat kuasa penunjukan <br> salah satu ahli waris</label></td>
									</tr>
									<tr>
										<td><input type="checkbox" > FC. Kartu Keluarga</td>
										<td><input type="checkbox" > Kartu Stan</td>
									</tr>
									<tr>
										<td><input type="checkbox" > Foto Warna</td>
										<td rowspan="2"><input type="checkbox" > Surat keterangan kematian/ <br> Akta kematian</td>
										<td rowspan="2"><input type="checkbox" > Surat waris legalisir <br> kelurahan</td>
									</tr>
									<tr>
										<td><input type="checkbox" > Surat pernyataan</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="text-align: center; vertical-align: bottom">{{ Auth::user()->name }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

</body>
</html>
