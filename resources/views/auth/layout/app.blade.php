<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/broom-logo.png') }}">
    <link rel="manifest" href="{{ asset('theme/coreui/src/assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('theme/coreui/src/assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link href="{{ asset('vendor/lightgallery/dist/css/lightgallery.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ asset('theme/coreui/src/scss/style.scss') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="c-app">
@include('auth.layout.partials.sidebar')
<div class="c-wrapper c-fixed-components">
    @include('auth.layout.partials.header')
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="c-footer">
            <div><a href="#">Broom Express</a> &copy; 2020</div>
            <div class="ml-auto">Powered by Yaramay</div>
        </footer>
    </div>
</div>
@include('auth.layout.partials.notification')
<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.7.min.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="{{ asset('vendor/lightgallery/dist/js/lightgallery-all.min.js') }}"></script>
<script src="{{ asset('vendor/lightgallery/lib/jquery.mousewheel.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        // Verifying technology support
        if (window.webkitNotifications) {
            console.log('Your browser supports Notifications');
        } else {
            console.log('Your browser doesn\'t support Notifications =(');
        }

        Echo.channel('top-up-request')
            .listen('TopUpRequestEvent', (e) => {
                console.log(e.topup_pending_count);
                $( ".countp" ).html(e.topup_pending_count);
            });
    });
</script>
@yield('script')
</body>
</html>
