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
        .bm-login-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:22px;background:rgba(0,0,0,.78);backdrop-filter:blur(3px)}
        .bm-login-modal.is-open{display:flex}
        .bm-login-dialog{position:relative;width:min(1080px,96vw);min-height:650px;display:grid;grid-template-columns:43% 57%;overflow:hidden;border:1px solid rgba(255,255,255,.2);border-radius:24px;background:#05090f;box-shadow:0 30px 100px rgba(0,0,0,.78),inset 0 0 50px rgba(255,255,255,.025)}
        .bm-login-close{position:absolute;z-index:5;top:17px;right:17px;width:38px;height:38px;border:1px solid rgba(255,255,255,.18);border-radius:10px;background:rgba(5,8,13,.72);color:#fff;font-size:21px;line-height:1;cursor:pointer}
        .bm-login-close:hover{border-color:rgba(255,122,24,.7);color:#ff9a3d}
        .bm-login-side{position:relative;display:flex;flex-direction:column;justify-content:space-between;padding:55px 42px 34px;overflow:hidden;background:linear-gradient(180deg,rgba(2,7,14,.2),rgba(2,7,14,.84)),url('https://media.balticm.eu/media/site/1789346383673-4e25ebb7-52fc-45bb-8fcb-f9c96c46b873.png') center/cover no-repeat}
        .bm-login-side:before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 72% 40%,rgba(52,125,190,.22),transparent 34%),linear-gradient(90deg,rgba(2,6,12,.08),rgba(2,6,12,.45))}
        .bm-login-side>*{position:relative;z-index:1}
        .bm-login-brand{display:flex;align-items:center;gap:14px}
        .bm-login-brand img{width:58px;height:58px;object-fit:cover;border-radius:14px;border:1px solid rgba(255,255,255,.25);background:#02050b}
        .bm-login-brand strong{display:block;font-size:21px;letter-spacing:.12em;line-height:1;font-weight:900;color:#fff}
        .bm-login-brand small{display:block;margin-top:7px;color:#ff9a3d;font-size:9px;font-weight:900;letter-spacing:.25em}
        .bm-login-side-copy{max-width:390px;margin-top:55px}
        .bm-login-eyebrow{margin-bottom:12px;color:#ff9a3d;font-size:10px;font-weight:900;letter-spacing:.27em}
        .bm-login-side h2{margin:0;color:#fff;font-size:48px;line-height:.98;letter-spacing:-.045em;font-weight:950}
        .bm-login-side h2 span{color:#ff7a18}
        .bm-login-side-lead{margin:20px 0 0;color:rgba(255,255,255,.76);font-size:14px;line-height:1.6}
        .bm-login-benefits{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:0;margin:0 -42px -34px;padding:20px 22px 18px;border-top:1px solid rgba(255,255,255,.16);border-bottom:0;background:rgba(3,8,14,.78);box-shadow:inset 0 0 26px rgba(0,0,0,.42)}
        .bm-login-benefits:after{content:'';position:absolute;inset:0;pointer-events:none;border-top:1px solid rgba(255,255,255,.12);box-shadow:inset 0 0 18px rgba(255,255,255,.015)}
        .bm-login-benefit{position:relative;z-index:1;text-align:center;color:rgba(255,255,255,.7);font-size:9px;font-weight:800;letter-spacing:.07em;text-transform:uppercase;border-right:1px solid rgba(255,255,255,.12);padding:4px 8px}
        .bm-login-benefit:last-child{border-right:0}
        .bm-login-benefit i{display:block;margin-bottom:8px;color:#fff;font-size:21px}
        .bm-login-formside{display:flex;flex-direction:column;justify-content:center;padding:55px 58px 42px;background:linear-gradient(135deg,#080d14,#05080d)}
        .bm-login-form-title{margin:0 0 28px;text-align:center;color:#fff;font-size:38px;font-weight:500;letter-spacing:-.035em}
        .bm-login-form{width:100%;max-width:540px;margin:0 auto}
        .bm-login-field{position:relative;margin-bottom:14px}
        .bm-login-field i{position:absolute;left:17px;top:50%;transform:translateY(-50%);z-index:1;color:rgba(255,255,255,.52);font-size:19px}
        .bm-login-field input{width:100%;height:58px;padding:0 18px 0 53px;border:1px solid rgba(255,255,255,.2);background:rgba(255,255,255,.015);color:#fff;font-size:14px;outline:none;clip-path:polygon(0 0,100% 0,100% 100%,4% 100%,0 80%)}
        .bm-login-field input:focus{border-color:rgba(255,154,61,.72);box-shadow:0 0 0 2px rgba(255,122,24,.08)}
        .bm-login-field input::placeholder{color:rgba(255,255,255,.38)}
        .bm-login-password input{padding-right:55px}
        .bm-login-eye{position:absolute;right:17px;left:auto!important;cursor:pointer}
        .bm-login-checkrow{display:flex;align-items:center;gap:10px;margin:17px 0 23px;color:rgba(255,255,255,.62);font-size:12px}
        .bm-login-checkrow input{width:19px;height:19px;accent-color:#ff7a18}
        .bm-login-submit{width:100%;height:58px;border:0;border-radius:0 0 12px 0;background:linear-gradient(180deg,#dff7ff,#a8d8e8);color:#071019;font-size:18px;font-weight:700;cursor:pointer;box-shadow:0 10px 30px rgba(117,190,220,.12);clip-path:polygon(0 0,100% 0,100% 100%,4% 100%,0 80%)}
        .bm-login-submit:hover{filter:brightness(1.06);transform:translateY(-1px)}
        .bm-login-links{display:flex;justify-content:space-between;margin:17px 0 25px;font-size:12px}
        .bm-login-links a{color:rgba(255,255,255,.7);text-decoration:none;border-bottom:1px dotted rgba(255,255,255,.35);padding-bottom:2px}
        .bm-login-links a:hover{color:#ff9a3d}
        .bm-login-divider{display:flex;align-items:center;gap:13px;margin:0 0 17px;color:rgba(255,255,255,.43);font-size:9px;font-weight:800;letter-spacing:.12em}
        .bm-login-divider:before,.bm-login-divider:after{content:'';height:1px;flex:1;background:rgba(255,255,255,.14)}
        .bm-login-providers{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
        .bm-login-provider{height:60px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.16);border-radius:10px;background:rgba(255,255,255,.035);color:#fff;text-decoration:none;transition:.18s ease}
        .bm-login-provider:hover{border-color:rgba(255,122,24,.62);background:rgba(255,122,24,.08);color:#fff;transform:translateY(-1px)}
        .bm-login-provider img{width:28px;height:28px;object-fit:contain}
        .bm-login-provider span{display:none}
        .bm-login-provider-disabled{opacity:.52;cursor:default}
        .bm-login-provider-disabled:hover{transform:none;border-color:rgba(255,255,255,.16);background:rgba(255,255,255,.035)}
        .bm-login-note{margin:24px 0 0;color:rgba(255,255,255,.4);font-size:9px;line-height:1.55;text-align:center}
        body.bm-modal-open{overflow:hidden}
        @media(max-width:820px){.bm-login-dialog{grid-template-columns:1fr;min-height:0;max-height:92vh;overflow:auto}.bm-login-side{min-height:250px;padding:34px 28px 26px}.bm-login-side-copy{margin-top:30px}.bm-login-side h2{font-size:36px}.bm-login-benefits{display:none}.bm-login-formside{padding:34px 28px 32px}.bm-login-form-title{font-size:32px}}
        @media(max-width:520px){.bm-login-modal{padding:8px}.bm-login-dialog{width:100%;border-radius:18px}.bm-login-side{min-height:220px;padding:27px 21px 24px}.bm-login-brand img{width:48px;height:48px}.bm-login-side h2{font-size:31px}.bm-login-side-lead{font-size:12px}.bm-login-formside{padding:28px 19px 25px}.bm-login-form-title{font-size:29px;margin-bottom:22px}.bm-login-providers{gap:8px}.bm-login-provider{height:54px}.bm-login-provider img{width:24px;height:24px}}
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
            <section class="bm-login-side">
                <div>
                    <div class="bm-login-brand">
                        <img src="https://media.balticm.eu/media/site/1789353600524-63dc7873-b363-4d93-a68c-4451208f096d.png" alt="BalticM">
                        <span><strong>BALTICM</strong><small>PLAY TOGETHER</small></span>
                    </div>
                    <div class="bm-login-side-copy">
                        <div class="bm-login-eyebrow">BALTICM ACCOUNT</div>
                        <h2>WELCOME<br><span>BACK.</span></h2>
                        <p class="bm-login-side-lead">Choose how you want to sign in to the BalticM community.</p>
                    </div>
                </div>
                <div class="bm-login-benefits">
                    <div class="bm-login-benefit"><i class="bi bi-people"></i>Play Together</div>
                    <div class="bm-login-benefit"><i class="bi bi-shield-check"></i>Safe Community</div>
                    <div class="bm-login-benefit"><i class="bi bi-bar-chart"></i>More Than A Game</div>
                </div>
            </section>
            <section class="bm-login-formside">
                <h2 class="bm-login-form-title" id="bm-login-title">Log In</h2>
                <form class="bm-login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="bm-login-field">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="E-mail..." required>
                    </div>
                    <div class="bm-login-field bm-login-password">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" id="bm-login-password" autocomplete="current-password" placeholder="Password" required>
                        <i class="bi bi-eye bm-login-eye" id="bm-login-eye"></i>
                    </div>
                    <label class="bm-login-checkrow"><input type="checkbox" name="remember" value="1"> <span>Remember me</span></label>
                    <button type="submit" class="bm-login-submit">Log In</button>
                </form>
                <div class="bm-login-links">
                    @if(Route::has('password.request'))<a href="{{ route('password.request') }}">Forgot your password?</a>@endif
                    @if(Route::has('register'))<a href="{{ route('register') }}">Register</a>@endif
                </div>
                <div class="bm-login-divider"><span>Other login options</span></div>
                <div class="bm-login-providers">
                    @if(Route::has('auth.steam'))<a class="bm-login-provider" href="{{ route('auth.steam') }}" aria-label="Steam"><img src="https://cdn.simpleicons.org/steam/ffffff" alt="Steam"></a>@else<div class="bm-login-provider bm-login-provider-disabled"><img src="https://cdn.simpleicons.org/steam/ffffff" alt="Steam"></div>@endif
                    @if(Route::has('discord-auth.login'))<a class="bm-login-provider" href="{{ route('discord-auth.login') }}" aria-label="Discord"><img src="https://cdn.simpleicons.org/discord/ffffff" alt="Discord"></a>@else<div class="bm-login-provider bm-login-provider-disabled"><img src="https://cdn.simpleicons.org/discord/ffffff" alt="Discord"></div>@endif
                    @if(Route::has('google.login'))<a class="bm-login-provider" href="{{ route('google.login') }}" aria-label="Google"><img src="https://cdn.simpleicons.org/google" alt="Google"></a>@elseif(Route::has('google-auth.login'))<a class="bm-login-provider" href="{{ route('google-auth.login') }}" aria-label="Google"><img src="https://cdn.simpleicons.org/google" alt="Google"></a>@else<div class="bm-login-provider bm-login-provider-disabled"><img src="https://cdn.simpleicons.org/google" alt="Google"></div>@endif
                </div>
                <p class="bm-login-note">SECURE COMMUNITY LOGIN · Your account keeps your profile, community activity and game services connected.</p>
            </section>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        const modal=document.getElementById('bm-login-modal'),close=document.getElementById('bm-login-close'),eye=document.getElementById('bm-login-eye'),password=document.getElementById('bm-login-password');
        if(!modal)return;
        const open=()=>{modal.classList.add('is-open');modal.setAttribute('aria-hidden','false');document.body.classList.add('bm-modal-open');};
        const hide=()=>{modal.classList.remove('is-open');modal.setAttribute('aria-hidden','true');document.body.classList.remove('bm-modal-open');};
        document.querySelectorAll('.bm-login[href]').forEach(btn=>btn.addEventListener('click',function(e){if(this.getAttribute('href')&&this.getAttribute('href').includes('/login')){e.preventDefault();open();}}));
        if(window.location.hash==='#login')open();
        if(close)close.addEventListener('click',hide);
        modal.addEventListener('click',function(e){if(e.target===modal)hide();});
        document.addEventListener('keydown',function(e){if(e.key==='Escape'&&modal.classList.contains('is-open'))hide();});
        if(eye&&password)eye.addEventListener('click',function(){password.type=password.type==='password'?'text':'password';this.classList.toggle('bi-eye');this.classList.toggle('bi-eye-slash');});
    });
    </script>
    @endif
</div>
</body>
</html>
