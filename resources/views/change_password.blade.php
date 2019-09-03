@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header"></div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>
                    <i class="fa fa-cogs"></i> Ganti Password
                </h2>

                <hr>
                
                <div class="row">
                    <div class="col-8 offset-2">

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
        
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
        
                        @if(Session::has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('changepasswordact') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-9 offset-3">
                                    <button type="submit" class="btn btn-primary btn-flat">Ganti Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
