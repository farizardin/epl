<table>
    <thead>
    <tr>
        @if(in_array(1, $option))<th>Nama Pasar</th>@endif
        @if(in_array(2, $option))<th>Alamat Pasar</th>@endif
        @if(in_array(3, $option))<th>Cabang</th>@endif
        @if(in_array(4, $option))<th>Kelas Pasar</th>@endif
        @if(in_array(5, $option))<th>No. Stand</th>@endif
        @if(in_array(6, $option))<th>No. Reg</th>@endif
        @if(in_array(7, $option))<th>No. Rekening</th>@endif
        @if(in_array(8, $option))<th>Bentuk Stand</th>@endif
        @if(in_array(9, $option))<th>Lantai</th>@endif
        @if(in_array(10, $option))<th>Jenis Jualan</th>@endif
        @if(in_array(11, $option))<th>Kelompok Jualan</th>@endif
        @if(in_array(12, $option))<th>Panjang</th>@endif
        @if(in_array(13, $option))<th>Lebar</th>@endif
        @if(in_array(14, $option))<th>Luas</th>@endif
        @if(in_array(15, $option))<th>Daya Listrik</th>@endif
        @if(in_array(16, $option))<th>Air</th>@endif
        @if(in_array(17, $option))<th>Status Stand</th>@endif
        @if(in_array(18, $option))<th>Keterangan Stand</th>@endif
        @if(in_array(19, $option))<th>NIK</th>@endif
        @if(in_array(20, $option))<th>Nama</th>@endif
        @if(in_array(21, $option))<th>Alamat</th>@endif
        @if(in_array(22, $option))<th>Kota</th>@endif
        @if(in_array(23, $option))<th>Telp</th>@endif
        @if(in_array(24, $option))<th>Tgl. Lahir</th>@endif
        @if(in_array(28, $option))<th>No. Buku</th>@endif
        @if(in_array(29, $option))<th>Masa Berlaku Buku</th>@endif
        @if(in_array(25, $option))<th>Proses</th>@endif
        @if(in_array(26, $option))<th>Biaya</th>@endif
        @if(in_array(27, $option))<th>Keterangan Proses</th>@endif
    </tr>
    </thead>
    <tbody>
    @foreach ($transaksi as $t)
        <tr>
            @if(in_array(1, $option))<td>{{ $t->stand->pasar->nama }}</td>@endif
            @if(in_array(2, $option))<td>{{ $t->stand->pasar->alamat }}</td>@endif
            @if(in_array(3, $option))<td>{{ $t->stand->pasar->cabang->nama }}</td>@endif
            @if(in_array(4, $option))<td>{{ $t->stand->pasar->kelas->nama }}</td>@endif
            @if(in_array(5, $option))<td>{{ $t->stand->no_stand }}</td>@endif
            @if(in_array(6, $option))<td>{{ $t->stand->no_reg }}</td>@endif
            @if(in_array(7, $option))<td>{{ $t->stand->no_rek }}</td>@endif
            @if(in_array(8, $option))<td>{{ $t->stand->bentuk_stand->nama }}</td>@endif
            @if(in_array(9, $option))<td>{{ $t->stand->lantai ? $t->stand->lantai->nama : '-' }}</td>@endif
            @if(in_array(10, $option))<td>{{ $t->stand->jenis_jualan->nama }}</td>@endif
            @if(in_array(11, $option))<td>{{ $t->stand->jenis_jualan->kelompok_jualan->nama }}</td>@endif
            @if(in_array(12, $option))<td>{{ $t->stand->panjang }} m</td>@endif
            @if(in_array(13, $option))<td>{{ $t->stand->lebar }} m</td>@endif
            @if(in_array(14, $option))<td>{{ $t->stand->luas }} m<sup>2</sup></td>@endif
            @if(in_array(15, $option))<td>{{ $t->stand->daya_listrik ? $t->stand->daya_listrik->nama : '-' }}</td>@endif
            @if(in_array(16, $option))<td>{{ $t->stand->air ? 'ADA' : 'TIDAK ADA' }}</td>@endif
            @if(in_array(17, $option))<td>{{ $t->stand->status }}</td>@endif
            @if(in_array(18, $option))<td>{{ $t->stand->keterangan }}</td>@endif
            @if(in_array(19, $option))<td>{{ $t->nik }}</td>@endif
            @if(in_array(20, $option))<td>{{ $t->nama }}</td>@endif
            @if(in_array(21, $option))<td>{{ $t->alamat }}</td>@endif
            @if(in_array(22, $option))<td>{{ $t->kota }}</td>@endif
            @if(in_array(23, $option))<td>{{ $t->telp }}</td>@endif
            @if(in_array(24, $option))<th>{{ $t->tgl_lahir }}</th>@endif
            @if(in_array(28, $option))<th>{{ $t->stand->bhptu ? $t->stand->bhptu->nomor : '-' }}</th>@endif
            @if(in_array(29, $option))<th>{{ $t->stand->bhptu ? $t->stand->bhptu->tgl_berlaku->format('d/m/Y') : '-' }}</th>@endif
            @if(in_array(25, $option))<th>{{ implode(', ', $t->proses->pluck('jenis_proses.nama')->toArray()) }}</th>@endif
            @if(in_array(26, $option))<th>{{ $t->biaya }}</th>@endif
            @if(in_array(27, $option))<th>{{ $t->keterangan }}</th>@endif
        </tr>
    @endforeach
    </tbody>
</table>