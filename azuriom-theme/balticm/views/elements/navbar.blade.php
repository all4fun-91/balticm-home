<style>
@media (min-width: 901px) {
    .bm-top {
        position: relative;
    }

    .bm-nav {
        position: static;
    }

    .bm-navlinks {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;
    }
}
</style>

<nav class="bm-top">
    <div class="bm-wrap bm-nav">
        <a class="bm-brand" href="{{ route('home') }}">
            <span class="bm-mark">BM</span>
            <span class="bm-brand-text"><b>BALTICM</b><small>PLAY TOGETHER</small></span>
        </a>

        <button class="bm-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bm-navbar" aria-controls="bm-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span></span><span></span><span></span>
        </button>

        <div class="collapse bm-collapse" id="bm-navbar">
            <div class="bm-navlinks">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/forum') }}">Forum</a>
                <a href="{{ url('/servers') }}">Servers</a>
                <a href="{{ url('/online') }}">Online</a>
                <a href="{{ url('/statistics') }}">Statistics</a>
                <a href="{{ url('/about') }}">About</a>
            </div>

            <div class="bm-nav-right">
                <a class="bm-icon-btn" href="#" aria-label="Messages" title="Messages"><i class="bi bi-chat-square-text"></i></a>
                <a class="bm-icon-btn" href="#" aria-label="Search" title="Search"><i class="bi bi-search"></i></a>
                <a class="bm-icon-btn" href="#" aria-label="Notifications" title="Notifications"><i class="bi bi-bell"></i></a>
                @auth
                    <div class="dropdown">
                        <button class="bm-login bm-user-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">{{ Auth::user()->name }}</button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">{{ trans('messages.nav.profile') }}</a>
                            @foreach(plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                                <a class="dropdown-item" href="{{ route($navItem['route']) }}">{{ trans($navItem['name']) }}</a>
                            @endforeach
                            @if(Auth::user()->hasAdminAccess())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ trans('messages.nav.admin') }}</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('bm-logout').submit();">{{ trans('auth.logout') }}</a>
                        </div>
                    </div>
                    <form id="bm-logout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a class="bm-login" href="{{ route('login') }}"><i class="bi bi-person"></i> LOGIN</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
