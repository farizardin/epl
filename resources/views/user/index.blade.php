@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                width: '100%'
            });
        })
    </script>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header"></div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>
                    <i class="fa fa-users"></i> Kelola User
                    @can('user-edit')
                    <button class="btn btn-outline-info float-right"  data-toggle="modal" data-target="#addUserModal">Tambah User</button>
                    @endcan
                </h2>

                @can('user-edit')
                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserLabel">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{ Form::open(array('route' => 'user.store')) }}
                            <div class="modal-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label text-sm-right">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label text-sm-right">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label text-sm-right">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label text-sm-right">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {!! Form::label('id_cabang', 'Cabang', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::select('id_cabang', $cabang, null, ['class' => 'form-control', 'placeholder' => '-- Cabang --']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {!! Form::label('id_pasar', 'Pasar', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::select('id_pasar', $pasar, null, ['class' => 'form-control select2', 'placeholder' => '-- Pasar --']) !!}
                                    </div>
                                </div>

                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-3 pt-0 text-sm-right">Peran/Jabatan</legend>
                                        <div class="col-sm-9">
                                            @foreach ($roles as $role)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="roles" id="roles{{ $role->id }}" value="{{ $role->id }}" required>
                                                    <label class="form-check-label" for="roles{{ $role->id }}">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </fieldset>

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
                    <table class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Peran/Jabatan</th>
                            @can('user-edit')<th>Operations</th>@endcan
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }} @if ($user->id == Auth::user()->id) <span class="badge badge-info">Anda</span> @endif </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->roles()->pluck('name')->implode(',') }}</td>
                                @can('user-edit')
                                <td>
                                    <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#editUserModal{{ $user->id }}">Edit</button>

                                    @if ($user->id != Auth::user()->id)
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="if (confirm('Apakah anda yakin?')) document.getElementById('formDelete{{ $user->id }}').submit()">Hapus</button>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id], 'id' => 'formDelete'.$user->id ]) !!}
                                        {!! Form::close() !!}
                                    @endif

                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserLabel{{ $user->id }}">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {{ Form::open(array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
                                                <div class="modal-body">

                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-3 col-form-label text-sm-right">Nama</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ $user->name }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="username" class="col-sm-3 col-form-label text-sm-right">Username</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ $user->username }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        {!! Form::label('id_cabang', 'Cabang', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                        <div class="col-sm-9">
                                                            {!! Form::select('id_cabang', $cabang, $user->id_cabang, ['class' => 'form-control', 'placeholder' => '-- Cabang --']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        {!! Form::label('id_pasar', 'Pasar', ['class' => 'col-sm-3 col-form-label text-sm-right']) !!}
                                                        <div class="col-sm-9">
                                                            {!! Form::select('id_pasar', $pasar, $user->id_pasar, ['class' => 'form-control select2', 'placeholder' => '-- Pasar --']) !!}
                                                        </div>
                                                    </div>

                                                    <fieldset class="form-group">
                                                        <div class="row">
                                                            <legend class="col-form-label col-sm-3 pt-0 text-sm-right">Peran/Jabatan</legend>
                                                            <div class="col-sm-9">
                                                                @foreach ($roles as $role)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="roles" id="roles{{ $user->id }}{{ $role->id }}" value="{{ $role->id }}" {{ $role->id == $user->roles()->pluck('id')->first() ? 'checked' : '' }} required>
                                                                        <label class="form-check-label" for="roles{{ $user->id }}{{ $role->id }}">
                                                                            {{ $role->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </fieldset>

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