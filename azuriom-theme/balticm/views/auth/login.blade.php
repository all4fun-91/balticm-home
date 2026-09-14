@extends('layouts.base')

@section('title', 'Login')
@section('description', 'Login to BalticM with Steam, Discord or Google.')

@section('app')
<script>
window.location.replace(@json(route('home') . '#login'));
</script>
<noscript>
    <p style="padding:2rem;text-align:center;">Redirecting to BalticM login…</p>
</noscript>
@endsection
