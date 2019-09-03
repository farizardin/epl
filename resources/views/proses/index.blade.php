@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(function() {
            $('.tanggal').datepicker({
                format: "dd/mm/yyyy",
            });
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
                        <i class="fas fa-cogs"></i> Proses Perizinan @if (Auth::user()->hasRole(\App\User::ROLE_KUNIT)) | Pasar {{ title_case(Auth::user()->pasar->nama) }}
                        <a href="{{ route('proses.create') }}" class="btn btn-outline-info float-right">Proses Baru</a>  @endif
                    </h2>

                    <hr>

                    @if (Auth::user()->hasRole(\App\User::ROLE_KPEMASARAN))
                    {!! Form::open(['route' => 'cetak.rekap', 'method' => 'GET', 'autocomplete' => 'off', 'target' => '_blank']) !!}
                        <div class="row">
                            <div class="col-6 offset-3">
                                <div class="input-group mb-3">
                                    {!! Form::text('m', \Illuminate\Support\Facades\Input::get('m'), ['class' => 'form-control tanggal', 'placeholder' => 'Pilih Bulan', 'required']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Cetak Blangko Rekapitulasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    @endif

                    @include('flash::message')

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">

                            <thead>
                            <tr>
                                <td>Tgl. Permohonan</td>
                                <td>No. Stand</td>
                                <td>Proses</td>
                                <td>Status</td>
                                <td>Tgl. Validasi Cabang</td>
                                <td>Tgl. Validasi Pemasaran</td>
                                <td>Tgl. Validasi Direksi</td>
                                <td>Keterangan</td>
                                <td>Action</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($transaksi as $t)
                                <tr>
                                    <td>{{ $t->tgl_permohonan->format('d/m/Y') }}</td>
                                    <td>{{ $t->stand->no_stand }}</td>
                                    <td>{{ implode(' ', $t->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
                                    <td>{{ \App\Transaksi::STATUS[$t->status] }}</td>
                                    <td>{{ $t->tgl_valid_kcabang ? $t->tgl_valid_kcabang->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $t->tgl_valid_kpemasaran ? $t->tgl_valid_kpemasaran->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $t->tgl_valid_direksi ? $t->tgl_valid_direksi->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $t->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('proses.detail', $t->id) }}" class="btn btn-warning btn-sm btn-flat">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @hasanyrole('KA Unit|KA Pemasaran')
            <div class="row mt-4">
                <div class="col">
                    <h2>Proses Perizinan Sukses</h2>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">

                            <thead>
                            <tr>
                                <td>Tgl. Permohonan</td>
                                <td>No. Stand</td>
                                <td>Proses</td>
                                <td>Status</td>
                                <td>Tgl. Validasi Cabang</td>
                                <td>Tgl. Validasi Pemasaran</td>
                                <td>Tgl. Validasi Direksi</td>
                                <td>Keterangan</td>
                                <td>Action</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($transaksi_sukses as $t)
                                <tr>
                                    <td>{{ $t->tgl_permohonan->format('d/m/Y') }}</td>
                                    <td>{{ $t->stand->no_stand }}</td>
                                    <td>{{ implode(' ', $t->proses->pluck('jenis_proses.nama')->toArray()) }}</td>
                                    <td>{{ \App\Transaksi::STATUS[$t->status] }}</td>
                                    <td>{{ $t->tgl_valid_kcabang ? $t->tgl_valid_kcabang->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $t->tgl_valid_kpemasaran ? $t->tgl_valid_kpemasaran->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $t->tgl_valid_direksi ? $t->tgl_valid_direksi->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $t->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('proses.detail', $t->id) }}" class="btn btn-warning btn-sm btn-flat">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection