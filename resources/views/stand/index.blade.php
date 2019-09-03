@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/select2/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2({
                width: '100%'
            });

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
        })
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h2 class="d-inline-block">
                                <i class="fas fa-store"></i> Kelola Stand @if (Auth::user()->hasRole(\App\User::ROLE_KUNIT)) | Pasar {{ title_case(Auth::user()->pasar->nama) }} @endif
                            </h2>
                        </div>
                        <div class="col-3">
                            @hasanyrole('Direktur|KA Pemasaran|KA Cabang')
                            <div class="form-group">
                                {!! Form::open(['route' => 'stand', 'method' => 'GET']) !!}
                                {!! Form::select('p', $pasar, \Illuminate\Support\Facades\Input::get('p'), ['class' => 'form-control select2', 'placeholder' => '-- PILIH PASAR --', 'onchange' => 'this.form.submit()']) !!}
                                {!! Form::close() !!}
                            </div>
                            @endhasanyrole
                        </div>
                    </div>

                    <hr>

                    @if (isset($stands))
                    @can('stand-edit')
                    <div class="row mb-3">
                        <div class="col">
                            <button class="btn btn-outline-info float-right"  data-toggle="modal" data-target="#addStandModal">Tambah Stand</button>
                        </div>
                    </div>

                    <div class="modal fade" id="addStandModal" role="dialog" aria-labelledby="addStandLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStandLabel">Tambah Stand</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {!! Form::open(['route' => 'stand.store']) !!}
                                {!! Form::hidden('id_pasar', \Illuminate\Support\Facades\Input::get('p')) !!}
                                <div class="modal-body">

                                    <div class="form-group row">
                                        {!! Form::label('id_bentuk_stand', 'Bentuk Stand', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_bentuk_stand', $bentuk_stand, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => '-- Bentuk Stand --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_jenis_jualan', 'Jenis Jualan', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_jenis_jualan', $jenis_jualan, null, ['required' => 'required', 'class' => 'form-control select2', 'placeholder' => '-- Jenis Jualan --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_lantai', 'Lantai', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_lantai', $lantai, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => '-- Lantai --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('id_daya_listrik', 'Daya Listrik', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('id_daya_listrik', $daya_listrik, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => '-- Daya Listrik --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('no_reg', 'No. Reg', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('no_reg', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('no_rekening', 'No. Rekening', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('no_rekening', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('no_stand', 'No. Stand', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('no_stand', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('panjang', 'Panjang', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('panjang', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('lebar', 'Lebar', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('lebar', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('luas', 'Luas', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('luas', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('air', 'Air', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('air', ['0' => 'Tidak', 'Ya'], null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => '-- Air --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('status', 'Status', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('status', \App\Stand::STATUS, null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => '-- Status --']) !!}
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

                    @include('flash::message')

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-indexed">

                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Reg</th>
                                <th>No. Rekening</th>
                                <th>No. Stand</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Operations</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($stands as $stand)
                                <tr>
                                    <td></td>
                                    <td>{{ $stand->no_reg }}</td>
                                    <td>{{ $stand->no_rekening }}</td>
                                    <td>{{ $stand->no_stand }}</td>
                                    <td>{{ $stand->status }}</td>
                                    <td>{{ $stand->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('stand.edit', $stand->id) }}" class="btn btn-warning btn-sm">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection