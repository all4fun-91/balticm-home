@extends('layouts.base')

@section('title', 'BalticM — Play Together')
@section('description', 'BalticM — a gaming community for players, creators and communities.')

@section('app')
<style>
*{box-sizing:border-box}
html,body{margin:0;padding:0;background:#000;color:#fff;font-family:Arial,Helvetica,sans-serif}
body{overflow-x:hidden}
.bm{min-height:100vh;background:#000}
.bm-header{height:72px;background:#000;display:flex;align-items:center}
.bm-inner{width:min(1200px,calc(100% - 48px));margin:auto}
.bm-nav{height:100%;display:flex;align-items:center;justify-content:space-between}
.bm-logo{display:flex;align-items:center;gap:10px;text-decoration:none;color:#fff}
.bm-logo-mark{width:38px;height:38px;border-radius:10px;background:#246cff;display:grid;place-items:center;font-size:11px;font-weight:800}
.bm-logo-text strong{display:block;font-size:15px;letter-spacing:.08em}
.bm-logo-text small{display:block;margin-top:3px;color:#777;font-size:7px;letter-spacing:.2em}
.bm-links{display:flex;gap:28px;margin-left:auto;margin-right:38px}
.bm-links a{color:#ccc;text-decoration:none;font-size:11px}
.bm-links a:hover{color:#fff}
.bm-actions{display:flex;gap:8px;align-items:center}
.bm-action{width:36px;height:36px;border:1px solid #242424;border-radius:9px;background:#050505;color:#ddd;display:grid;place-items:center;text-decoration:none}
.bm-action:hover{border-color:#555;color:#fff}
.bm-login{height:36px;padding:0 15px;border-radius:9px;background:#2868f5;color:#fff;text-decoration:none;font-size:9px;font-weight:800;display:flex;align-items:center}
.bm-hero{height:560px;background:#000 url('{{ theme_asset('balticm-background-web.webp') }}') center center/cover no-repeat;position:relative;display:flex;align-items:center}
.bm-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,0,0,.72),rgba(0,0,0,.12) 65%,rgba(0,0,0,.22));pointer-events:none}
.bm-hero-content{position:relative;z-index:1;padding-top:10px}
.bm-kicker{font-size:9px;font-weight:700;letter-spacing:.42em;margin-bottom:18px}
.bm-title{margin:0;font-size:clamp(62px,7vw,100px);line-height:.84;letter-spacing:-.055em;font-weight:900}
.bm-title span{display:block;color:#2997ff}
.bm-subtitle{margin:16px 0 0;max-width:560px;color:#eee;font-size:13px;line-height:1.6}
.bm-content{background:#000;padding:0 0 50px}
.bm-stats{position:relative;margin-top:-42px;display:grid;grid-template-columns:repeat(4,1fr);background:#030303;border:1px solid #242424;border-radius:13px;overflow:hidden}
.bm-stat{padding:21px 23px;border-right:1px solid #242424}
.bm-stat:last-child{border-right:0}
.bm-stat strong{font-size:20px}
.bm-stat small{display:block;margin-top:7px;color:#777;font-size:7px;letter-spacing:.16em;text-transform:uppercase}
.bm-news{padding-top:18px}
.bm-news-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.bm-card{min-height:110px;border:1px solid #242424;border-radius:11px;background:#050505;padding:16px;color:#fff;text-decoration:none}
.bm-card:hover{border-color:#555}
.bm-card-label{color:#4da8ff;font-size:8px;font-weight:800;letter-spacing:.15em}
.bm-card-date{float:right;color:#777;font-size:8px}
.bm-card h3{margin:14px 0 7px;font-size:14px}
.bm-card p{margin:0;color:#888;font-size:10px;line-height:1.45}
.bm-empty{border:1px dashed #242424;border-radius:11px;padding:20px;color:#777;font-size:10px;background:#030303}
.bm-footer{background:#000;border-top:1px solid #242424;padding:28px 0}
.bm-footer-row{display:flex;align-items:center;justify-content:space-between;gap:20px}
.bm-footer-brand{font-size:12px;font-weight:800;letter-spacing:.08em}
.bm-footer-brand small{display:block;margin-top:4px;color:#666;font-size:7px;letter-spacing:.2em}
.bm-footer-links{display:flex;gap:20px}
.bm-footer-links a{color:#888;text-decoration:none;font-size:9px}
.bm-footer-links a:hover{color:#fff}
.bm-footer-social{display:flex;gap:8px}
.bm-footer-social a{width:32px;height:32px;border:1px solid #242424;border-radius:8px;display:grid;place-items:center;color:#bbb;text-decoration:none}
.bm-footer-social a:hover{border-color:#555;color:#fff}
@media(max-width:900px){.bm-links{display:none}.bm-inner{width:calc(100% - 32px)}.bm-hero{height:540px}.bm-title{font-size:66px}.bm-stats{grid-template-columns:1fr 1fr}.bm-stat:nth-child(2){border-right:0}.bm-stat:nth-child(-n+2){border-bottom:1px solid #242424}.bm-news-grid{grid-template-columns:1fr}.bm-footer-row{align-items:flex-start;flex-direction:column}}
@media(max-width:600px){.bm-inner{width:calc(100% - 24px)}.bm-header{height:64px}.bm-hero{height:500px}.bm-title{font-size:52px}.bm-subtitle{font-size:12px}}
</style>

<main class="bm">
<header class="bm-header">
<div class="bm-inner bm-nav">
<a class="bm-logo" href="{{ url('/') }}"><span class="bm-logo-mark">BM</span><span class="bm-logo-text"><strong>BALTICM</strong><small>PLAY TOGETHER</small></span></a>
<nav class="bm-links">
<a href="{{ url('/') }}">Home</a><a href="{{ url('/forum') }}">Forum</a><a href="{{ url('/servers') }}">Servers</a><a href="{{ url('/online') }}">Online</a><a href="{{ url('/statistics') }}">Statistics</a><a href="{{ url('/about') }}">About</a>
</nav>
<div class="bm-actions"><a class="bm-action" href="#"><i class="bi bi-chat-square-text"></i></a><a class="bm-action" href="#"><i class="bi bi-search"></i></a><a class="bm-action" href="#"><i class="bi bi-bell"></i></a>@auth<a class="bm-login" href="{{ route('profile.index') }}">PROFILE</a>@else<a class="bm-login" href="{{ route('login') }}">LOGIN</a>@endauth</div>
</div>
</header>
<section class="bm-hero"><div class="bm-inner bm-hero-content"><div class="bm-kicker">G A M I N G &nbsp; C O M M U N I T Y</div><h1 class="bm-title">BALTICM<span>PLAY TOGETHER.</span></h1><p class="bm-subtitle">A home for players, creators and communities. Play together. Grow together.</p></div></section>
<section class="bm-content"><div class="bm-inner">
<div class="bm-stats">
<div class="bm-stat"><strong>{{ number_format(\Azuriom\Models\User::count()) }}</strong><small>Community Members</small></div>
<div class="bm-stat"><strong>{{ $servers->count() }}+</strong><small>Active Servers</small></div>
<div class="bm-stat"><strong>EU</strong><small>Community</small></div>
<div class="bm-stat"><strong>24/7</strong><small>Online Support</small></div>
</div>
<div class="bm-news"><div class="bm-news-grid">
@if($message)<div class="bm-empty">{{ $message }}</div>@endif
@if($posts->isEmpty())<div class="bm-empty">No news published yet. More BalticM updates are coming soon.</div>@else
@foreach($posts->take(3) as $post)<a class="bm-card" href="{{ route('posts.show',$post->slug) }}"><span class="bm-card-label">NEWS</span><span class="bm-card-date">{{ format_date($post->created_at) }}</span><h3>{{ $post->title }}</h3><p>{{ Str::limit(strip_tags($post->content),150) }}</p></a>@endforeach
@endif
</div></div>
</div></section>
<footer class="bm-footer"><div class="bm-inner bm-footer-row"><div class="bm-footer-brand">BALTICM<small>PLAY TOGETHER</small></div><nav class="bm-footer-links"><a href="{{ url('/') }}">Home</a><a href="{{ url('/forum') }}">Forum</a><a href="{{ url('/servers') }}">Servers</a><a href="{{ url('/about') }}">About</a></nav><div class="bm-footer-social"><a href="https://discord.com/invite/y2EGmd5Er5" target="_blank"><i class="bi bi-discord"></i></a><a href="https://www.youtube.com/@MiersBerzins" target="_blank"><i class="bi bi-youtube"></i></a><a href="https://www.twitch.tv/miersberzins" target="_blank"><i class="bi bi-twitch"></i></a></div></div></footer>
</main>
@endsection