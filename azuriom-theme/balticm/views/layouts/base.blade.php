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
        html, body, #app { border:0 !important; box-shadow:none !important; outline:0 !important; }
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

@stack('footer-scripts')
</body>
</html>
