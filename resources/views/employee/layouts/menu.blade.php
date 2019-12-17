<div class="navbar-custom-menu" style="background:#26b1b0;">

        <ul class="nav navbar-nav">
            <li>
                @if(Auth::guard('employee')->check())
                    <a href="{{route('logoutEmployee')}}">Logout</a>
                    @else
                    <a href="{{route('showEmployeeLoginForm')}}">login</a>
                @endif

            </li>
        </ul>

</div>
