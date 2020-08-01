<div class="sidebar" data-color="blue">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            RTWS
        </a>
        <a href="#" class="simple-text logo-normal" style="font-size: 11px;">
            Rizal Two Wheels Service
        </a>
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
                <li class="{{ $page_name != 'Post to Deliver'?: 'active' }}">
                    <a href="{{ route('posting') }}">
                        <i class="now-ui-icons shopping_box"></i>
                        <p>Post to Deliver</p>
                    </a>
                </li>
                <li class="{{ $page_name != 'My Orders'?: 'active' }}">
                    <a href="{{ route('orders') }}">
                        <i class="now-ui-icons shopping_basket"></i>
                        <p>My Orders</p>
                    </a>
                </li>
            @endcan
            @canany(['rider','admin'])
                <li class="{{ $page_name != 'Posted Orders'?: 'active' }}">
                    <a href="{{ route('posted') }}">
                        <i class="now-ui-icons ui-1_bell-53"></i>
                        <p>Posted Orders</p>
                    </a>
                </li>
                <li class="{{ $page_name != 'Confirmed Order'?: 'active' }}">
                    <a href="{{ route('index') }}">
                        <i class="now-ui-icons ui-1_check"></i>
                        <p>Confirmed Orders</p>
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
        </ul>
    </div>
</div>
