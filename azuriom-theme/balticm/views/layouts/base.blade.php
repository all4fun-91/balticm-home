<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', 'BalticM — Play Together'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#02050b">
    <title>@yield('title', 'BalticM — Play Together') | {{ site_name() }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://media.balticm.eu/media/site/1789353600524-63dc7873-b363-4d93-a68c-4451208f096d.png?v=2">
    <link rel="shortcut icon" type="image/png" href="https://media.balticm.eu/media/site/1789353600524-63dc7873-b363-4d93-a68c-4451208f096d.png?v=2">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    @stack('meta')
    @stack('styles')
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    @stack('scripts')
</head>
<body class="balticm-theme" @if(dark_theme(true)) data-bs-theme="dark" @endif>
<div id="app">
    @if(!request()->routeIs('home'))
        <header>
            @include('elements.navbar')
        </header>
    @endif
    @yield('app')
</div>
@stack('footer-scripts')
</body>
</html>
