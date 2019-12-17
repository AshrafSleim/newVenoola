<div class="navbar-custom-menu" style="background:#26b1b0;">

        <ul class="nav navbar-nav">
            <li>
                @if(Auth::guard('vendor')->check())
                    <a href="{{route('logoutVendor')}}">Logout</a>
                    @else
                    <a href="{{route('showVendorLoginForm')}}">login</a>
                @endif

            </li>
        </ul>

</div>
