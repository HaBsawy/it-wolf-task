<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="index.html">
                <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" alt="Theme-Logo" />
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <div>
                <ul class="nav-right">
                    <li class="user-profile header-notification">
                        @if(auth('admin')->check())
                            <a href="{{ route('admin.logout') }}" id="logout-link">Logout</a>
                            <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">@csrf</form>
                        @elseif(auth('blogger')->check())
                            <a href="{{ route('blogger.logout') }}" id="logout-link">Logout</a>
                            <form action="{{ route('blogger.logout') }}" method="POST" id="logout-form">@csrf</form>
                        @else
                            <a href="{{ route('blogger.login') }}">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
