@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            var t = $('.table-indexed').DataTable( {
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'asc' ]]
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        <i class="fa fa-users"></i> Kelola Tarif

                        @can('tarif-edit')
                        <button class="btn btn-outline-info float-right"  data-toggle="modal" data-target="#addTarifModal">Tambah Tarif</button>
                        @endcan
                    </h2>

                    @can('tarif-edit')
                    <div class="modal fade" id="addTarifModal" tabindex="-1" role="dialog" aria-labelledby="addTarifLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addTarifLabel">Tambah Tarif</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {{ Form::open(array('route' => 'tarif.store')) }}
                                <div class="modal-body">

                                    <div class="form-group row">
                                        {!! Form::label('nama', 'Nama', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('nama', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_kelas_pasar', 'Kelas Pasar', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_kelas_pasar', $kelas_pasar, null, ['class' => 'form-control', 'placeholder' => '-- Kelas Pasar --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_bentuk_stand', 'Bentuk Stand', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_bentuk_stand', $bentuk_stand, null, ['class' => 'form-control', 'placeholder' => '-- Bentuk Stand --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_kelompok_jualan', 'Kelompok Jualan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_kelompok_jualan', $kelompok_jualan, null, ['class' => 'form-control', 'placeholder' => '-- Kelompok Jualan --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_lantai', 'Lantai', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_lantai', $lantai, null, ['class' => 'form-control', 'placeholder' => '-- Lantai --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('tarif', 'Tarif', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            {!! Form::text('tarif', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    @endcan

                    <hr>
                    @include('flash::message')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-indexed">

                            <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Bentuk Stand</th>
                                <th>Kelompok Jualan</th>
                                <th>Lantai</th>
                                <th>Tarif</th>
                                @can('tarif-edit')<th>Action</th>@endcan
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($tarifs as $tarif)
                                <tr>
                                    <td></td>
                                    <td>{{ $tarif->nama }}</td>
                                    <td>{{ $tarif->kelas_pasar ? $tarif->kelas_pasar->nama : '-' }}</td>
                                    <td>{{ $tarif->bentuk_stand ? $tarif->bentuk_stand->nama : '-'}}</td>
                                    <td>@if ($tarif->kelompok_jualan)KELOMPOK {{ $tarif->kelompok_jualan->nama }}@endif</td>
                                    <td>{{ $tarif->lantai ? $tarif->lantai->nama : '-' }}</td>
                                    <td>{{ money_format('%n', $tarif->tarif) }}</td>
                                    @can('tarif-edit')
                                    <td>
                                        <button class="btn btn-warning btn-sm btn-flat"  data-toggle="modal" data-target="#editTarifModal{{ $tarif->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-flat" onclick="if (confirm('Apakah anda yakin?')) document.getElementById('formDelete{{ $tarif->id }}').submit()">Hapus</button>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['tarif.destroy', $tarif->id], 'id' => 'formDelete'.$tarif->id ]) !!}
                                        {!! Form::close() !!}

                                        <div class="modal fade" id="editTarifModal{{ $tarif->id }}" tabindex="-1" role="dialog" aria-labelledby="editTarifLabel{{ $tarif->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTarifLabel{{ $tarif->id }}">Edit Tarif</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{ Form::model($tarif, ['route' => ['tarif.update', $tarif->id], 'method' => 'PUT']) }}
                                                    <div class="modal-body">

                                                        <div class="form-group row">
                                                            {!! Form::label('nama', 'Nama', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::text('nama', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('id_kelas_pasar', 'Kelas Pasar', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::select('id_kelas_pasar', $kelas_pasar, null, ['class' => 'form-control', 'placeholder' => '-- Kelas Pasar --']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('id_bentuk_stand', 'Bentuk Stand', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::select('id_bentuk_stand', $bentuk_stand, null, ['class' => 'form-control', 'placeholder' => '-- Bentuk Stand --']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('id_kelompok_jualan', 'Kelompok Jualan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::select('id_kelompok_jualan', $kelompok_jualan, null, ['class' => 'form-control', 'placeholder' => '-- Kelompok Jualan --']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('id_lantai', 'Lantai', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::select('id_lantai', $lantai, null, ['class' => 'form-control', 'placeholder' => '-- Lantai --']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('tarif', 'Tarif', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="input-group col-sm-9">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp</div>
                                                                </div>
                                                                {!! Form::text('tarif', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection