@extends('layouts.master')

@php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css">
    <style>
        .foto img {
            width: auto;
            max-height: 240px;
        }

        .vertical-separator {
            width: 1px;
            background: #b9bbbe;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/select2/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2({
                width: '100%'
            });

            $('.tanggal').datepicker({
                format: "dd/mm/yyyy",
            });
        })
    </script>
@endsection

@section('content')
    <div class="content-wrapper pb-5" style="text-transform: uppercase">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        <i class="fas fa-store"></i> Stand {{ $stand->no_stand }}

                        @can('stand-edit')
                        <button class="btn btn-danger btn-flat float-right ml-2" onclick="if (confirm('Apakah anda yakin?')) $('#formDelete').submit()">Hapus Stand</button>
                        <button class="btn btn-warning btn-flat float-right" data-toggle="modal" data-target="#editPasarModal">Edit Stand</button>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['stand.destroy', $stand->id], 'id' => 'formDelete' ]) !!}
                        {!! Form::close() !!}
                        @endcan
                    </h2>

                    @can('stand-edit')
                    <div class="modal fade" id="editPasarModal" role="dialog" aria-labelledby="editPasarLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPasarLabel">Edit Stand</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {!! Form::model($stand, array('route' => array('stand.update', $stand->id), 'method' => 'PUT')) !!}
                                <div class="modal-body">

                                    <div class="form-group row">
                                        {!! Form::label('no_reg', 'No. Reg', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('no_reg', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('no_rekening', 'No. Rekening', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('no_rekening', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('no_stand', 'No. Stand', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('no_stand', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_bentuk_stand', 'Bentuk Stand', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_bentuk_stand', $bentuk_stand, null, ['class' => 'form-control', 'placeholder' => '-- Bentuk Stand --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('panjang', 'Panjang', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('panjang', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('lebar', 'Lebar', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('lebar', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('luas', 'Luas', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('luas', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_jenis_jualan', 'Jenis Jualan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_jenis_jualan', $jenis_jualan, null, ['class' => 'form-control select2', 'placeholder' => '-- Jenis Jualan --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('air', 'Air', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('air', ['0' => 'Tidak', 'Ya'], null, ['class' => 'form-control', 'placeholder' => '-- Air --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_daya_listrik', 'Daya Listrik', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_daya_listrik', $daya_listrik, null, ['class' => 'form-control', 'placeholder' => '-- Daya Listrik --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_lantai', 'Lantai', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_lantai', $lantai, null, ['class' => 'form-control', 'placeholder' => '-- Lantai --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('status', 'Status', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('status', \App\Stand::STATUS, null, ['class' => 'form-control', 'placeholder' => '-- Status --']) !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    @endcan

                    <hr>

                    @include('flash::message')

                    <div class="row">
                        <div class="col-12 col-md mb-4 mb-md-0">

                            <div class="text-center mb-3">
                                <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#segelPasarModal">Segel Stand</button>
                                <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#cabutPasarModal">Cabut Stand</button>

                                <div class="modal fade" id="segelPasarModal" role="dialog" aria-labelledby="segelPasarLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="segelPasarLabel">Segel Stand</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['route' => ['stand.segel', $stand->id], 'method' => 'PUT']) !!}
                                            <div class="modal-body">
            
                                                <div class="form-group row">
                                                    {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                                    </div>
                                                </div>
            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="cabutPasarModal" role="dialog" aria-labelledby="cabutPasarLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cabutPasarLabel">Cabut Stand</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['route' => ['stand.cabut', $stand->id], 'method' => 'PUT']) !!}
                                            <div class="modal-body">
            
                                                <div class="form-group row">
                                                    {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                                    </div>
                                                </div>
            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table style="width: 100%;">
                                <tr>
                                    <td width="25%">No. Reg</td>
                                    <td>: {{ $stand->no_reg ? $stand->no_reg : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>No. Rekening</td>
                                    <td>: {{ $stand->no_rekening ? $stand->no_rekening : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>No. Stand</td>
                                    <td>: {{ $stand->no_stand ? $stand->no_stand : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Bentuk Stand</td>
                                    <td>: {{ $stand->bentuk_stand ? $stand->bentuk_stand->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Panjang</td>
                                    <td>: {{ $stand->panjang ? $stand->panjang.'m' : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Lebar</td>
                                    <td>: {{ $stand->lebar ? $stand->lebar.'m' : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Luas</td>
                                    <td>: {!! $stand->luas ? $stand->luas.'m<sup>2</sup>' : '-' !!}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Jualan</td>
                                    <td>: {{ $stand->jenis_jualan ? $stand->jenis_jualan->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Air</td>
                                    <td>: {{ $stand->air ? 'ADA' : 'TIDAK ADA' }}</td>
                                </tr>
                                <tr>
                                    <td>Daya Listrik</td>
                                    <td>: {{ $stand->daya_listrik ? $stand->daya_listrik->nama.'WATT' : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Lantai</td>
                                    <td>: {{ $stand->lantai ? $stand->lantai->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Pasar</td>
                                    <td>: {{ $stand->pasar ? $stand->pasar->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>: {{ $stand->status ? $stand->status : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{ $stand->keterangan ? $stand->keterangan : '-' }}</td>
                                </tr>
                            </table>

                            @if ($stand->bhptu)

                                <hr>

                                <div class="text-center mb-3">
                                    <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#editBhptuModal">
                                        Edit Buku
                                    </button>
                                </div>
                                
                                <div class="modal fade" id="editBhptuModal" tabindex="-1" role="dialog" aria-labelledby="editBhptuTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBhptuTitle">Edit Buku</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::model($stand->bhptu, ['route' => ['stand.update.bhptu', $stand->id], 'method' => 'PUT']) !!}
                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    {!! Form::label('no_bhptu', 'No. Buku', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('no_bhptu', $stand->bhptu->nomor, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    {!! Form::label('tgl_bhptu', 'Tgl. Ditetapkan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('tgl_bhptu', $stand->bhptu->tanggal->format('d/m/Y'), ['class' => 'form-control tanggal']) !!}
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    {!! Form::label('tgl_berlaku_bhptu', 'Berlaku Sampai', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('tgl_berlaku_bhptu', $stand->bhptu->tgl_berlaku->format('d/m/Y'), ['class' => 'form-control tanggal']) !!}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                                <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td width="25%">No. Buku</td>
                                            <td>: {{ $stand->bhptu->nomor }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Ditetapkan</td>
                                            <td>: {{ $stand->bhptu->tanggal->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Berlaku Sampai</td>
                                            <td>: {{ $stand->bhptu->tgl_berlaku->format('d/m/Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <hr>
                                <div class="alert alert-danger">
                                    Buku stand tidak ditemukan.
                                </div>
                            @endif

                            @if ($stand->pptu)
                                <hr>
                                <div class="text-center mb-3">
                                    <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#editKartuModal">
                                        Edit Kartu
                                    </button>
                                </div>

                                <div class="modal fade" id="editKartuModal" tabindex="-1" role="dialog" aria-labelledby="editKartuTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKartuTitle">Edit Kartu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::model($stand->pptu, ['route' => ['stand.update.pptu', $stand->id], 'method' => 'PUT']) !!}
                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    {!! Form::label('no_pptu', 'No. Buku', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('no_pptu', $stand->pptu->nomor, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    {!! Form::label('tgl_pptu', 'Tgl. Ditetapkan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('tgl_pptu', $stand->pptu->tanggal->format('d/m/Y'), ['class' => 'form-control tanggal']) !!}
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    {!! Form::label('tgl_berlaku_pptu', 'Berlaku Sampai', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('tgl_berlaku_pptu', $stand->pptu->tgl_berlaku->format('d/m/Y'), ['class' => 'form-control tanggal']) !!}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                                <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td width="25%">No. Kartu</td>
                                            <td>: {{ $stand->pptu->nomor }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Ditetapkan</td>
                                            <td>: {{ $stand->pptu->tanggal->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Berlaku Sampai</td>
                                            <td>: {{ $stand->pptu->tgl_berlaku->format('d/m/Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <hr>
                                <div class="alert alert-danger">
                                    Kartu stand tidak ditemukan.
                                </div>
                            @endif
                        </div>

                        <div class="vertical-separator d-none d-md-block"></div>

                        <div class="col-12 col-md">

                            @if ($stand->pedagang)
                            <div class="text-center mb-3">
                                <a href="{{ route('stand.edit_pedagang', $stand->id) }}" class="btn btn-warning btn-flat">Edit Pedagang</a>
                            </div>

                            <div class="foto text-center mb-3">
                                <img src="{{ asset(Storage::url($stand->pedagang->foto)) }}" alt="">
                            </div>

                            <table class="ml-md-3 w-100">
                                <tr>
                                    <td class="w-25">NIK</td>
                                    <td>: {{ $stand->pedagang->nik ? $stand->pedagang->nik : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $stand->pedagang->nama ? $stand->pedagang->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $stand->pedagang->alamat ? $stand->pedagang->alamat : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>: {{ $stand->pedagang->kota ? $stand->pedagang->kota : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Telp</td>
                                    <td>: {{ $stand->pedagang->telp ? $stand->pedagang->telp : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Lahir</td>
                                    <td>: {{ $stand->pedagang->tgl_lahir ? $stand->pedagang->tgl_lahir->format('d/m/Y') : '-' }}</td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection