@extends('layouts.main')

@section('title', 'Selamat Datang')

@section('styles')
    @parent
@endsection

@section('content')
    <body>
    <div class="container-login100" style="background-image: url('template/images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-40 p-b-30">
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                @csrf
                <span class="login100-form-title p-b-37">
					Masuk
				</span>

                <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
                    <input class="input100" type="text" name="username" placeholder="username" autofocus autocomplete="false">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-25" data-validate="Enter password">
                    <input id="password" class="input100" type="password" name="password" placeholder="password" required>
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="dropDownSelect1"></div>
@endsection

@section('scripts')
    @parent
@endsection