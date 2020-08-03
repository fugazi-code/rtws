<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#pablo" style="max-width: 100px;">Rizal Two Wheels Delivery Service</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            {{--            <form>--}}
            {{--                <div class="input-group no-border">--}}
            {{--                    <input type="text" value="" class="form-control" placeholder="Search...">--}}
            {{--                    <div class="input-group-append">--}}
            {{--                        <div class="input-group-text">--}}
            {{--                            <i class="now-ui-icons ui-1_zoom-bold"></i>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </form>--}}
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Some Actions</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Change Password</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<!-- Modal -->
<form method="POST" action="{{ route('profile.change.pass') }}">
    @csrf
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label>Current Password</label>
                            <input type="password" name="password_current" class="form-control">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-round btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>
