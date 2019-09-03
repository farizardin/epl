@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        <i class="fa fa-users"></i> Kelola Peran
                    </h2>

                    <hr>
                    @include('flash::message')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">

                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#editRoleModal{{ $role->id }}">Edit</button>

                                        <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel{{ $role->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editRoleLabel{{ $role->id }}">Edit Role</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{ Form::open(['route' => ['role.update', $role->id], 'method' => 'PUT']) }}
                                                    <div class="modal-body">

                                                        @foreach($permissions as $permission)
                                                            <label>{{ Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? true : false, []) }}
                                                                {{ $permission->name }}</label>
                                                            <br/>
                                                        @endforeach

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