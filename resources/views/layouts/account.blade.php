<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Coliseum Accounts</title>
    <meta name="author" content="Abuzar Mughal">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/vendors/css/forms/icheck/custom.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/css/app.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/css/core/menu/menu-types/horizontal-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/css/pages/login-register.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('account') }}/style.css">

</head>
<body>
<script src="{{ asset('account') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script type="text/javascript" src="{{ asset('account') }}/vendors/js/ui/jquery.sticky.js"></script>
<script type="text/javascript" src="{{ asset('account') }}/vendors/js/charts/jquery.sparkline.min.js"></script>
<script src="{{ asset('account') }}/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="{{ asset('account') }}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN STACK JS-->
<script src="{{ asset('account') }}/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{ asset('account') }}/js/core/app.min.js" type="text/javascript"></script>
<script src="{{ asset('account') }}/js/scripts/customizer.min.js" type="text/javascript"></script>
<!-- END STACK JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script type="text/javascript" src="{{ asset('account') }}/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
<script src="{{ asset('account') }}/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

@yield('content')

</body>
</html>
