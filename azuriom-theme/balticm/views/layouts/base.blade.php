<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', 'BalticM — Play Together'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#02050b">
    <title>@yield('title', 'BalticM — Play Together') | {{ site_name() }}</title>
    <link rel="shortcut icon" href="{{ favicon() }}">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/reference.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/background.css') }}" rel="stylesheet">
    <style>
        /* Footer: completely flat, neutral and free of blue decoration. */
        html, body, #app, footer.bm-footer-new,
        footer.bm-footer-new * {
            border-color: transparent !important;
            box-shadow: none !important;
            outline: 0 !important;
        }
        footer.bm-footer-new,
        footer.bm-footer-new::before,
        footer.bm-footer-new::after {
            border: 0 !important;
            background: #02050b !important;
            box-shadow: none !important;
            outline: 0 !important;
        }
        footer.bm-footer-new a,
        footer.bm-footer-new i,
        footer.bm-footer-new p,
        footer.bm-footer-new span,
        footer.bm-footer-new div {
            text-shadow: none !important;
        }
        footer.bm-footer-new a,
        footer.bm-footer-new .bm-social {
            border: 0 !important;
            background: transparent !important;
            color: #c9d2df !important;
            box-shadow: none !important;
        }
        footer.bm-footer-new a:hover,
        footer.bm-footer-new .bm-social:hover {
            border: 0 !important;
            background: transparent !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
    </style>
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

<footer class="bm-footer bm-footer-new">
    <div class="bm-wrap bm-footer-main">
        <div class="bm-footer-brand">
            <a href="{{ route('home') }}" class="bm-footer-logo">BALTICM</a>
            <div class="bm-footer-tag">PLAY TOGETHER</div>
            <p>Gaming community for players, creators and communities.</p>
        </div>

        <div class="bm-footer-column">
            <span class="bm-footer-title">EXPLORE</span>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/forum') }}">Forum</a>
            <a href="{{ url('/servers') }}">Servers</a>
            <a href="{{ url('/about') }}">About</a>
        </div>

        <div class="bm-footer-column">
            <span class="bm-footer-title">COMMUNITY</span>
            <a href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener">Discord</a>
            <a href="https://www.youtube.com/@MiersBerzins" target="_blank" rel="noopener">YouTube</a>
            <a href="https://www.twitch.tv/miersberzins" target="_blank" rel="noopener">Twitch</a>
            <a href="https://steamcommunity.com/profiles/76561198963497293" target="_blank" rel="noopener">Steam</a>
        </div>

        <div class="bm-footer-social-block">
            <span class="bm-footer-title">FOLLOW US</span>
            <div class="bm-socials bm-footer-socials">
                <a class="bm-social" href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener" aria-label="Discord"><i class="bi bi-discord"></i></a>
                <a class="bm-social" href="https://www.youtube.com/@MiersBerzins" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                <a class="bm-social" href="https://www.twitch.tv/miersberzins" target="_blank" rel="noopener" aria-label="Twitch"><i class="bi bi-twitch"></i></a>
                <a class="bm-social" href="https://steamcommunity.com/profiles/76561198963497293" target="_blank" rel="noopener" aria-label="Steam"><i class="bi bi-steam"></i></a>
                <a class="bm-social" href="https://www.tiktok.com/@miersberzins" target="_blank" rel="noopener" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
    </div>
</footer>

@stack('footer-scripts')
</body>
</html>
