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
        footer.bm-footer-new {
            position: relative !important;
            z-index: 20 !important;
        }
        /* Cover the last few pixels of the old page artwork/seam above the footer. */
        footer.bm-footer-new::before {
            content: "" !important;
            position: absolute !important;
            left: 0 !important;
            right: 0 !important;
            top: -12px !important;
            height: 12px !important;
            background: #02050b !important;
            border: 0 !important;
            box-shadow: none !important;
        }
        footer.bm-footer-new a,
        footer.bm-footer-new i,
        footer.bm-footer-new p,
        footer.bm-footer-new span,
        footer.bm-footer-new div {
            text-shadow: none !important;
        }
        footer.bm-footer-new a,
        footer.bm-footer-new .bm-social,
        footer.bm-footer-new a:hover,
        footer.bm-footer-new .bm-social:hover {
            border: 0 !important;
            outline: 0 !important;
            background: transparent !important;
            color: #c9d2df !important;
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

<footer class="bm-footer bm-footer-new"></footer>

@stack('footer-scripts')
</body>
</html>
