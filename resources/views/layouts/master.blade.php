<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', '')  }}</title>

    {{--<link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @yield('css')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle"></i>
                    <span class="badge badge-warning navbar-badge"></span> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item">{{ Auth::user()->name }}</span>
                    <a class="dropdown-item" href="{{ route('changepassword') }}"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Ganti Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href=""
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="" class="brand-link" style="margin-left:-10px">
            <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', '')  }}" class="brand-image"
                 style="opacity: .8">
            <span class="brand-text font-weight-light"><strong>{{ config('app.name', '')  }}</strong></span>
        </a>

        <div class="sidebar">

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('proses') }}" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Proses Perizinan</p>
                        </a>
                    </li>

                    @can('laporan-read')
                    <li class="nav-item">
                        <a href="{{ route('laporan') }}" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Laporan Bulanan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('export.data') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-export"></i>
                            <p>Export Data</p>
                        </a>
                    </li>
                    @endcan

                    @can('stand-read')
                    <li class="nav-item">
                        <a href="{{ route('stand') }}" class="nav-link">
                            <i class="nav-icon fas fa-store"></i>
                            <p>Kelola Stand</p>
                        </a>
                    </li>
                    @endcan

                    @can('pasar-read')
                    <li class="nav-item">
                        <a href="{{ route('pasar') }}" class="nav-link">
                            <i class="nav-icon fa fa-industry"></i>
                            <p>Kelola Pasar</p>
                        </a>
                    </li>
                    @endcan

                    @can('tarif-read')
                    <li class="nav-item">
                        <a href="{{ route('tarif') }}" class="nav-link">
                            <i class="nav-icon fa fa-dollar-sign"></i>
                            <p>Kelola Tarif</p>
                        </a>
                    </li>
                    @endcan

                    @can('user-read')
                    <li class="nav-item">
                        <a href="{{ route('user') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Kelola User</p>
                        </a>
                    </li>
                    @endcan

                </ul>
            </nav>
        </div>
    </aside>

    @yield('content')



    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline"></div>
        &copy; PD Pasar Surya 2018
    </footer>
</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>--}}
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<!-- REQUIRED SCRIPTS -->
<script>
    $(document).ready(function () {
        $('.nav-link').each(function () {
            if ($(this).attr('href') == window.location.href) {
                $(this).addClass('active');
            }
        })
    })
</script>

@yield('js')

</body>
</html>