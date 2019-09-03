@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css">
    <style>
        .hidden {
            display: none;
        }

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2({
                width: '100%'
            });

            $('.tanggal').datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
            });

            function cek() {
                if ($(".cb-jenis-proses:checked").length > 0) {
                    $('.formall').show(200);
                }
                else {
                    $('.formall').hide(200);
                }
            }

            $(".cb-jenis-proses").change(function () {
                cek();
                if (this.checked) $($(this).data('target')).show(200);
                else $($(this).data('target')).hide(200);
            });

            $('.pedagang-radio').change(function () {
                $($('#pedagang_lama').data('target')).toggle(200);
            });

            $('#selectPedagang').change(function () {
                getPedagang($(this).val());
            });

        })

        document.getElementById("uploadFoto").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("previewFoto").src = e.target.result;
                document.getElementById("previewFoto").style.display = "block";
            };

            reader.readAsDataURL(this.files[0]);
        };

        document.getElementById("uploadFoto2").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("previewFoto2").src = e.target.result;
                document.getElementById("previewFoto2").style.display = "block";
            };

            reader.readAsDataURL(this.files[0]);
        };

        function getPedagang(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.getpedagang') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (data) {
                    $('#nik_it').val(data.nik);
                    $('#nama_it').val(data.nama);
                    $('#alamat_it').val(data.alamat);
                    $('#kota_it').val(data.kota);
                    $('#telp_it').val(data.telp);
                    $('#tgl_lahir_it').datepicker('setDate', new Date(data.tgl_lahir));
                }
            });
        }

        function addBiaya(name, val) {
            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.generatemoneyformat') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    tarif: val
                },
                success: function (data) {
                    $('#biaya_table').append('<tr><td width="50%">'+ name +'</td><td>:</td><td>' + data +'</td></tr>');
                }
            });
        }

        function generateBiayaJSon() {
            biaya = {};
            $('.biaya').each(function() {
                nama = $(this).find('.biaya_nama').text();
                jumlah = $(this).find('.biaya_jumlah').text();

                console.log(nama, jumlah);

                biaya[nama] = jumlah;
            });

            biaya = JSON.stringify(biaya);
            alert(biaya);
        }

        function getBiaya(luas, id_kelas_pasar, id_bentuk_stand, id_kelompok_jualan, id_lantai) {
            $.ajaxSetup({async:false});
            biaya = 0;
            biaya_detail = [];

            if (id_kelompok_jualan == 0) {
                swal("Error!", "Jenis Jualan tidak ditemukan", "error");
                return;
            } else if (luas == 0) {
                swal("Error!", "Luas tidak ditemukan", "error");
                return;
            } else if (id_lantai == 0) {
                swal("Error!", "Lantai tidak ditemukan", "error");
                return;
            }

            $('#biaya_table').empty();
            $('.cb-jenis-proses:checked').each(function() {
                if ($(this).val() == 1) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayait') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_kelas_pasar: id_kelas_pasar,
                            id_bentuk_stand: id_bentuk_stand,
                            id_kelompok_jualan: id_kelompok_jualan,
                            id_lantai: id_lantai,
                            luas: luas
                        },
                        success: function (data) {
                            biaya_it = 0;
                            for (i in data) {
                                biaya_it += data[i].tarif;
                                addBiaya(data[i].nama, data[i].tarif);
                            }
                            biaya += biaya_it;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_it').val(biaya_it);
                            $('#biaya_detail_it').val(JSON.stringify(data));
                        }
                    });
                }

                if ($(this).val() == 2) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayabn') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_kelas_pasar: id_kelas_pasar,
                            id_bentuk_stand: id_bentuk_stand,
                            id_kelompok_jualan: id_kelompok_jualan,
                            id_lantai: id_lantai,
                            luas: luas,
                            denda: $('#cb-denda-bn').is(':checked') ? '1' : '0'
                        },
                        success: function (data) {
                            biaya_bn = 0;
                            for (i in data) {
                                biaya_bn += data[i].tarif;
                                addBiaya(data[i].nama, data[i].tarif);
                            }
                            biaya += biaya_bn;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_bn').val(biaya_bn);
                            $('#biaya_detail_bn').val(JSON.stringify(data));
                        }
                    });
                }

                if ($(this).val() == 3) {
                    if ($('#periode_her').val() == '') {
                        swal("Error!", "Pilih periode Her", "error");
                        return;
                    } else if ($('#periode_denda_her').val() == '') {
                        swal("Error!", "Pilih periode denda Her", "error");
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayaher') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_kelas_pasar: id_kelas_pasar,
                            id_bentuk_stand: id_bentuk_stand,
                            id_kelompok_jualan: id_kelompok_jualan,
                            id_lantai: id_lantai,
                            luas: luas,
                            periode: $('#periode_her').val(),
                            periode_denda: $('#periode_denda_her').val()
                        },
                        success: function (data) {
                            biaya_her = 0;
                            for (i in data) {
                                biaya_her += data[i].tarif;
                                addBiaya(data[i].nama, data[i].tarif);
                            }
                            biaya += biaya_her;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_her').val(biaya_her);
                            $('#biaya_detail_her').val(JSON.stringify(data));
                        }
                    });
                }

                if ($(this).val() == 4) {
                    if ($('#id_jenis_jualan_baru').val() == '') {
                        swal("Error!", "Pilih Jenis Jualan Baru", "error");
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayasij') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_kelas_pasar: id_kelas_pasar,
                            id_bentuk_stand: id_bentuk_stand,
                            id_jenis_jualan: $('#id_jenis_jualan_baru').val(),
                            id_lantai: id_lantai,
                            luas: luas,
                            denda: $('#cb-denda-sij').is(':checked') ? '1' : '0'
                        },
                        success: function (data) {
                            biaya_sij = 0;
                            for (i in data) {
                                biaya_sij += data[i].tarif;
                                addBiaya(data[i].nama, data[i].tarif);
                            }
                            biaya += biaya_sij;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_sij').val(biaya_sij);
                            $('#biaya_detail_sij').val(JSON.stringify(data));
                        }
                    });
                }

                if ($(this).val() == 5) {
                    if ($('#id_bentuk_stand_baru').val() == '') {
                        swal("Error!", "Pilih Bentuk Stand Baru", "error");
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayasib') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_kelas_pasar: id_kelas_pasar,
                            id_bentuk_stand: $('#id_bentuk_stand_baru').val(),
                            id_kelompok_jualan: id_kelompok_jualan,
                            id_lantai: id_lantai,
                            luas: luas,
                            denda: $('#cb-denda-sib').is(':checked') ? '1' : '0'
                        },
                        success: function (data) {
                            biaya_sib = 0;
                            for (i in data) {
                                biaya_sib += data[i].tarif;
                                addBiaya(data[i].nama, data[i].tarif);
                            }
                            biaya += biaya_sib;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_sib').val(biaya_sib);
                            $('#biaya_detail_sib').val(JSON.stringify(data));
                        }
                    });
                }

                if ($(this).val() == 6) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayaips') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_kelas_pasar: id_kelas_pasar,
                            id_bentuk_stand: id_bentuk_stand,
                            id_kelompok_jualan: id_kelompok_jualan,
                            id_lantai: id_lantai,
                            luas: luas
                        },
                        success: function (data) {
                            biaya_ips = 0;
                            for (i in data) {
                                biaya_ips += data[i].tarif;
                                addBiaya(data[i].nama, data[i].tarif);
                            }
                            biaya += biaya_ips;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_ips').val(biaya_ips);
                            $('#biaya_detail_ips').val(JSON.stringify(data));
                        }
                    });
                }

                if ($(this).val() == 7) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.getbiayagantibuku') }}',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            console.log(data);
                            addBiaya(data.nama, data.tarif);
                            biaya += data.tarif;
                            biaya_detail = biaya_detail.concat(data);
                            $('#biaya_ganti_buku').val(data.tarif);
                            $('#biaya_detail_ganti_buku').val(JSON.stringify(data));
                        }
                    });
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.getbiayabtu') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    biaya += data.tarif;
                    biaya_detail = biaya_detail.concat(data);
                    addBiaya(data.nama, data.tarif);
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.getbiayappn') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    tarif: biaya
                },
                success: function (data) {
                    biaya += data.tarif;
                    biaya_detail = biaya_detail.concat(data);
                    addBiaya(data.nama, data.tarif);
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.generatemoneyformat') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    tarif: biaya
                },
                success: function (data) {
                    $('#biaya_table').append('<tr style="border-top: 1px solid black;"><td width="50%">Total</td><td>:</td><td>' + data +'</td></tr>');
                }
            });

            $('#biaya').val(biaya);
            $('#biaya_detail').val(JSON.stringify(biaya_detail));
            $.ajaxSetup({async:true});
        }
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        <i class="fas fa-cogs"></i> Proses Baru @if (Auth::user()->hasRole(\App\User::ROLE_KUNIT)) | Pasar {{ title_case(Auth::user()->pasar->nama) }} @endif
                    </h2>

                    <hr>

                    {!! Form::open(['route' => 'proses.create', 'method' => 'GET']) !!}
                    <div class="form-group row">
                        <div class=" col-4 offset-4 col-md-2 offset-md-5">
                            {!! Form::select('s', $stands, \Illuminate\Support\Facades\Input::get('s'), ['class' => 'form-control select2', 'placeholder' => '-- Pilih Stand --', 'onchange' => 'this.form.submit()']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                    @if ($stand = \App\Stand::find(\Illuminate\Support\Facades\Input::get('s')))

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        @include('flash::message')

                        {!! Form::open(['route' => 'proses.store', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::hidden('id_stand', \Illuminate\Support\Facades\Input::get('s')) !!}

                        <hr>
                        <div class="row mb-5">
                            <div class="col text-center">
                                @foreach($jenis_proses as $jp)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input cb-jenis-proses" type="checkbox" id="checkbox{{ $jp->id }}" name="jenisproses[{{ $jp->id }}]" value="{{ $jp->id }}" data-target="#form{{ $jp->nama }}">
                                        <label class="form-check-label" for="checkbox{{ $jp->id }}">
                                            @if ($jp->nama != 'Her' && $jp->nama != 'BHPTU')
                                                {{ $jp->nama_lengkap }} ({{ $jp->nama }})
                                            @else
                                                {{ $jp->nama_lengkap }}
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md mb-4 mb-md-0">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="25%">No. Reg</td>
                                        <td>: {{ $stand->no_reg }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Rekening</td>
                                        <td>: {{ $stand->no_rekening }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Stand</td>
                                        <td>: {{ $stand->no_stand }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bentuk Stand</td>
                                        <td>: {{ $stand->bentuk_stand->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Panjang</td>
                                        <td>: {{ $stand->panjang }} m</td>
                                    </tr>
                                    <tr>
                                        <td>Lebar</td>
                                        <td>: {{ $stand->lebar }} m</td>
                                    </tr>
                                    <tr>
                                        <td>Luas</td>
                                        <td>: {{ $stand->luas }} m<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Jualan</td>
                                        <td>: @if ($stand->jenis_jualan) {{ $stand->jenis_jualan->nama }} @else - @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Air</td>
                                        <td>: {{ $stand->air ? 'ADA' : 'TIDAK ADA' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Daya Listrik</td>
                                        <td>: @if ($stand->daya_listrik) {{ $stand->daya_listrik->nama }} Watt @else - @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Lantai</td>
                                        <td>: @if ($stand->lantai) {{ $stand->lantai->nama }} @else - @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Pasar</td>
                                        <td>: {{ $stand->pasar->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>: {{ $stand->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>: {{ $stand->keterangan }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="vertical-separator d-none d-md-block"></div>

                            <div class="col-12 col-md">

                                @if ($stand->pedagang)
                                    <div class="foto text-center mb-3">
                                        <img src="{{ asset(Storage::url($stand->pedagang->foto)) }}" alt="">
                                    </div>

                                    <table class="ml-md-3 w-100">
                                        <tr>
                                            <td class="w-25">NIK</td>
                                            <td>: {{ $stand->pedagang->nik }}</td>
                                            {!! Form::hidden('nik', $stand->pedagang->nik) !!}
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>: {{ $stand->pedagang->nama }}</td>
                                            {!! Form::hidden('nama', $stand->pedagang->nama) !!}
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>: {{ $stand->pedagang->alamat }}</td>
                                            {!! Form::hidden('alamat', $stand->pedagang->alamat) !!}
                                        </tr>
                                        <tr>
                                            <td>Kota</td>
                                            <td>: {{ $stand->pedagang->kota }}</td>
                                            {!! Form::hidden('kota', $stand->pedagang->kota) !!}
                                        </tr>
                                        <tr>
                                            <td>Telp</td>
                                            <td>: {{ $stand->pedagang->telp }}</td>
                                            {!! Form::hidden('telp', $stand->pedagang->telp) !!}
                                        </tr>
                                        <tr>
                                            <td>Tgl. Lahir</td>
                                            <td>: {{ $stand->pedagang->tgl_lahir->format('d/m/Y') }}</td>
                                            {!! Form::hidden('tgl_lahir', $stand->pedagang->tgl_lahir->format('d/m/Y')) !!}
                                        </tr>
                                    </table>
                                @endif
                            </div>
                        </div>


                        {{-- Form IT --}}
                        <div class="mt-4 hidden" id="formIT">
                            <h4>Form IT</h4>
                            <hr>

                            <div class="row">
                                <div class="col text-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pedagang-radio" type="radio" name="pedagang_baru" id="pedagang_baru" value="1" checked>
                                        <label class="form-check-label" for="pedagang_baru">Pedagang Baru</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pedagang-radio" type="radio" name="pedagang_baru" id="pedagang_lama" value="0" data-target="#formPL">
                                        <label class="form-check-label" for="pedagang_lama">Pedagang Lama</label>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3">
                                <div class="row form-group hidden" id="formPL">
                                    <div class="col col-md-6 offset-md-3">
                                        <select class="form-control select2" name="id_pedagang" id="selectPedagang">
                                            <option value="">-- Pilih Pedagang --</option>
                                            @foreach ($pedagang as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama }} / {{ $p->nik }} / {{ $p->alamat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">

                                        <div class="form-group row">
                                            {!! Form::label('nik_it', 'NIK', ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('nik_it', null, ['class' => 'form-control', 'id' => 'nik_it']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('nama_it', 'Nama', ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('nama_it', null, ['class' => 'form-control', 'id' => 'nama_it']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('alamat_it', 'Alamat', ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('alamat_it', null, ['class' => 'form-control', 'id' => 'alamat_it']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('kota_it', 'Kota', ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('kota_it', null, ['class' => 'form-control', 'id' => 'kota_it']) !!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="form-group row">
                                            {!! Form::label('telp_it', 'Telp', ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::text('telp_it', null, ['class' => 'form-control', 'id' => 'telp_it']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('tgl_lahir_it', 'Tgl. Lahir', ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="input-group col-sm-8">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                {!! Form::text('tgl_lahir_it', null, ['class' => 'form-control tanggal', 'id' => 'tgl_lahir_it']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Foto (Maks. 1 MB)</label>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="col">
                                                        <img id="previewFoto" style="display: none; width: auto; height: 180px; margin-bottom: 16px;">
                                                    </div>
                                                </div>
                                                <div class="custom-file">
                                                    {!! Form::file('foto_it', ['class' => 'custom-file-input', 'id' => 'uploadFoto']) !!}
                                                    {!! Form::label('foto_it', 'Choose File', ['class' => 'custom-file-label']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- End Form IT --}}

                        {{-- Form BN --}}
                        <div class="mt-4 hidden" id="formBN">
                            <h4>Form BN</h4>
                            <hr>

                            <div class="row">
                                <div class="col">

                                    <div class="form-group row">
                                        {!! Form::label('nik_baru', 'NIK Pedagang Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('nik_baru', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('nama_baru', 'Nama Pedagang Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('nama_baru', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('alamat_baru', 'Alamat Pedagang Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('alamat_baru', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('kota_baru', 'Kota Pedagang Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('kota_baru', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-check row">
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" id="cb-denda-bn" value="1">
                                            <label class="form-check-label" for="cb-denda-bn">Denda Balik Nama</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group row">
                                        {!! Form::label('telp_baru', 'Telp Pedagang Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('telp_baru', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('tgl_lahir_baru', 'Tgl. Lahir Pedagang Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="input-group col-sm-8">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            {!! Form::text('tgl_lahir_baru', null, ['class' => 'form-control tanggal']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Foto (Maks. 1 MB)</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col">
                                                    <img id="previewFoto2" style="display: none; width: auto; height: 180px; margin-bottom: 16px;">
                                                </div>
                                            </div>
                                            <div class="custom-file">
                                                {!! Form::file('foto_baru', ['class' => 'custom-file-input', 'id' => 'uploadFoto2']) !!}
                                                {!! Form::label('foto_baru', 'Choose File', ['class' => 'custom-file-label']) !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- End Form BN --}}

                        {{-- Form Her --}}
                        <div class="mt-4 hidden" id="formHer">
                            <h4>Form Her</h4>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        {!! Form::label('periode_her', 'Periode', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('periode_her',  null, ['class' => 'form-control', 'list' => 'periode']) !!}

                                            <datalist id="periode">
                                                <option value="0">
                                                <option value="1">
                                                <option value="2">
                                                <option value="3">
                                                <option value="4">
                                                <option value="5">
                                                <option value="6">
                                                <option value="7">
                                                <option value="8">
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('periode_denda_her', 'Periode Denda', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('periode_denda_her',  null, ['class' => 'form-control', 'list' => 'periode_denda']) !!}

                                            <datalist id="periode_denda">
                                                <option value="0">
                                                <option value="1">
                                                <option value="2">
                                                <option value="3">
                                                <option value="4">
                                                <option value="5">
                                                <option value="6">
                                                <option value="7">
                                                <option value="8">
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">

                                </div>
                            </div>

                        </div>
                        {{-- End Form Her --}}

                        {{-- Form SIJ --}}
                        <div class="mt-4 hidden" id="formSIJ">
                            <h4>Form SIJ</h4>
                            <hr>

                            <div class="row">
                                <div class="col">

                                    <div class="form-group row">
                                        {!! Form::label('id_jenis_jualan_lama', 'Jenis Jualan Lama', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('id_jenis_jualan_lama', $jenis_jualan, $stand->id_jenis_jualan, ['class' => 'form-control select2', 'placeholder' => '-- Jenis Jualan --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-check row">
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" id="cb-denda-sij" value="1">
                                            <label class="form-check-label" for="cb-denda-sij">Denda SIJ</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group row">
                                        {!! Form::label('id_jenis_jualan_baru', 'Jenis Jualan Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('id_jenis_jualan_baru', $jenis_jualan, null, ['class' => 'form-control select2', 'placeholder' => '-- Jenis Jualan --']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- End Form SIJ--}}

                        {{-- End Form SIB --}}
                        <div class="mt-4 hidden" id="formSIB">
                            <h4>Form SIB</h4>
                            <hr>

                            <div class="row">
                                <div class="col">

                                    <div class="form-group row">
                                        {!! Form::label('id_bentuk_stand_lama', 'Bentuk Stand Lama', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('id_bentuk_stand_lama', $bentuk_stand, $stand->id_bentuk_stand, ['class' => 'form-control', 'placeholder' => '-- Bentuk Stand --']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-check row">
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" id="cb-denda-sib" value="1">
                                            <label class="form-check-label" for="cb-denda-sib">Denda SIB</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group row">
                                        {!! Form::label('id_bentuk_stand_baru', 'Bentuk Stand Baru', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('id_bentuk_stand_baru', $bentuk_stand, null, ['class' => 'form-control', 'placeholder' => '-- Bentuk Stand --']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- End Form SIB --}}

                        {{-- Form IPS --}}
                        <div class="mt-4 hidden" id="formIPS">
                            <h4>Form IPS</h4>
                            <hr>

                        </div>
                        {{-- End Form IPS --}}

                        {{-- Form Ganti Buku --}}
                        <div class="mt-4 hidden" id="formGantiBuku">
                            <h4>Form Ganti Buku</h4>
                            <hr>

                        </div>
                        {{-- End Form Ganti Buku --}}

                        {{-- Form Biaya --}}
                        <input type="hidden" name="biaya" id="biaya">
                        <input type="hidden" name="biaya_detail" id="biaya_detail">
                        <input type="hidden" name="biaya_it" id="biaya_it">
                        <input type="hidden" name="biaya_detail_it" id="biaya_detail_it">
                        <input type="hidden" name="biaya_bn" id="biaya_bn">
                        <input type="hidden" name="biaya_detail_bn" id="biaya_detail_bn">
                        <input type="hidden" name="biaya_her" id="biaya_her">
                        <input type="hidden" name="biaya_detail_her" id="biaya_detail_her">
                        <input type="hidden" name="biaya_sij" id="biaya_sij">
                        <input type="hidden" name="biaya_detail_sij" id="biaya_detail_sij">
                        <input type="hidden" name="biaya_sib" id="biaya_sib">
                        <input type="hidden" name="biaya_detail_sib" id="biaya_detail_sib">
                        <input type="hidden" name="biaya_ips" id="biaya_ips">
                        <input type="hidden" name="biaya_detail_ips" id="biaya_detail_ips">
                        <input type="hidden" name="biaya_ganti_buku" id="biaya_ganti_buku">
                        <input type="hidden" name="biaya_detail_ganti_buku" id="biaya_detail_ganti_buku">
                        {{-- End Form Biaya --}}

                        <div class="mt-4 formall hidden">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-3 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => '4']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <h4>Biaya</h4>
                            <hr>
                            <button type="button" class="btn btn-outline-info btn-flat" 
                            onclick="getBiaya(@if ($stand->luas) {{ $stand->luas }} @else 0 @endif, {{ Auth::user()->pasar->kelas->id }}, {{ $stand->bentuk_stand->id }}, @if ($stand->jenis_jualan) {{ $stand->jenis_jualan->kelompok_jualan->id }} @else 0 @endif, @if ($stand->lantai) {{ $stand->lantai->id }} @else 0 @endif)">Hitung Biaya</button>

                            <div class="row mt-3">
                                <div class="col">

                                    <table width="50%" id="biaya_table"></table>

                                </div>
                            </div>
                        </div>

                        <div class="row formall mt-5 mb-3 hidden">
                            <div class="col">
                                {!! Form::submit(null, ['class' => 'btn btn-primary btn-flat']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection