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

        document.getElementById("uploadFoto").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("previewFoto").src = e.target.result;
                document.getElementById("previewFoto").style.display = "block";
            };

            reader.readAsDataURL(this.files[0]);
        };
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        <i class="fas fa-store"></i> Stand {{ $stand->no_stand }}
                    </h2>
                    <hr>

                    <div class="row">
                        <div class="col col-md-8 offset-md-2">
                            {!! Form::model($stand->pedagang, ['route' => ['stand.update_pedagang', $stand->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group row">
                                {!! Form::label('nik', 'NIK', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col">
                                    {!! Form::text('nik', $stand->pedagang->nik, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('nama', 'Nama', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col">
                                    {!! Form::text('nama', $stand->pedagang->nama, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col">
                                    {!! Form::text('alamat', $stand->pedagang->alamat, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('kota', 'Kota', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col">
                                    {!! Form::text('kota', $stand->pedagang->kota, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('telp', 'Telp', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col">
                                    {!! Form::text('telp', $stand->pedagang->telp, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('tgl_lahir', 'Tgl. Lahir', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="input-group col">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    {!! Form::text('tgl_lahir', $stand->pedagang->tgl_lahir->format('d/m/Y'), ['class' => 'form-control tanggal']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Foto (Maks. 1 MB)</label>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <img id="previewFoto" style="display: none; width: auto; height: 180px; margin-bottom: 16px;">
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        {!! Form::file('foto', ['class' => 'custom-file-input', 'id' => 'uploadFoto']) !!}
                                        {!! Form::label('foto', 'Choose File', ['class' => 'custom-file-label']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col text-right">
                                    {!! Form::submit(null, ['class' => 'btn btn-primary btn-flat']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
