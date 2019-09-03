<table>
    <thead>
        <tr>
            <th>No. Reg</th>
            <th>No. Rekening</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Telp</th>
            <th>Tgl. Lahir</th>
            <th>No. Stand</th>
            <th>Lantai</th>
            <th>Panjang</th>
            <th>Lebar</th>
            <th>Luas</th>
            <th>Jenis Jualan</th>
            <th>Bentuk Stand</th>
            <th>Daya Listrik</th>
            <th>Air</th>
            <th>No. Buku/PPTU</th>
            <th>Tgl. Berlaku</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Pasar</th>
            <th>Alamat Pasar</th>
            <th>Kelas Pasar</th>
            <th>Cabang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stands as $stand)
            <tr>
                <td>{{ $stand->no_reg }}</td>
                <td>{{ $stand->no_rekening }}</td>
                <td>{{ $stand->pedagang ? $stand->pedagang->nama : '-' }}</td>
                <td>{{ $stand->pedagang ? $stand->pedagang->nik : '-' }}</td>
                <td>{{ $stand->pedagang ? $stand->pedagang->alamat : '-' }}</td>
                <td>{{ $stand->pedagang ? $stand->pedagang->kota : '-' }}</td>
                <td>{{ $stand->pedagang ? $stand->pedagang->telp : '-' }}</td>
                <td>{{ $stand->pedagang ? $stand->pedagang->tgl_lahir ? $stand->pedagang->tgl_lahir->format('d/m/Y') : '-' : '-' }}</td>
                <td>{{ $stand->no_stand }}</td>
                <td>{{ $stand->lantai ? $stand->lantai->nama : '-' }}</td>
                <td>{{ $stand->panjang }}</td>
                <td>{{ $stand->lebar }}</td>
                <td>{{ $stand->luas }}</td>
                <td>{{ $stand->jenis_jualan ? $stand->jenis_jualan->nama : '-' }}</td>
                <td>{{ $stand->bentuk_stand ? $stand->bentuk_stand->nama : '-' }}</td>
                <td>{{ $stand->daya_listrik ? $stand->daya_listrik->nama : '-' }}</td>
                <td>{{ $stand->air ? 'Ada' : 'Tidak Ada' }}</td>
                <td>{{ $stand->bhptu ? $stand->bhptu->nomor : '-' }}</td>
                <td>{{ $stand->bhptu ? $stand->bhptu->tgl_berlaku ? $stand->bhptu->tgl_berlaku->format('d/m/Y') : '-' : '-' }}</td>
                <td>{{ $stand->status }}</td>
                <td>{{ $stand->keterangan }}</td>
                <td>{{ $stand->pasar ? $stand->pasar->nama : '-' }}</td>
                <td>{{ $stand->pasar ? $stand->pasar->alamat : '-' }}</td>
                <td>{{ $stand->pasar ? $stand->pasar->kelas ? $stand->pasar->kelas->nama : '-' : '-' }}</td>
                <td>{{ $stand->pasar ? $stand->pasar->cabang ? $stand->pasar->cabang->nama : '-' : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>