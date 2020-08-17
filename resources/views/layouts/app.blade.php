<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no' name='viewport'/>
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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="/template/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/template/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet"/>
    <link href="/css/main.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    @yield('css')
    <style>
        /* Center the loader */
        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }
            to {
                bottom: 0px;
                opacity: 1
            }
        }

        @keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }
            to {
                bottom: 0;
                opacity: 1
            }
        }

        #myDiv {
            display: none;
            /*text-align: center;*/
        }
    </style>
</head>

@isset($page_name)
    <body onload="myFunction()" style="margin:0;">
    <div id="loader"></div>
    <div class="wrapper animate-bottom" style="display:none;" id="myDiv">
        @include('layouts.partials.sidebar')

        <div class="main-panel" id="main-panel">
            @include('layouts.partials.topbar')
            <div class="panel-header panel-header-sm">
            </div>
            @yield('content')
        </div>
    </div>
    @else
        <body style="background-image: url('/img/login-bg.jpeg'); background-size: cover; background-repeat: no-repeat">
        <div class="wrapper">
            @yield('content')
        </div>
        @endisset
        <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.7.min.js"></script>
        <!--   Core JS Files   -->
        <script src="{{ asset('js/app.js') }}"></script>
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
            var myVar;

            function myFunction() {
                myVar = setTimeout(showPage, 1000);
            }

            function showPage() {
                document.getElementById("loader").style.display = "none";
                document.getElementById("myDiv").style.display = "block";
            }
        </script>

        @yield('scripts')
        </body>

</html>
