@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h2>
                                <i class="fa fa-file-export"></i> Export Data
                            </h2>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col text-center">
                            @foreach ($cabangs as $cabang)
                            <a href="{{ route('export.data', ['cabang' => $cabang->id]) }}" class="btn btn-primary">{{ $cabang->nama }}</a>                                
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection