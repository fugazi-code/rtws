@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">My Profile</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Username"
                                               value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-5 pl-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" placeholder="Email"
                                               value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-2 pl-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Role</label>
                                        <input type="text" class="form-control" placeholder="Email"
                                               value="{{ auth()->user()->role }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Home Address"
                                               value="{{ auth()->user()->address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" placeholder="Country"
                                               value="{{ auth()->user()->country }}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" class="form-control" placeholder="ZIP Code"
                                               value="{{ auth()->user()->postal_code }}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Primary No.</label>
                                        <input type="text" class="form-control" placeholder="ZIP Code"
                                               value="{{ auth()->user()->contact }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-sm btn-round text-white btn-success">Update Profile</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="/img/bg5.jpg" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="/img/mike.jpg" alt="...">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                <div class="row">
                                    <div class="col-md-8 mt-3">
                                        <span class="btn-raised">
                                            <span class="fileinput-new"></span>
                                            <input type="file" name="profile-pic" style="max-width: 100%;">
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#pablo" class="btn btn-info btn-round fileinput-exists"
                                           data-dismiss="fileinput"> Upload</a>
                                    </div>
                                </div>
                            </p>
                            <p class="description">
                                {{ auth()->user()->email }} <br>
                                {{ auth()->user()->contact }} <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
