<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('panel/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('panel/dist/css/adminlte.min.css') }}">
    <!--link rel="stylesheet" href="{{ asset('panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"-->
    <link href="{{ asset('assets/img/ico.png')}}" rel="icon">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.includes.mainmenu')
        @yield('paneladmin')
        @include('admin.includes.footer')
    </div>

    <script src="{{ asset('panel/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('panel/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('panel/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('[data-mask').inputmask()
        });
    </script>

</body>
</html>
