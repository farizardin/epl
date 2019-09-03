@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <style>
        .column-option {
            display: inline-block;
            text-align: center;
        }

        .column-option label {
            margin-right: 15px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('.tanggal').datepicker({
                format: "mm-yyyy",
                startView: "months",
                minViewMode: "months"
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
        });
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
                            <h2>
                                <i class="fa fa-chart-line"></i> Laporan Bulanan | {{ App\Helper::getBulan($bulan) }} {{ $tahun }}
                            </h2>
                        </div>

                        <div class="col-4">
                            {!! Form::open(['route' => 'laporan', 'method' => 'GET', 'autocomplete' => 'off']) !!}
                            <div class="form-group row">
                                {{--{!! Form::selectMonth('m', \Illuminate\Support\Facades\Input::get('m'), ['class' => 'form-control', 'placeholder' => '-- PILIH BULAN --', 'onchange' => 'this.form.submit()']) !!}--}}
                                {!! Form::label('m', 'Pilih Bulan', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="input-group col-sm-8">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    {!! Form::text('m', \Illuminate\Support\Facades\Input::get('m'), ['class' => 'form-control tanggal', 'placeholder' => 'Pilih Bulan', 'onchange' => 'this.form.submit()']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col">
                            <button class="btn btn-outline-info float-right"  data-toggle="modal" data-target="#exportModal">Export ke Excel</button>
                        </div>
                    </div>

                    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exportLabel">Export ke Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {!! Form::open(['route' => 'laporan.export']) !!}
                                <div class="modal-body">

                                    {!! Form::hidden('m', \Illuminate\Support\Facades\Input::get('m'), []) !!}
                                    <div class="column-option">
                                        <label>{!! Form::checkbox('column[]', '1', null, []) !!} Nama Pasar</label>
                                        <label>{!! Form::checkbox('column[]', '2', null, []) !!} Alamat</label>
                                        <label>{!! Form::checkbox('column[]', '3', null, []) !!} Cabang</label>
                                        <label>{!! Form::checkbox('column[]', '4', null, []) !!} Kelas Pasar</label>
                                        <label>{!! Form::checkbox('column[]', '5', null, []) !!} No. Stand</label>
                                        <label>{!! Form::checkbox('column[]', '6', null, []) !!} No. Reg</label>
                                        <label>{!! Form::checkbox('column[]', '7', null, []) !!} No. Rekening</label>
                                        <label>{!! Form::checkbox('column[]', '8', null, []) !!} Bentuk Stand</label>
                                        <label>{!! Form::checkbox('column[]', '9', null, []) !!} Lantai</label>
                                        <label>{!! Form::checkbox('column[]', '10', null, []) !!} Jenis Jualan</label>
                                        <label>{!! Form::checkbox('column[]', '11', null, []) !!} Kelompok Jualan</label>
                                        <label>{!! Form::checkbox('column[]', '12', null, []) !!} Panjang</label>
                                        <label>{!! Form::checkbox('column[]', '13', null, []) !!} Lebar</label>
                                        <label>{!! Form::checkbox('column[]', '14', null, []) !!} Luas</label>
                                        <label>{!! Form::checkbox('column[]', '15', null, []) !!} Daya Listrik</label>
                                        <label>{!! Form::checkbox('column[]', '16', null, []) !!} Air</label>
                                        <label>{!! Form::checkbox('column[]', '17', null, []) !!} Status Stand</label>
                                        <label>{!! Form::checkbox('column[]', '18', null, []) !!} Keterangan Stand</label>
                                        <label>{!! Form::checkbox('column[]', '19', null, []) !!} NIK</label>
                                        <label>{!! Form::checkbox('column[]', '20', null, []) !!} Nama</label>
                                        <label>{!! Form::checkbox('column[]', '21', null, []) !!} Alamat</label>
                                        <label>{!! Form::checkbox('column[]', '22', null, []) !!} Kota</label>
                                        <label>{!! Form::checkbox('column[]', '23', null, []) !!} Telp</label>
                                        <label>{!! Form::checkbox('column[]', '24', null, []) !!} Tgl. Lahir</label>
                                        <label>{!! Form::checkbox('column[]', '28', null, []) !!} No. Buku</label>
                                        <label>{!! Form::checkbox('column[]', '29', null, []) !!} Masa Berlaku Buku</label>
                                        <label>{!! Form::checkbox('column[]', '25', null, []) !!} Proses</label>
                                        <label>{!! Form::checkbox('column[]', '26', null, []) !!} Biaya</label>
                                        <label>{!! Form::checkbox('column[]', '27', null, []) !!} Keterangan Proses</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">

                            <thead>
                            <tr>
                                @foreach($jumlah_transaksi as $j)
                                    <th>{{ $j->nama }}</th>
                                @endforeach
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                @foreach($jumlah_transaksi as $j)
                                    <td>{{ $j->jumlah }}</td>
                                @endforeach
                            </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped table-hover table-indexed">

                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cabang</th>
                                <th>Pasar</th>
                                <th>No. Stand</th>
                                <th>Bentuk Stand</th>
                                <th>Pedagang</th>
                                <th>Jenis Jualan</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($transaksi as $t)
                                <tr>
                                    <td></td>
                                    <td>{{ $t->stand->pasar->cabang->nama }}</td>
                                    <td>{{ $t->stand->pasar->nama }}</td>
                                    <td>{{ $t->stand->no_stand }}</td>
                                    <td>{{ $t->stand->bentuk_stand->nama }}</td>
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ $t->stand->jenis_jualan->nama }}</td>
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