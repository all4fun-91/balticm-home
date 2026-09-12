<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', 'BalticM — Play Together'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#02050b">
    <title>@yield('title', site_name()) | {{ site_name() }}</title>
    <link rel="shortcut icon" href="{{ favicon() }}">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    @stack('meta')
    @stack('styles')
    @stack('scripts')
</head>
<body class="balticm-theme" @if(dark_theme(true)) data-bs-theme="dark" @endif>
<div id="app">
    <header>
        @include('elements.navbar')
    </header>

    @yield('app')
</div>

<footer class="bm-footer">
    <div class="bm-wrap bm-foot">
        <div>
            <a class="bm-foot-brand" href="{{ route('home') }}">BALTICM</a>
            <div class="bm-foot-tag">PLAY TOGETHER</div>
        </div>
        <nav class="bm-foot-links">
            @foreach($navbar as $element)
                @if(!$element->isDropdown())
                    <a href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $element->name }}</a>
                @endif
            @endforeach
        </nav>
        <div class="bm-socials">
            <a class="bm-social" href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener" aria-label="Discord">D</a>
            <a class="bm-social" href="https://www.youtube.com/@MiersBerzins" target="_blank" rel="noopener" aria-label="YouTube">Y</a>
            <a class="bm-social" href="https://www.twitch.tv/miersberzins" target="_blank" rel="noopener" aria-label="Twitch">T</a>
            <a class="bm-social" href="https://steamcommunity.com/profiles/76561198963497293" target="_blank" rel="noopener" aria-label="Steam">S</a>
            <a class="bm-social" href="https://www.tiktok.com/@miersberzins" target="_blank" rel="noopener" aria-label="TikTok">♪</a>
        </div>
    </div>
    <div class="bm-wrap bm-copy">© {{ now()->year }} BalticM. All rights reserved.</div>
</footer>

@stack('footer-scripts')
</body>
</html>
