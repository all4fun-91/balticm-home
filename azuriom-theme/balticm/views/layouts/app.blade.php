@extends('layouts.base')

@section('app')
    <main class="bm-page bm-wrap">
        @include('elements.session-alerts')
        @yield('content')
    </main>
@endsection
