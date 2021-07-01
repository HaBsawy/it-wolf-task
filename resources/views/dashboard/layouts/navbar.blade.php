<nav class="pcoded-navbar" pcoded-header-position="relative">
    <div class="pcoded-inner-navbar">
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{ route('index') }}">
                    <span class="pcoded-micon"><i class="ti-home" aria-hidden="true"></i></span>
                    <span class="pcoded-mtext">Home</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            @if(auth('admin')->check())
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-pencil-alt" aria-hidden="true"></i></span>
                    <span class="pcoded-mtext">Bloggers</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('bloggers.create') }}" data-i18n="nav.form-pickers.main">
                            <span class="pcoded-micon"><i class="ti-pencil-alt"></i></span>
                            <span class="pcoded-mtext">Create</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('bloggers.index') }}" data-i18n="nav.form-pickers.main">
                            <span class="pcoded-micon"><i class="ti-pencil-alt"></i></span>
                            <span class="pcoded-mtext">View</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth('admin')->check() || auth('blogger')->check())
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-comments" aria-hidden="true"></i></span>
                    <span class="pcoded-mtext">Posts</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    @if(auth('blogger')->check())
                    <li class=" ">
                        <a href="{{ route('posts.create') }}" data-i18n="nav.form-pickers.main">
                            <span class="pcoded-micon"><i class="ti-pencil-alt"></i></span>
                            <span class="pcoded-mtext">Create</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    @endif
                    <li class=" ">
                        <a href="{{ route('posts.index') }}" data-i18n="nav.form-pickers.main">
                            <span class="pcoded-micon"><i class="ti-pencil-alt"></i></span>
                            <span class="pcoded-mtext">View</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>
