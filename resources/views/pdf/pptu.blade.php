<!DOCTYPE html>
<html>
<head>
	<title>PPTU - {{ @$transaksi->pptu->nomor }}</title>
	<style type="text/css">
		#bott {
			border-bottom: 2px black double;
		}

		td {
			vertical-align: top;
		}

		.justify {
			text-align: justify;
		}

		.center {
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container" style="padding: 0 24px; font-size: 15px; text-align: justify;">
		<div class="row" style="text-align: right;">
			<img src="{{ asset('img/logo.png') }}" style="width: 2cm;">
		</div>
		<div class="row" style="text-align: center;">
			<p><h3>PERJANJIAN PEMAKAI TEMPAT USAHA<br>
			DI UNIT PASAR {{ strtoupper($transaksi->stand->pasar->nama) }} <br>NOMOR : {{ @$transaksi->pptu->nomor }}<br></h3></p>
		</div>
		<div class="row" id="bott"></div>
		<div class="row justify">
			<p>Pada hari ini {{ $hari }} tanggal {{ $tgl }} bulan {{ $bulan }} tahun {{ $tahun }} ({{ $tanggal }}), yang bertanda tangan dibawah ini :</p>
		</div>
		<div class="row">
			<table style="width: 100%;"> 
				<tr>
					<td width="40%"><b>{{ App\User::getDirektur() }}</b></td> 
					<td width="2%">:</td> 
					<td class="justify">Direktur Teknik, berdasarkan SK Walikota Surabaya Nomor 188.45/54/436.1.2/2014 tanggal 1 April 2014 bertindak untuk dan atas nama PD Pasar Surya berkedudukan di Jalan Manyar Kertoarjo V/2 Surabaya. Selanjutnya disebut <b>PIHAK PERTAMA.</b></td>
				</tr>
				<tr>
					<td><b>{{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</b></td>
					<td>:</td>
					<td class="justify">Bertindak untuk dan atas nama sendiri, alamat {{ $detail_bn ? $detail_bn->alamat_baru : $transaksi->alamat }}, selaku Pemakai Tempat Usaha Unit Pasar Keputran Utara, selanjutnya disebut sebagai <b>PIHAK KEDUA</b></td>
				</tr>
			</table>
		</div>
		<div class="row">
			<p><b>PIHAK KEDUA</b> sepakat untuk memakai tempat usaha berupa stand milik dan di bawah pengelolaan <b>PIHAK PERTAMA</b> di Pasar {{ $transaksi->stand->pasar->nama }}  No. tempat usaha {{ $transaksi->stand->no_stand }} / Lt. {{ $transaksi->stand->lantai->nama }} Luas {{ $transaksi->stand->luas }}  m<sup>2</sup> dengan ketentuan-ketentuan dan syarat-syarat tersebut di bawah ini :<br><br>
			Berdasarkan hal-hal tersebut di atas, maka <b>PARA PIHAK</b> menyatakan sepakat dan setuju untuk mengadakan Perjanjian Pemakai Tempat Usaha (untuk selanjutnya disebut Perjanjian) dengan syarat-syarat dan ketentuan-ketentuan sebagai berikut :</p>
		</div><br>
		<div class="row center"><b>PASAL 1</b></div>
		<div class="row justify">
			<p><b>PARA PIHAK</b> sepakat jangka waktu Pemakaian Tempat Usaha berupa stand sampai dengan tanggal {{ $transaksi->pptu ? App\Helper::tgl_indo($transaksi->pptu->tgl_berlaku->format('Y-m-d')) : '' }}.</p>
		</div>
		<div class="row center"><b>PASAL 2</b></div>
		<div class="row justify">
			<p><b>PIHAK KEDUA</b> berjanji akan menggunakan tempat usaha dengan sebaik-baiknya memelihara kebersihan, keamanan, kerapian, menggunakan aliran listrik, air dan fasilitas yang tersedia serta memenuhi kewajiban syarat-syarat pembayaran atas pemakaian tempat usaha dan atas penggunaan fasilitas yang ditentukan oleh <b>PIHAK PERTAMA</b>.</p>
		</div>
		<div class="row center"><b>PASAL 3</b></div>
		<div class="row justify">
			<p><b>PIHAK KEDUA</b> berjanji tidak akan mengubah / menambah / mengurangi bentuk bangunan tempat usaha berupa stand serta kelengkapan lain yang telah ada dan / atau ditetapkan oleh <b>PIHAK PERTAMA</b>, kecuali telah mendapatkan persetujuan tertulis dari pejabat yang berwenang pada <b>PIHAK PERTAMA</b>.</p>
		</div>
		<div class="row center"><b>PASAL 4</b></div>
		<div class="row justify">
			<p><b>PIHAK KEDUA</b> berjanji tidak akan mengalihkan, menyewakan, mewariskan, menghibahkan, menggadaikan (menjaminkan), menguasakan atau memindah tangankan segala hak pemakaian maupun bangunan fisik tempat usaha berupa stand kepada <b>PIHAK KETIGA</b> tanpa persetujuan <b>PIHAK PERTAMA</b></p>
		</div>
		<div class="row center"><br><br><b>PASAL 5</b></div>
		<div class="row justify">
			<p><b>PIHAK KEDUA</b> berjanji tidak akan menelantarkan & mempergunakan tempat usaha berupa stand sebagai tempat tinggal atau rumah tangga atau gudang yang tidak diperlukan untuk mendukung kegiatan berusaha.</p>
		</div>
		<div class="row center"><b>PASAL 6</b></div>
		<div class="row justify">
			<p>Apabila ternyata segala ketentuan yang tercantum dalam pasal 2 sampai dengan 5 perjanjian ini tidak dilaksanakan oleh <b>PIHAK KEDUA</b>, maka <b>PIHAK PERTAMA</b> berhak secara sepihak memutuskan perjanjian ini dan mencabut segala hak terkait pemakaian tempat usaha, tanpa adanya suatu tuntutan apapun dari <b>PIHAK KEDUA</b> dan Pihak Manapun, serta <b>PIHAK PERTAMA</b> berhak untuk mengadakan Perjanjian dan menyerahkan Hak Pemakaian Tempat Usaha berupa stand kepada Pihak lain.</p>
		</div>
		<div class="row center"><b>PASAL 7</b></div>
		<div class="row justify">
			<p>Pada akhir masa perjanjian dan jangka waktu pemakaian <b>PIHAK KEDUA</b> wajib menyerahkan tempat usaha berupa stand kepada <b>PIHAK PERTAMA</b>. Jika pada akhir masa pemakaian <b>PIHAK KEDUA</b> bermaksud melakukan perpanjangan maka wajib mengajukan kepada <b>PIHAK PERTAMA</b></p>
		</div>
		<div class="row center"><b>PASAL 8</b></div>
		<div class="row justify">
			<p>Perpanjangan dapat dilakukan dengan syarat memenuhi persetujuan <b>PIHAK PERTAMA</b> dan ketentuan-ketentuan yang ditetapkan. Apabila tidak dilakukan perpanjangan atau perpanjangan tidak disetujui, maka <b>PIHAK KEDUA</b> wajib menyerahkan tempat usaha berupa stand kepada <b>PIHAK PERTAMA</b> sesuai dengan kondisi semula.</p>
		</div>
		<div class="row center"><b>PASAL 9</b></div>
		<div class="row justify">
			<p><b>PIHAK KEDUA</b> bersedia memenuhi isi dalam perjanjian ini dan segala ketentuan atau peraturan serta sanksi yang dikeluarkan oleh <b>PIHAK PERTAMA</b> sebelum atau sesudah perjanjian ini ditandatangani.</p>
		</div>
		<div class="row center"><b>PASAL 10</b></div>
		<div class="row justify">
			<p>Mengenai perjanjian ini dengan segala akibat hukumnya para pihak menyatakan memilih tempat kedudukan hukum yang tidak dapat dipindahkan yaitu di Kantor Kepaniteraan Pengadilan Negeri Surabaya</p>
		</div>
		<div class="row center"><b>PASAL 11</b></div>
		<div class="row justify">
			<p>1.&nbsp;&nbsp;&nbsp;Perjanjian ini dibuat dan ditanda-tangani oleh <b>PARA PIHAK</b> pada tanggal sebagaimana disebutkan pada awal Perjanjian ini oleh kedua belah pihak atu para wakilnya yang ditunjuk dan atas nama masing-masing pihak.<br>
			2.&nbsp;&nbsp;&nbsp;Perjanjian ini dibuat dalam rangkap 2 (dua), masing-masing bermaterai cukup dan keduanya mempunyai kekuatan hukum yang sama. Rangkap pertama dipegang oleh <b>PIHAK PERTAMA</b> dan rangkap kedua dipegang oleh <b>PIHAK KEDUA</b>, telah dibaca dan dipahami isinya oleh <b>PARA PIHAK</b>.</p>
		</div><br><br>
		<div class="row">
			<table style="width: 100%; text-align: center;">
				<tr>
					<td style="width: 50%;"><b>PIHAK PERTAMA</b></td>
					<td><b>PIHAK KEDUA</b></td>
				</tr>
			</table>
		</div><br><br><br><br>
		<div class="row">
			<table style="width: 100%; text-align: center;">
				<tr>
					<td width="50%"><b>{{ App\User::getDirektur() }}</b></td>
					<td width="50%"><b>{{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</b></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
