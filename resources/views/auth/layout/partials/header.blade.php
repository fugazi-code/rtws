<header class="c-header c-header-yellow c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <div class="c-icon c-icon-lg">
            <i class="fas fa-bars"></i>
        </div>
    </button>
    <a class="c-header-brand d-lg-none" href="{{ route('p.index') }}">
        <img src="{{ asset('img/broom-logo.png') }}" style="max-width: 150px; height: 30px">
    </a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <div class="c-icon c-icon-lg">
            <i class="fas fa-bars"></i>
        </div>
    </button>
    <ul class="c-header-nav ml-auto mr-1">
        <li class="c-header-nav-item">
            <button id="btn-refresher" class="btn c-header-nav-link" onclick="reloader()">
                <div class="c-icon"><i class="fas fa-sync-alt" style="margin-top: 6px;"></i></div>
            </button>
            <script>
                function reloader() {
                    location.reload();
                    return false;
                }
            </script>
        </li>
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-icon"><i class="fas fa-bell"></i></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>Notifications</strong>
                </div>
                <a class="dropdown-item" href="#">
{{--                    <svg class="c-icon mr-2">--}}
{{--                       --}}
{{--                    </svg> --}}
{{--                    Updates<span class="badge badge-info ml-auto">42</span>--}}
                </a>
            </div>
        </li>
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-icon" style="color: #2cea5f"><small><i class="fas fa-circle"></i></small></div>
                <span class="mt-1"><small>Hi, {{ auth()->user()->name }}</small></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <a class="dropdown-item" href="{{ route('profile.cpass') }}">
                    <div class="c-icon mr-2">
                        <i class="fas fa-user-secret"></i>
                    </div> Change Password
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <div class="c-icon mr-2">
                        <i class="fas fa-unlock"></i>
                    </div> Logout
                </a>
            </div>
        </li>
    </ul>
</header>
