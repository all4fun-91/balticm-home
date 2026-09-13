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

<footer class="bm-footer" style="border-top:0 !important;">
    <div class="bm-wrap bm-foot">
        <div class="bm-foot-brand-block">
            <a class="bm-foot-brand" href="{{ route('home') }}">BALTICM</a>
            <div class="bm-foot-tag">PLAY TOGETHER</div>
        </div>
        <nav class="bm-foot-links">
            @php($footerNavbar = $navbar ?? [])
            @foreach($footerNavbar as $element)
                @if(!$element->isDropdown())
                    <a class="@if($element->isCurrent()) active @endif" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $element->name }}</a>
                @endif
            @endforeach
        </nav>
        <div class="bm-socials">
            <a class="bm-social" href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener" aria-label="Discord"><i class="bi bi-discord"></i></a>
            <a class="bm-social" href="https://www.youtube.com/@MiersBerzins" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            <a class="bm-social" href="https://www.twitch.tv/miersberzins" target="_blank" rel="noopener" aria-label="Twitch"><i class="bi bi-twitch"></i></a>
            <a class="bm-social" href="https://steamcommunity.com/profiles/76561198963497293" target="_blank" rel="noopener" aria-label="Steam"><i class="bi bi-steam"></i></a>
            <a class="bm-social" href="https://www.tiktok.com/@miersberzins" target="_blank" rel="noopener" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
        </div>
    </div>
    <div class="bm-wrap bm-copy">© {{ now()->year }} BalticM. All rights reserved.</div>
</footer>

@stack('footer-scripts')
</body>
</html>
