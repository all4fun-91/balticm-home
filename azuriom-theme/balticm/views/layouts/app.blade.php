@extends('layouts.base')

@section('app')
    @if(request()->is('user/password/reset*'))
        <style>
            html,body{background:#020711 url('https://media.balticm.eu/media/site/1789346383673-4e25ebb7-52fc-45bb-8fcb-f9c96c46b873.png') center top/cover fixed no-repeat!important}
            header{display:none!important}
        </style>
    @endif
    <main class="bm-page bm-wrap">
        @include('elements.session-alerts')
        @yield('content')
    </main>
@endsection
