@extends('layouts.app')

@section('css')
    <link href="/css/main.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card login-form">
                    <div class="card-header text-dark">{{ __('Rider Registration') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.rider') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <label>E-mail</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Contact No.</label>
                                    <input type="text" name="contact" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Birth Date</label>
                                    <input type="date" name="birth_date" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Country</label>
                                    <input type="text" name="country" value="Philippines" class="form-control" readonly>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label>Profile Picture</label>
                                    <input type="file" name="selfie_photo" style="max-width: 100%;">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label>license Plate</label>
                                    <input type="file" name="license_plate" style="max-width: 100%;">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label>OR/CR</label>
                                    <input type="file" name="or_cr" style="max-width: 100%;">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label>Front of Vehicle</label>
                                    <input type="file" name="front" style="max-width: 100%;">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label>Side of Vehicle</label>
                                    <input type="file" name="side" style="max-width: 100%;">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label>Back of Vehicle</label>
                                    <input type="file" name="back" style="max-width: 100%;">
                                </div>
                                <div class="col-md-7 mt-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input name="certify" class="form-check-input" type="checkbox">
                                            I have certified above information is right.
                                            <span class="form-check-sign">
                                                  <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <div class="col">
                                    <button class="btn btn-block btn-round btn-success">Register now</button>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <div class="col">
                                    <a href="{{ route('login') }}" class="btn btn-block btn-round btn-primary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
