<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        RTWS
    </title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="/template/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/template/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet"/>
    <link href="/css/main.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>

    @yield('css')
</head>

@isset($page_name)
    <body class="">
    <div class="wrapper">
        @include('layouts.partials.sidebar')

        <div class="main-panel" id="main-panel">
            @include('layouts.partials.topbar')
            <div class="panel-header panel-header-sm">
            </div>
            @yield('content')
        </div>
    </div>
    @else
        <body style="background-image: url('/img/login-bg.jpeg'); background-size: cover; background-repeat: no-repeat ">
        <div class="wrapper">
            @yield('content')
        </div>
        </body>
    @endisset
    <!--   Core JS Files   -->
    <script src="/template/assets/js/core/jquery.min.js"></script>
    <script src="/template/assets/js/core/popper.min.js"></script>
    <script src="/template/assets/js/core/bootstrap.min.js"></script>
    <script src="/template/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/template/assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
    @include('layouts.partials.notification')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    @yield('scripts')
    </body>

</html>
