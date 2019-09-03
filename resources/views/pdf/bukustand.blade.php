<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#border-tbl,#border-tbl th,#border-tbl td {
    		border: 1px solid black;
    		border-collapse: collapse;
		}
		#p1 {
			text-align: justify;
			font-size: 11px;
		}
		#p2 tr td {
			width: 20%;
		}
		#tb2 td, #tb2 th{
			padding: 0.6%;
			font-size: 11px;
		}
		#t2 tr td, #trd td{
			font-size: 12px;
		}
		.tabbing tr td{
			vertical-align: top;
			text-align: justify;
			font-size: 11px;
		}
	</style>
</head>
<body>
	<div class="container" style="width:100%;">
		<div class="row">
			<table class="border-tbl" style="width:100%;padding-left: 20px;margin-left: 20px;"><tbody>
				<tr style="width: 100%">
					<td style="text-align: left;">7</td>
					<td style="text-align: right;"></td>
				</tr>
				<tr>
					<th style="width: 50%; text-align: left;"><u>PERHATIAN !!!</u></th>
				</tr>
			</tbody></table>
			<table class="border-tbl" style="width:100%;padding-left: 20px;margin-left: 20px;"><tbody>
				<tr>
					<td style="width: 50%; padding: 1%;">
						<table style="font-size: 11px;width: 100%;" class="tabbing">
							<tbody>
								<tr>
									<td>a.</td>
									<td>Buku Stand ini bukan merupakan bukti Hak Kepemilikan tetapi bukti Pemakaian Stand.</td>
								</tr>
								<tr>
									<td>b.</td>
									<td>Buku Stand ini tidak dapat dijaminkan, dialihkan, diwariskan dan atau diperjual belikan kepada pihak lain, sebelum mendapat persetujuan tertulis dari PD Pasar Surya</td>
								</tr>
								<tr>
									<td>c.</td>
									<td>Buku Stand ini berisi 7 halaman, mulai dari halaman 1 sampai dengan halaman 7.</td>
								</tr>
								<tr>
									<td>d.</td>
									<td>Kerusakan/kehilangan atas Buku Stand ini wajib segera melaporkan kepada instansi berwenang (kepolisian) dalam waktu selambat-lambatnya 7 (tujuh) hari dan selanjutnya dilaporkan kepada Kepala Unit Pasar untuk diproses pembuatan Buku Stand baru.</td>
								</tr>
								<tr>
									<td>e.</td>
									<td>Dengan diterbitkannya Buku Stand ini maka semua bukti berkaitan dengan  pemakaian  Tempat Usaha berupa stand yang telah diterbitkan sebelumnya dinyatakan tidak berlaku lagi.</td>
								</tr>
								<tr>
									<td>f.</td>
									<td>Buku ini merupakan bagian yang tidak terpisahkan dari  Kartu Stand dan Perjanjian Pemakaian Tempat Usaha(salinan Perjanjian Pemakaian Tempat Usaha menjadi arsip PD Pasar Surya.</td>
								</tr>
								<tr>
									<td>g.</td>
									<td>Pemegang Buku Stand Wajib Mentaati Semua Peraturan dan Ketentuan yang berlaku di PD. Pasar Surya</td>
								</tr>
							</tbody>
						</table>
						<table id="t2" style="width:100%;"><tbody>
							<tr>
								<td>Hal. 1</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Keterangan Stand</td>
							</tr>
							<tr>
								<td>Hal. 2,3,4</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Ketentuan hak Pemakaian Tempat Usaha</td>
							</tr>
							<tr>
								<td>Hal. 5</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Keterangan Pemakai Stand</td>
							</tr>
							<tr>
								<td>Hal. 6</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Pendaftaran Peralihan, Pembebanan dan</td>
							</tr>
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pencatatan Lainnya</td>
							</tr>
							<tr>
								<td>Hal. 7</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Perhatian & Keterangan Halaman</td>
							</tr>
							<tr>
								<td>Hal. 1</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Keterangan Stand</td>
							</tr>
						</tbody></table>
					</td>
					<td  style="width:50%">
						<p class="logo" style="text-align: center; horizontal-align:center;margin-left:20%;"><img style="width:150px;" src="{{ asset('img/logo.png') }}" alt="logo"></p>
						<br><br><br><br><br><br><br>
						<p style="width: 100%;text-align: center; padding-left: 46px;font-size: 25px; vertical-align: bottom; margin-left:10px"><b>BUKU HAK<br>PEMAKAIAN TEMPAT<br>USAHA</b></p>
					</td>
				</tr>
			</tbody></table>
		</div>
		<div class="row">
			<table style="width: 100%;padding-left: 20px;margin-left: 60px;">
				<tbody>
				<tr style="width: 100%">
					<td style="text-align: left;">1</td>
					<td style="text-align: right;">6</td>
				</tr>
				<tr>
					<td style="width: 50%; padding: 1%;">
						<table id="t2"><tbody>
							<tr style="text-align: center;">
								<td colspan="2"><h3>KETERANGAN STAND</h3></td>
							</tr>
							<tr>
								<td>1. Nomor Stand</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->no_stand }}</td>
							</tr>
							<tr>
								<td>2. Bentuk Stand</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->bentuk_stand->nama}}</td>
							</tr>
							<tr>
								<td>3. Pasar</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->pasar->nama }}</td>
							</tr>
							<tr>
								<td>4. Jenis Jualan / Usaha</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->jenis_jualan->nama }}</td>
							</tr>
							<tr>
								<td>5. No. Register Induk</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->no_reg }}</td>
							</tr>
							<tr>
								<td>6. Luas Stand</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->luas }} m<sup>2</sup></td>
							</tr>
							<tr>
								<td>7. Air</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->air ? 'ADA' : 'TIDAK ADA'}}</td>
							</tr>
							<tr>
								<td>8. Daya Listrik</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->daya_listrik ? $transaksi->stand->daya_listrik->nama : '-' }} Watt</td>
							</tr>
							<tr>
								<td>9. Telpon</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->pedagang->telp ? $transaksi->stand->pedagang->telp : '-'}}</td>
							</tr>
							<tr>
								<td>10. Masa Berlaku  s /d</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ @$transaksi->stand->bhptu->tgl_berlaku->format('d/m/Y') }}</td>
							</tr>
						</tbody></table>
					</td>
					<td style="width: 50%;">
						<table style="width:100%;margin-left: 10px;margin: 2px;" id="border-tbl">
							<tbody>
							<tr style="text-align: center; font-size: 15px;">
								<td colspan="4"><h3>Pendaftaran Peralihan, Pembebanan dan Pencatatan Lainnya</h3></td>
							</tr>
							<tr style="font-size: 12px; text-align: center;">
						    	<td style="width:20%;">Sebab Perubahan</td>
						    	<td style="width:20%;">Tanggal Proses</td> 
							    <td style="width:20%;">Nama Pemakai Stand</td>
							    <td style="width: 30%;">Tanda tangan<br>Direktur PD Pasar<br>Surya & Cap Kantor</td>
							</tr>
							<tr>
								<td style="font-size:11px;vertical-align: top;">
									{{ implode(', ', $transaksi->proses->pluck('jenis_proses.nama_lengkap')->toArray()) }}
								</td>
							    <td style="font-size:11px;vertical-align: top;">
									Tgl Permohonan:<br>
									{{ $transaksi->tgl_permohonan->format('d/m/Y') }}<br><br><br>
									Acc DPP:<br>
									{{ $transaksi->tgl_acc->format('d/m/Y') }}<br><br><br>
									Ttd Perjanjian:<br>
									{{ $transaksi->tgl_penetapan->format('d/m/Y') }}
							    </td>
							    <td style="font-size:11px;vertical-align: top;">
									Pemakai ke-1:<br>
									{{ $detail_bn ? $detail_bn->nama_lama : $transaksi->stand->pedagang->nama }}<br><br><br>
									Sejak Tgl.:<br>
									<br><br><br>
									Pemakai ke-2:<br>
									{{ $detail_bn ? $detail_bn->nama_baru : '' }}
									<br><br><br>
									Sejak Tgl.:<br>
							    </td>
							    <td style="font-size:11px;">
							    	<br><br><br><br><br><br><br><br><br><br><br>Surabaya,<br><br>
							    	<p style="text-align: center;">Direktur Teknik<br>dan Usaha<br><br><br><br><br>ZANDI FERRYANSA, SH.</p>
							    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</div>
		<div class="row">
			<table style="width: 100%; margin-left: 30px; ">
				<tbody>
				<tr style="width: 100%;">
					<td style="text-align: left;">5</td>
					<td style="text-align: right;">2</td>
				</tr>
				<tr style="font-size:10px;">
					<td style="width: 50%;padding: 15px;" id="t2">
						<table><tbody>
							<tr style="text-align: center;">
								<td colspan="3"><h3>KETERANGAN<br>PEMAKAI STAND</h3></td>
							</tr>
							<tr>
								<td style="width:30%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style="width:10%;">Nama</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->pedagang->nama }}</td>
							</tr>
							<tr>
								<td></td>
								<td>Umur</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ @$transaksi->stand->pedagang->tgl_lahir->diffInYears(\Carbon\Carbon::now()) }}</td>
							</tr>
							<tr>
								<td></td>
								<td>Alamat</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->pedagang->alamat }}</td>
							</tr>
							<tr>
								<td></td>
								<td>No. KTP</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transaksi->stand->pedagang->nik }}</td>
							</tr>
							<tr style="text-align: left;">
								<td colspan="3"><br>Disahkan / disetujui sebagai Pihak Kedua dalam perjanjian dan pemakai tempat usaha berupa stand.</td>
							</tr>
							<tr>
								<td></td>
								<td><br>Surabaya,</td>
								<td></td>
							</tr>
							<tr style="text-align: center;">
								<td></td>
								<td colspan="2">An. Direksi Perusahaan Daerah Pasar Surya<br>Kota Surabaya<br>DIREKTUR TEKNIK DAN USAHA</td>
							</tr>
							<tr style="text-align: center;">
								<td></td>
								<td colspan="2"><br><br><br><br><br><br>ZANDI FERRYANSA, SH.</td>
							</tr>
						</tbody></table>
					</td>
					<td style="width:50%;">
						<table class="tabbing" style="font-size: 11px; margin-left: 30px; text-align: justify;">
							<tbody>
							<tr>
								<td colspan="2" style="text-align: center;"><h3>KETENTUAN  HAK PAKAI<br>TEMPAT USAHA</h3></td>
							</tr>
							<tr>
						    	<td colspan="2">Sebagaimana tertuang dalam ketentuan Peraturan Direksi PD Pasar Surya, dijelaskan tentang Hak dan Kewajiban PARA PIHAK.</td>
							</tr>
							<tr>
						    	<td colspan="2"><b>a. HAK PD Pasar  Surya adalah :</b></td>
							</tr>
						</tbody></table>
						<table class="tabbing" style="font-size: 11px; margin-left: 30px; text-align: justify;">
							<tbody>
							<tr>
								<td>1.</td>
								<td>Bertanggung jawab dan mengelola unit-unit pasar yang berada di bawah jajaran PD Pasar Surya berdasarkan Peraturan Daerah Kota  Surabaya Nomor  6 Tahun 2008.</td>
							</tr>
							<tr>
								<td>2.</td>
								<td>Menetapkan jenis besaran biaya terkait pemakaian tempat usaha  berdasarkan Peraturan Direksi PD Pasar.</td>
							</tr>
							<tr>
								<td>3.</td>
								<td>Melakukan perubahan tata ruang dan desain peruntukan tempat  usaha dalam area pasar.</td>
							</tr>
							<tr>
								<td>4.</td>
								<td>Melakukan perombakan, penambahan dan/atau perubahan bentuk tempat usaha.</td>
							</tr>
							<tr>
								<td>5.</td>
								<td>Melakukan perluasan dan/atau perubahan peruntukan tempat usaha dalam area pasar.</td>
							</tr>
							<tr>
								<td colspan="2"><b>b. KEWAJIBAN PD pasar Surya adalah :</b></td>
							</tr>
							<tr>
								<td></td>
								<td>Menyediakan pelayanan yang baik kepada pemakai tempat usaha sesuai dengan peraturan yang berlaku. </td>
							</tr>
							<tr>
								<td colspan="2"><b>c. HAK Pemakai Tempat Usaha adalah :</b></td>
							</tr>
							<tr>
								<td></td>
								<td>Mendapat pelayanan yang baik terkait perolehan tempat usaha. </td>
							</tr>
							<tr>
						    	<td colspan="2"><b>d. KEWAJIBAN Pemakai Tempat Usaha adalah :</b></td>
							</tr>
							<tr>
								<td>1.</td>
								<td>Mempergunakan sendiri tempat usaha sesuai dengan izin yang Diberikan. </td>
							</tr>
							
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</div>
		<div class="row">
			<table style="width: 100%; margin-left: 40px;"><tbody>
				<tr style="width: 100%;">
					<td style="text-align: left;">3</td>
					<td style="text-align: right;">4</td>
				</tr>
				<tr style="font-size:11px;">
					<td style="width: 50%;padding: 5px;vertical-align: top;">
						<table class="tabbing" style="width: 100%;margin: 0px;font-size: 11px;text-align: justify;">
							<tbody>
								<tr>
									<td>2.</td>
									<td>Memfungsikan tempat usaha sesuai dengan jenis usaha dan ijin  yang diberikan.</td>
								</tr>
								<tr>
									<td>3.</td>
									<td>Memelihara ketertiban dan kebersihan tempat usaha.</td>
								</tr>
								<tr>
									<td>4.</td>
									<td>Menata barang dagangan beserta alat perlengkapannya dengan  teratur sehingga tidak mengganggu lalu lintas orang dan barang</td>
								</tr>
								<tr>
									<td>5.</td>
									<td>Membayar iuran layanan pasar, biaya listrik dan/ atau biaya air.  sesuai dengan waktu yang telah ditentukan oleh PD Pasar Surya</td>
								</tr>
								<tr>
									<td>6.</td>
									<td>Mencegah kemungkinan timbulnya bahaya kebakaran.</td>
								<tr>
									<td>7.</td>
									<td>Mematuhi waktu kegiatan pasar.</td>
								</tr>
								<tr>
									<td>8.</td>
									<td>Mematuhi segala ketentuan pemakaian tempat usaha yang  berlaku di PD. Pasar Surya.</td>
								</tr>
								<tr>
									<td>9.</td>
									<td>Mematuhi ketentuan-ketentuan perundang-undangan yang  Berlaku.  </td>
								</tr>
								<tr>
									<td colspan="2"><b><br>LARANGAN Pemakai Tempat Usaha adalah :</b> </td>
								</tr>
								<tr>
									<td>1.</td>
									<td>Bertempat tinggal atau menginap di tempat usaha di luar waktu  kegiatan pasar kecuali apabila Direksi menetapkan secara khusus atas fungsi pasar dimaksud sebagai ruko (rumah-toko).</td>
								</tr>
								<tr>
									<td>2.</td>
									<td>Menggunakan tempat usaha untuk usaha industri atau gudang</td>
								</tr>
								<tr>
									<td>3.</td>
									<td>Menggunakan tempat usaha diluar kegaitan perdagangan. termasuk tetapi tidak terbatas pada kegiatan politik, kampanye,  rapat-rapat dan lain sebagainya.</td>
								</tr>
								<tr>
									<td>4.</td>
									<td>Memperagakan barang-barang dagangannya diluar tempat usaha  yang dapat mengganggu ketertiban dan sirkulasi lalu  lintas  Pengunjung.</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="width:50%;margin-left: 20px;padding-left: 20px; ">
						<table class="tabbing" style="width: 100%;margin: 0px;font-size: 11px;text-align: justify;">
							<tbody>
								<tr>
									<td>5.</td>
									<td>Merubah jenis jualan yang sudah ditentukan berdasarkan room. programming yang berlaku, kecuali dengan persetujuan tertulis dari  Direksi dengan membayar biaya yang telah ditetapkan.</td>
								</tr>
								<tr>
									<td>6.</td>
									<td>Menjual atau menyimpan barang dagangan yang mudah terbakar,  antara lain : minyak tanah, bensin, pelumas dan sejenisnya. </td>
								<tr>
									<td>7.</td>
									<td>Menjual atau menyimpan barang-barang secara hukum dilarang  untuk diperjualbelikan. </td>
								</tr>
								<tr>
									<td>8.</td>
									<td>Membawa dan menyimpan kendaraan di lorong-lorong pasar. </td>
								</tr>
								<tr>
									<td>9.</td>
									<td>Menelantarkan tempat berjualan atau tempat usaha sehingga  mengganggu keramaian, ketertiban, dan pendataan pasar. </td>
								</tr>
								<tr>
									<td>10.</td>
									<td>Mengalihkan HPTU tanpa persetujuan Direksi.</td>
								</tr>
								<tr>
									<td>11.</td>
									<td>Merombak, menambah, merubah dan memperluas tempat  usahanya tanpa izin. </td>
								</tr>
								<tr>
									<td>12.</td>
									<td>Mengadakan penyambungan listrik, air, dan telepon tanpa izin. </td>
								</tr>
								<tr>
									<td>13.</td>
									<td>Melakukan praktek rentenir di dalam pasar. </td>
								</tr>
								<tr>
									<td>14.</td>
									<td>Melakukan perbuatan asusila di dalam pasar. </td>
								</tr>
								<tr>
									<td colspan="2"><b><br>2. Bagi Pemakai Tempat Usaha yang melakukan pelanggaran</b> </td>
								</tr>
								<tr>
									<td colspan="2">Sebagaimana ketentuan diatas, maka dikenakan sanksi berupa :</td>
								</tr>
								<tr>
									<td>a.</td>
									<td>Denda</td>
								</tr>
								<tr>
									<td>b.</td>
									<td>Penutupan sementara tempat usaha (penyegelan)</td>
								</tr>
								<tr>
									<td>c.</td>
									<td>Pemutusan aliran listrik dan/ atau air </td>
								</tr>
								<tr>
									<td>d.</td>
									<td>Pencabutan aliran listrik dan/ atau air  </td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody></table>
		</div>
	</div>
</body>
</html>
