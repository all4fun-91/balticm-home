@extends('layouts.base')

@section('title', 'Login')
@section('description', 'Login to BalticM with Steam, Discord or Google.')

@section('app')
<main class="bm-auth-page">
    <div class="bm-auth-bg">
        <div class="bm-auth-glow bm-auth-glow-one"></div>
        <div class="bm-auth-glow bm-auth-glow-two"></div>
    </div>

    <div class="bm-wrap bm-auth-wrap">
        <section class="bm-login-card">
            <div class="bm-login-mark">BM</div>
            <div class="bm-auth-eyebrow">BALTICM ACCOUNT</div>
            <h1>WELCOME BACK.</h1>
            <p class="bm-auth-lead">Choose how you want to sign in to BalticM.</p>

            <div class="bm-auth-providers">
                @if(Route::has('auth.steam'))
                    <a class="bm-auth-provider bm-steam" href="{{ route('auth.steam') }}">
                        <span class="bm-provider-icon"><i class="bi bi-steam"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH STEAM</span>
                        <i class="bi bi-arrow-right bm-provider-arrow"></i>
                    </a>
                @else
                    <div class="bm-auth-provider bm-provider-disabled bm-steam">
                        <span class="bm-provider-icon"><i class="bi bi-steam"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH STEAM</span>
                        <span class="bm-provider-soon">SOON</span>
                    </div>
                @endif

                @if(Route::has('discord-auth.login'))
                    <a class="bm-auth-provider bm-discord" href="{{ route('discord-auth.login') }}">
                        <span class="bm-provider-icon"><i class="bi bi-discord"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH DISCORD</span>
                        <i class="bi bi-arrow-right bm-provider-arrow"></i>
                    </a>
                @else
                    <div class="bm-auth-provider bm-provider-disabled bm-discord">
                        <span class="bm-provider-icon"><i class="bi bi-discord"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH DISCORD</span>
                        <span class="bm-provider-soon">SOON</span>
                    </div>
                @endif

                @if(Route::has('google.login'))
                    <a class="bm-auth-provider bm-google" href="{{ route('google.login') }}">
                        <span class="bm-provider-icon"><i class="bi bi-google"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH GOOGLE</span>
                        <i class="bi bi-arrow-right bm-provider-arrow"></i>
                    </a>
                @elseif(Route::has('google-auth.login'))
                    <a class="bm-auth-provider bm-google" href="{{ route('google-auth.login') }}">
                        <span class="bm-provider-icon"><i class="bi bi-google"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH GOOGLE</span>
                        <i class="bi bi-arrow-right bm-provider-arrow"></i>
                    </a>
                @else
                    <div class="bm-auth-provider bm-provider-disabled bm-google">
                        <span class="bm-provider-icon"><i class="bi bi-google"></i></span>
                        <span class="bm-provider-label">CONTINUE WITH GOOGLE</span>
                        <span class="bm-provider-soon">SOON</span>
                    </div>
                @endif
            </div>

            <div class="bm-auth-divider"><span>SECURE COMMUNITY LOGIN</span></div>
            <p class="bm-auth-note">Your BalticM account keeps your profile, community activity and game services connected in one place.</p>

            <a class="bm-auth-back" href="{{ route('home') }}"><i class="bi bi-arrow-left"></i> BACK TO BALTICM</a>
        </section>
    </div>
</main>
@endsection
