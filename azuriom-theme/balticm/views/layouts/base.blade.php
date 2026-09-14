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
    @if(request()->routeIs('home'))
    <style>
        .bm-login-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:24px;background:rgba(0,0,0,.76)}
        .bm-login-modal.is-open{display:flex}
        .bm-login-dialog{position:relative;width:min(430px,100%);padding:30px;border:1px solid rgba(255,255,255,.16);border-radius:20px;background:rgba(5,8,13,.97);box-shadow:0 24px 80px rgba(0,0,0,.65),inset 0 0 34px rgba(255,255,255,.025)}
        .bm-login-close{position:absolute;top:14px;right:14px;width:34px;height:34px;border:1px solid rgba(255,255,255,.16);border-radius:9px;background:rgba(255,255,255,.04);color:#fff;font-size:20px;line-height:1;cursor:pointer}
        .bm-login-close:hover{border-color:rgba(255,122,24,.65);color:#ff9a3d}
        .bm-login-brand{display:flex;align-items:center;gap:12px;margin-bottom:20px}
        .bm-login-brand img{width:48px;height:48px;object-fit:cover;border-radius:12px;border:1px solid rgba(255,255,255,.24)}
        .bm-login-brand strong{display:block;font-size:17px;letter-spacing:.12em;line-height:1;font-weight:900}
        .bm-login-brand small{display:block;margin-top:6px;color:#ff9a3d;font-size:7px;font-weight:900;letter-spacing:.25em}
        .bm-login-eyebrow{margin-bottom:8px;color:#ff9a3d;font-size:9px;font-weight:900;letter-spacing:.25em}
        .bm-login-dialog h2{margin:0;font-size:31px;letter-spacing:-.04em;font-weight:900}
        .bm-login-lead{margin:8px 0 22px;color:rgba(255,255,255,.68);font-size:12px;line-height:1.5}
        .bm-login-providers{display:grid;gap:10px}
        .bm-login-provider{min-height:52px;display:flex;align-items:center;gap:12px;padding:0 15px;border:1px solid rgba(255,255,255,.14);border-radius:11px;background:rgba(255,255,255,.035);color:#fff;text-decoration:none;transition:border-color .18s ease,background .18s ease,transform .18s ease}
        .bm-login-provider:hover{border-color:rgba(255,122,24,.62);background:rgba(255,122,24,.08);color:#fff;transform:translateY(-1px)}
        .bm-login-provider i{width:21px;text-align:center;font-size:18px}
        .bm-login-provider span{font-size:10px;font-weight:900;letter-spacing:.1em}
        .bm-login-provider .bm-arrow{margin-left:auto;font-size:13px;color:rgba(255,255,255,.45)}
        .bm-login-divider{display:flex;align-items:center;gap:10px;margin:22px 0 13px;color:rgba(255,255,255,.36);font-size:7px;font-weight:800;letter-spacing:.2em}
        .bm-login-divider:before,.bm-login-divider:after{content:'';height:1px;flex:1;background:rgba(255,255,255,.1)}
        .bm-login-note{margin:0;color:rgba(255,255,255,.45);font-size:9px;line-height:1.5;text-align:center}
        body.bm-modal-open{overflow:hidden}
        @media(max-width:600px){.bm-login-modal{padding:14px}.bm-login-dialog{padding:24px 18px;border-radius:16px}.bm-login-dialog h2{font-size:27px}}
    </style>
    @endif
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
    @if(request()->routeIs('home') && !auth()->check())
    <div class="bm-login-modal" id="bm-login-modal" aria-hidden="true">
        <div class="bm-login-dialog" role="dialog" aria-modal="true" aria-labelledby="bm-login-title">
            <button type="button" class="bm-login-close" id="bm-login-close" aria-label="Close">×</button>
            <div class="bm-login-brand">
                <img src="https://media.balticm.eu/media/site/1789353600524-63dc7873-b363-4d93-a68c-4451208f096d.png" alt="BalticM">
                <span><strong>BALTICM</strong><small>PLAY TOGETHER</small></span>
            </div>
            <div class="bm-login-eyebrow">BALTICM ACCOUNT</div>
            <h2 id="bm-login-title">WELCOME BACK.</h2>
            <p class="bm-login-lead">Choose how you want to sign in to the BalticM community.</p>
            <div class="bm-login-providers">
                @if(Route::has('auth.steam'))
                    <a class="bm-login-provider" href="{{ route('auth.steam') }}"><i class="bi bi-steam"></i><span>CONTINUE WITH STEAM</span><i class="bi bi-arrow-right bm-arrow"></i></a>
                @endif
                @if(Route::has('discord-auth.login'))
                    <a class="bm-login-provider" href="{{ route('discord-auth.login') }}"><i class="bi bi-discord"></i><span>CONTINUE WITH DISCORD</span><i class="bi bi-arrow-right bm-arrow"></i></a>
                @endif
                @if(Route::has('google.login'))
                    <a class="bm-login-provider" href="{{ route('google.login') }}"><i class="bi bi-google"></i><span>CONTINUE WITH GOOGLE</span><i class="bi bi-arrow-right bm-arrow"></i></a>
                @elseif(Route::has('google-auth.login'))
                    <a class="bm-login-provider" href="{{ route('google-auth.login') }}"><i class="bi bi-google"></i><span>CONTINUE WITH GOOGLE</span><i class="bi bi-arrow-right bm-arrow"></i></a>
                @endif
            </div>
            <div class="bm-login-divider"><span>SECURE COMMUNITY LOGIN</span></div>
            <p class="bm-login-note">Your account keeps your profile, community activity and game services connected.</p>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        const modal=document.getElementById('bm-login-modal');
        const close=document.getElementById('bm-login-close');
        if(!modal)return;
        const open=()=>{modal.classList.add('is-open');modal.setAttribute('aria-hidden','false');document.body.classList.add('bm-modal-open');};
        const hide=()=>{modal.classList.remove('is-open');modal.setAttribute('aria-hidden','true');document.body.classList.remove('bm-modal-open');};
        document.querySelectorAll('.bm-login[href]').forEach(btn=>btn.addEventListener('click',function(e){if(this.getAttribute('href') && this.getAttribute('href').includes('/login')){e.preventDefault();open();}}));
        close.addEventListener('click',hide);
        modal.addEventListener('click',e=>{if(e.target===modal)hide();});
        document.addEventListener('keydown',e=>{if(e.key==='Escape'&&modal.classList.contains('is-open'))hide();});
    });
    </script>
    @endif
</div>
@stack('footer-scripts')
</body>
</html>
