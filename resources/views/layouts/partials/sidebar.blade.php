<div class="sidebar" data-color="blue">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            RTWS
        </a>
{{--        <a href="#" class="simple-text logo-normal" style="font-size: 9px;">--}}
{{--            Rizal Two Wheels Delivery Service--}}
{{--        </a>--}}
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $page_name != 'My Profile'?: 'active' }}">
                <a href="{{ route('index') }}">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>My Profile</p>
                </a>
            </li>
            @canany(['customer','admin'])
                <li class="{{ $page_name != 'Book Now'?: 'active' }}">
                    <a href="{{ route('booking') }}">
                        <i class="now-ui-icons shopping_box"></i>
                        <p>Book Now</p>
                    </a>
                </li>
                <li class="{{ $page_name != 'Book History'?: 'active' }}">
                    <a href="{{ '#' }}">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Book History</p>
                    </a>
                </li>
                <li class="{{ $page_name != 'Manage Drivers'?: 'active' }}">
                    <a href="{{ route('manage.driver') }}">
                        <i class="now-ui-icons shopping_delivery-fast"></i>
                        <p>Manage Drivers</p>
                    </a>
                </li>
                <li class="{{ $page_name != 'Wallet'?: 'active' }}">
                    <a href="{{ '#' }}">
                        <i class="now-ui-icons shopping_credit-card"></i>
                        <p>Wallet</p>
                    </a>
                </li>
            @endcan
            @canany(['rider','admin'])

                <li class="{{ $page_name != 'Delivery'?: 'active' }}">
                    <a href="{{ route('delivery') }}">
                        <i class="now-ui-icons sport_user-run"></i>
                        <p>Delivery</p>
                    </a>
                </li>
            @endcan
            @canany(['admin'])
                <li class="{{ $page_name != 'User Accounts'?: 'active' }}">
                    <a href="{{ route('accounts') }}">
                        <i class="now-ui-icons users_circle-08"></i>
                        <p>User Accounts</p>
                    </a>
                </li>
            @endcan
            <li class="{{ $page_name != 'News'?: 'active' }}">
                <a href="{{ '#' }}">
                    <i class="now-ui-icons files_paper"></i>
                    <p>News</p>
                </a>
            </li>
            <li class="{{ $page_name != 'Settings'?: 'active' }}">
                <a href="{{ route('settings') }}">
                    <i class="now-ui-icons loader_gear"></i>
                    <p>Settings</p>
                </a>
            </li>
        </ul>
    </div>
</div>
