<!DOCTYPE html>
<html lang="en">
<!-- Begin Head -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    Document Title
    =============================================
    -->
    <title>@yield('title') | PD Pasar Surya</title>
@section('styles')
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="template/images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/fonts/iconic/css/material-design-iconic-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="template/css/util.css">
        <link rel="stylesheet" type="text/css" href="template/css/main.css">
        <link rel="stylesheet" type="text/css" href="css/pasarsurya.css">
        <!--===============================================================================================-->    @show
</head>
<!-- End Head -->

<!-- Body -->
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
{{--@include('includes.header')--}}

@yield('content')

<!--========== END PAGE CONTENT ==========-->
{{--@include('includes.footer')--}}


@section('scripts')
    <!--===============================================================================================-->
    <script src="template/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/vendor/bootstrap/js/popper.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/vendor/daterangepicker/moment.min.js"></script>
    <script src="template/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="template/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="template/js/main.js"></script>

@show

</body>
<!-- End Body -->
</html>
