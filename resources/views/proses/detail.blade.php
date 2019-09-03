@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {
            $('.tanggal').datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
            });
        });
    </script>
@endsection

@section('content')
    <div class="content-wrapper" style="text-transform: uppercase">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        <i class="fas fa-cogs"></i> Detail Proses
                    </h2>

                    <hr>

                    @include('flash::message')

                    <div class="row my-4">
                        <div class="col text-center">
                            @if (Auth::user()->hasRole(\App\User::ROLE_KUNIT))
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.blangko', $transaksi->id) }}" target="_blank">Cetak Permohonan</a>
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.kuitansi', $transaksi->id) }}" target="_blank">Cetak Kuitansi</a>
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.tandapenerimaan', $transaksi->id) }}" target="_blank">Cetak Tanda Terima</a>
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.pptu', $transaksi->id) }}" target="_blank">Cetak PPTU</a>
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.suratpernyataan', $transaksi->id) }}" target="_blank">Cetak Pernyataan</a>
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.beritaacara', $transaksi->id) }}" target="_blank">Cetak Berita Acara</a>
                            @elseif (Auth::user()->hasRole(\App\User::ROLE_KCABANG))
                                <button class="btn btn-warning btn-flat"  data-toggle="modal" data-target="#validasiModal">Validasi</button>
                                <a class="btn btn-info btn-flat" href="{{ route('cetak.bkmc', $transaksi->id) }}" target="_blank">Cetak BKMC</a>
                            @elseif (Auth::user()->hasRole(\App\User::ROLE_KPEMASARAN))
                                @if ($transaksi->status != '4')
                                    <button class="btn btn-warning btn-flat" onclick="if (confirm('Apakah anda yakin?')) $('#formValidasi').submit()">Validasi</button>
                                @endif
                                @if ($transaksi->status == '4')
                                    <a class="btn btn-info btn-flat" href="{{ route('cetak.buku', $transaksi->id) }}" target="_blank">Cetak Buku Stand</a>
                                    <a class="btn btn-info btn-flat" href="{{ route('cetak.kartu', $transaksi->id) }}" target="_blank">Cetak Kartu Stand</a>
                                @endif
                            @elseif (Auth::user()->hasRole(\App\User::ROLE_DIREKTUR))
                                <button class="btn btn-warning btn-flat" onclick="if (confirm('Apakah anda yakin?')) $('#formValidasi').submit()">Validasi</button>
                            @endif

                            {!! Form::open(['route' => ['proses.validasi', $transaksi->id], 'id' => 'formValidasi']) !!}
                            {!! Form::close() !!}

                            <div class="modal fade" id="validasiModal" role="dialog" aria-labelledby="validasiLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="validasiLabel">Validasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {!! Form::open(['route' => ['proses.validasi', $transaksi->id]]) !!}
                                        <div class="modal-body">

                                            <div class="form-group row">
                                                {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => '3']) !!}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Validasi</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @role(App\User::ROLE_KPEMASARAN)
                    @if ($transaksi->status != '4')
                    <div class="text-center">
                        <button class="btn btn-warning btn-flat"  data-toggle="modal" data-target="#editModal">Edit</button>

                        <div class="modal fade" id="editModal" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editLabel">Validasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {!! Form::model($transaksi, ['route' => ['proses.update', $transaksi->id], 'method' => 'PUT']) !!}
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            {!! Form::label('nik', 'NIK', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('nik', null, ['required' => 'required', 'class' => 'form-control', 'rows' => '3']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('nama', 'Nama', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('nama', null, ['required' => 'required', 'class' => 'form-control', 'rows' => '3']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('alamat', null, ['required' => 'required', 'class' => 'form-control', 'rows' => '3']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('kota', 'Kota', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('kota', null, ['required' => 'required', 'class' => 'form-control', 'rows' => '3']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('telp', 'Telp', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('telp', null, ['required' => 'required', 'class' => 'form-control', 'rows' => '3']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('tgl_lahir', 'Tgl. Lahir', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                            <div class="input-group col-sm-8">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                {!! Form::text('tgl_lahir', $transaksi->tgl_lahir->format('d/m/Y'), ['class' => 'form-control tanggal']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Validasi</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endrole

                    <div class="row mt-4">
                        <div class="col-6">
                            <table style="width: 100%;">
                                <tr>
                                    <td width="25%">Tgl. Permohonan</td>
                                    <td>: {{ $transaksi->tgl_permohonan->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Biaya</td>
                                    <td>: {{ $transaksi->biaya }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{ $transaksi->keterangan }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>: {{ \App\Transaksi::STATUS[$transaksi->status] }}</td>
                                </tr>
                                <tr>
                                    <td>Proses</td>
                                    <td>: {{ implode(' ', $transaksi->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col">
                            <table style="width: 100%">
                                <tr>
                                    <td width="35%">Keterangan KA Cabang</td>
                                    <td>: {{ $transaksi->keterangan_kcabang }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Validasi Cabang</td>
                                    <td>: {{ $transaksi->tgl_valid_kcabang ? $transaksi->tgl_valid_kcabang->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Validasi Pemasaran</td>
                                    <td>: {{ $transaksi->tgl_valid_kpemasaran ? $transaksi->tgl_valid_kpemasaran->format('d/m/Y') : '-'}}</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Validasi Direksi</td>
                                    <td>: {{ $transaksi->tgl_valid_direksi ? $transaksi->tgl_valid_direksi->format('d/m/Y') : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <h4 class="text-center">Proses Perizinan Terakhir</h4>
                            <hr>
                            @if ($transaksi_terakhir)
                            <div class="row">
                                <div class="col-6">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td width="25%">Tgl. Permohonan</td>
                                            <td>: {{ $transaksi_terakhir->tgl_permohonan->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya</td>
                                            <td>: {{ $transaksi_terakhir->biaya }}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>: {{ $transaksi_terakhir->keterangan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>: {{ \App\Transaksi::STATUS[$transaksi_terakhir->status] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Proses</td>
                                            <td>: {{ implode(' ', $transaksi_terakhir->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col">
                                    <table style="width: 100%">
                                        <tr>
                                            <td width="35%">Keterangan KA Cabang</td>
                                            <td>: {{ $transaksi_terakhir->keterangan_kcabang }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Validasi Cabang</td>
                                            <td>: {{ $transaksi_terakhir->tgl_valid_kcabang->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Validasi Pemasaran</td>
                                            <td>: {{ $transaksi_terakhir->tgl_valid_kpemasaran ? $transaksi_terakhir->tgl_valid_kpemasaran->format('d/m/Y') : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Validasi Direksi</td>
                                            <td>: {{ $transaksi_terakhir->tgl_valid_direksi ? $transaksi_terakhir->tgl_valid_direksi->format('d/m/Y') : '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @else
                            <div class="text-center">
                                Tidak ada data yang ditemukan.
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-center">Detail Stand Lama</h4>
                                    <hr>
                                    <table style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td width="25%">No. Regin</td>
                                                <td>: {{ $transaksi->stand->no_reg }}</td>
                                            </tr>
                                            <tr>
                                                <td>No. Rekening</td>
                                                <td>: {{ $transaksi->stand->no_rekening }}</td>
                                            </tr>
                                            <tr>
                                                <td>No. Stand</td>
                                                <td>: {{ $transaksi->stand->no_stand }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bentuk Stand</td>
                                                <td>: {{ $transaksi->stand->bentuk_stand ? $transaksi->stand->bentuk_stand->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Panjang</td>
                                                <td>: {{ $transaksi->stand->panjang }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lebar</td>
                                                <td>: {{ $transaksi->stand->lebar }}</td>
                                            </tr>
                                            <tr>
                                                <td>Luas</td>
                                                <td>: {{ $transaksi->stand->luas }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Jualan</td>
                                                <td>: {{ $transaksi->stand->jenis_jualan ? $transaksi->stand->jenis_jualan->nama : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Air</td>
                                                <td>: {{ $transaksi->stand->air ? 'Ada' : 'Tidak Ada' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Daya Listrik</td>
                                                <td>: {{ $transaksi->stand->daya_listrik ? $transaksi->stand->daya_listrik->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lantai</td>
                                                <td>: {{ $transaksi->stand->lantai ? $transaksi->stand->lantai->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pasar</td>
                                                <td>: {{ $transaksi->stand->pasar ? $transaksi->stand->pasar->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>: {{ $transaksi->stand->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>: {{ $transaksi->stand->keterangan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="col">
                                    <h4 class="text-center">Detail Stand Baru</h4>
                                    <hr>
                                    <table style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td width="25%">No. Regin</td>
                                                <td>: {{ $transaksi->stand->no_reg }}</td>
                                            </tr>
                                            <tr>
                                                <td>No. Rekening</td>
                                                <td>: {{ $transaksi->stand->no_rekening }}</td>
                                            </tr>
                                            <tr>
                                                <td>No. Stand</td>
                                                <td>: {{ $transaksi->stand->no_stand }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bentuk Stand</td>
                                                <td>: @if ($detail_sib) {{ $detail_sib->bentuk_stand_baru ? $detail_sib->bentuk_stand_baru->nama : '-' }} @else {{ $transaksi->stand->bentuk_stand ? $transaksi->stand->bentuk_stand->nama : '-' }} @endif</td>
                                            </tr>
                                            <tr>
                                                <td>Panjang</td>
                                                <td>: {{ $transaksi->stand->panjang }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lebar</td>
                                                <td>: {{ $transaksi->stand->lebar }}</td>
                                            </tr>
                                            <tr>
                                                <td>Luas</td>
                                                <td>: {{ $transaksi->stand->luas }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Jualan</td>
                                                <td>: @if ($detail_sij) {{ $detail_sij->jenis_jualan_baru ? $detail_sij->jenis_jualan_baru->nama : '-' }} @else {{ $transaksi->stand->jenis_jualan ? $transaksi->stand->jenis_jualan->nama : '' }} @endif</td>
                                            </tr>
                                            <tr>
                                                <td>Air</td>
                                                <td>: {{ $transaksi->stand->air ? 'Ada' : 'Tidak Ada' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Daya Listrik</td>
                                                <td>: {{ $transaksi->stand->daya_listrik ? $transaksi->stand->daya_listrik->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lantai</td>
                                                <td>: {{ $transaksi->stand->lantai ? $transaksi->stand->lantai->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pasar</td>
                                                <td>: {{ $transaksi->stand->pasar ? $transaksi->stand->pasar->nama : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>: {{ $transaksi->stand->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>: {{ $transaksi->stand->keterangan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($transaksi->stand->pedagang)
                    <div class="row my-4">
                        <div class="col">
                            <h4 class="text-center">Detail Pedagang Lama</h4>
                            <hr>
                            <table style="width:100%">
                                <tbody>
                                    <tr>
                                        <td width="25%">NIK</td>
                                        <td>: {{ $transaksi->stand->pedagang->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {{ $transaksi->stand->pedagang->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ $transaksi->stand->pedagang->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kota</td>
                                        <td>: {{ $transaksi->stand->pedagang->kota }}</td>
                                    </tr>
                                    <tr>
                                        <td>Telp</td>
                                        <td>: {{ $transaksi->stand->pedagang->telp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Lahir</td>
                                        <td>: {{ $transaksi->stand->pedagang->tgl_lahir->format('d/m/Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <h4 class="text-center">Detail Pedagang Baru</h4>
                            <hr>
                            <table style="width:100%">
                                <tbody>
                                    <tr>
                                        <td width="25%">NIK</td>
                                        <td>: {{ $detail_bn ? $detail_bn->nik_baru : $transaksi->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {{ $detail_bn ? $detail_bn->nama_baru : $transaksi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ $detail_bn ? $detail_bn->alamat_baru : $transaksi->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kota</td>
                                        <td>: {{ $detail_bn ? $detail_bn->kota_baru : $transaksi->kota }}</td>
                                    </tr>
                                    <tr>
                                        <td>Telp</td>
                                        <td>: {{ $detail_bn ? $detail_bn->telp_baru : $transaksi->telp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Lahir</td>
                                        <td>: {{ $detail_bn ? $detail_bn->tgl_lahir_baru->format('d/m/Y') : $transaksi->tgl_lahir->format('d/m/Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection