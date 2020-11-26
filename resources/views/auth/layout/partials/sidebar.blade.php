<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            BROOM EXPRESS
        </div>
        <div class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            BEX
        </div>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-user-circle"></i>
                </div> Profile
{{--                <span class="badge badge-info">NEW</span>--}}
            </a>
            <a class="c-sidebar-nav-link" href="{{ route('book') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-book-open"></i>
                </div> Book Now
            </a>
            <a class="c-sidebar-nav-link" href="index.html">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-history"></i>
                </div> My History
            </a>
            <a class="c-sidebar-nav-link" href="{{ route('request.status') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-bookmark"></i>
                </div> Booking Status
            </a>
            <a class="c-sidebar-nav-link" href="index.html">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-book-reader"></i>
                </div> Look For Bookings
            </a>
            <a class="c-sidebar-nav-link" href="index.html">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-wallet"></i>
                </div> My Wallet
            </a>
            <a class="c-sidebar-nav-link" href="{{ route('accounts') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-user-shield"></i>
                </div> User Accounts
            </a>
            <a class="c-sidebar-nav-link" href="index.html">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-cog"></i>
                </div> Settings
            </a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
