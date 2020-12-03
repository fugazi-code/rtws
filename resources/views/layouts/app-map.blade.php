<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no'
          name='viewport'/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        {{ env('APP_NAME') }}
    </title>

    <!-- CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- CDN LEAFLET CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.css" rel="stylesheet" type="text/css"/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    @yield('css')
    <style>
        .btn {
            border-radius: 0 !important;
        }
    </style>
</head>
<body>
@yield('content')

<!-- leaflet 0.7 -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.7/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@0.7.7/dist/leaflet.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQQkfIgi0W3SJX7KQddC6_k8L7ihvWaUI&libraries=places"></script>
<!--   Core JS Files   -->
<script src="{{ asset('js/map.js') }}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
@include('layouts.partials.notification')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function showPage() {
        document.getElementById("map").style.display = "none";
        document.getElementById("map").style.display = "block";
    }
</script>
@yield('scripts')
</body>

</html>
