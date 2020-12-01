@extends('auth.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Photo-->
                        <div class="col-md-4 col-12">
                            <div class="row justify-content-center">
                                <div class="col-md-auto col-auto">
                                    @if(\App\Gallery::myProfilePic()->count())
                                        <img class="c-avatar-img avatar border-gray"
                                             src="/storage/{{ \App\Gallery::myProfilePic()[0]->path }}" alt="...">
                                    @else
                                        <img class="c-avatar-img avatar border-gray" src="https://picsum.photos/200" alt="...">
                                    @endif
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-auto col-auto mt-3">
                                    <h5>{{ auth()->user()->name }}</h5>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-auto col-auto">
                                    {{ auth()->user()->email }}
                                </div>
                                <div class="col-md-auto col-auto">
                                    {{ auth()->user()->contact }}
                                </div>
                                <div class="col-md-auto col-auto">
                                    <form method="POST" action="{{ route('profile.pic.upload') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 mt-2 col-8">
                                        <span class="btn-raised">
                                            <span class="fileinput-new"></span>
                                            <input type="file" name="profile-pic" style="max-width: 100%;">
                                        </span>
                                            </div>
                                            <div class="col-md-auto mt-2 col-auto">
                                                <button type="submit" class="btn btn-info btn-round fileinput-exists"
                                                        data-dismiss="fileinput"> Upload Pic
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- User Information-->
                        <div class="col-md-8 col-auto">
                            <form method="POST" action="{{ route('p.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Username"
                                                   value="{{ auth()->user()->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" placeholder="Email"
                                                   value="{{ auth()->user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Primary No.</label>
                                            <input type="text" class="form-control" placeholder="Phone Number"
                                                   value="{{ auth()->user()->contact }}" readonly>
                                        </div>
                                    </div>
                                    @canany(['rider', 'superadmin'])
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">License No</label>
                                                <input type="email" class="form-control" placeholder="License No."
                                                       value="{{ auth()->user()->license_no }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Plate No</label>
                                                <input type="email" class="form-control" placeholder="Plate No."
                                                       value="{{ auth()->user()->plate_no }}" readonly>
                                            </div>
                                        </div>
                                    @endcanany
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="Home Address"
                                                   name="address"
                                                   value="{{ auth()->user()->address }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" placeholder="Country"
                                                   name="country"
                                                   value="{{ auth()->user()->country }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" placeholder="ZIP Code"
                                                   name="postal_code"
                                                   value="{{ auth()->user()->postal_code }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="date" class="form-control" placeholder="Birth Date"
                                                   name="birth_date"
                                                   value="{{ auth()->user()->birth_date }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-auto">
                                        <button type="submit" class="btn btn-sm btn-round text-white btn-success">Update
                                            Profile
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
