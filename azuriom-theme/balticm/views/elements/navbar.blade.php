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
                @foreach($navbar as $element)
                    @if(!$element->isDropdown())
                        <a class="@if($element->isCurrent()) active @endif" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $element->name }}</a>
                    @else
                        <div class="bm-dropdown">
                            <button type="button" class="bm-nav-dropdown" data-bs-toggle="dropdown" aria-expanded="false">{{ $element->name }}</button>
                            <div class="dropdown-menu dropdown-menu-dark">
                                @foreach($element->elements as $childElement)
                                    <a class="dropdown-item @if($childElement->isCurrent()) active @endif" href="{{ $childElement->getLink() }}" @if($childElement->new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $childElement->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="bm-nav-right">
                @if($server && $server->isOnline())
                    <a class="bm-server-pill" href="{{ $server->joinUrl() ?: '#' }}">
                        <i></i><span>{{ $server->name }}</span>
                    </a>
                @endif

                @auth
                    <a class="bm-icon-btn" href="{{ route('notifications') }}" aria-label="Notifications"><i class="bi bi-bell"></i></a>
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
                    @if(Route::has('register'))
                        <a class="bm-register" href="{{ route('register') }}">REGISTER</a>
                    @endif
                    <a class="bm-login" href="{{ route('login') }}"><i class="bi bi-person"></i> LOGIN</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
