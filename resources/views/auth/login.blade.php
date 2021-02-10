@extends('layouts.app')

@section('css')
    <link href="/css/main.css" rel="stylesheet"/>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 mt-5">
                <img src="/img/login-logo.svg">
            </div>
            <div class="col-md-12">
            </div>
            <div class="col-md-8">
                <div class="card login-form mt-5">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col align-self-start">
                                    <div class="form-group form-check mb-0 mt-2 font-sm">
                                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-auto align-self-end p-0">
                                    <a class="btn btn-link font-sm" href="{{ route('register') }}">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-block btn-primary"
                                            style="background-color: #6610f2;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        Don't have an Account?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            </div>
            {{--            <div id="btn-dl" class="col-md-auto col-xs-12">--}}
            {{--                <a href="{{ asset('apk/broomexp.apk') }}" class="btn btn-block btn-lg bg-green">--}}
            {{--                    <i class="fab fa-android"></i>--}}
            {{--                    Download our App for Android--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
