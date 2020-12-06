@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-6">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('profile.change.pass') }}">
                                @csrf
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="password_current" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-block btn-square btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
