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
                        <i class="fa fa-industry"></i> Kelola Pasar
                        @can('pasar-edit')
                        <button class="btn btn-outline-info float-right"  data-toggle="modal" data-target="#addPasarModal">Tambah Pasar</button>
                        @endcan
                    </h2>

                    @can('pasar-edit')
                    <div class="modal fade" id="addPasarModal" tabindex="-1" role="dialog" aria-labelledby="addPasarLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPasarLabel">Tambah Pasar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {!! Form::open(['route' => 'pasar.store']) !!}
                                <div class="modal-body">

                                    <div class="form-group row">
                                        {!! Form::label('nama', 'Nama', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('nama', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('alamat', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_kelas_pasar', 'Kelas', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_kelas_pasar', $kelas, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Kelas...']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_cabang', 'Cabang', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_cabang', $cabang, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Cabang...']) !!}
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
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Cabang</th>
                                @can('pasar-edit')<th>Operations</th>@endcan
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($pasars as $pasar)
                                <tr>
                                    <td></td>
                                    <td>{{ $pasar->nama }}</td>
                                    <td>{{ $pasar->alamat }}</td>
                                    <td>{{ $pasar->kelas->nama }}</td>
                                    <td>{{ $pasar->cabang->nama }}</td>
                                    @can('pasar-edit')
                                    <td>
                                        <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#editPasarModal{{ $pasar->id }}">Edit</button>

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="if (confirm('Apakah anda yakin?')) document.getElementById('formDelete{{ $pasar->id }}').submit()">Hapus</button>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['pasar.destroy', $pasar->id], 'id' => 'formDelete'.$pasar->id ]) !!}
                                        {!! Form::close() !!}

                                        <div class="modal fade" id="editPasarModal{{ $pasar->id }}" tabindex="-1" role="dialog" aria-labelledby="editPasarLabel{{ $pasar->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPasarLabel{{ $pasar->id }}">Edit Pasar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {!! Form::model($pasar, array('route' => array('pasar.update', $pasar->id), 'method' => 'PUT')) !!}
                                                    <div class="modal-body">

                                                        <div class="form-group row">
                                                            {!! Form::label('nama', 'Nama', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::text('nama', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::text('alamat', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('id_kelas_pasar', 'Kelas', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::select('id_kelas_pasar', $kelas, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Kelas...']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            {!! Form::label('id_cabang', 'Cabang', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                            <div class="col-sm-9">
                                                                {!! Form::select('id_cabang', $cabang, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Cabang...']) !!}
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