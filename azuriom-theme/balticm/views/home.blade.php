@extends('layouts.base')

@section('title', 'BalticM — Play Together')
@section('description', 'BalticM — a gaming community for players, creators and communities.')

@section('app')
<style>
/* =========================================================
   BALTICM HOME — EVERYTHING FOR THIS PAGE LIVES HERE
   ========================================================= */
html,body{margin:0;padding:0;background:#02050b!important;color:#f5f8ff;font-family:Inter,system-ui,-apple-system,"Segoe UI",sans-serif}
body{overflow-x:hidden}
.bm-home,.bm-home *{box-sizing:border-box}
.bm-home{--bg:#02050b;--text:#f5f8ff;--muted:#8998ad;--line:rgba(116,178,232,.20);--blue:#2f9cff;min-height:100vh;background:var(--bg);color:var(--text);overflow:hidden}
.bm-home a{color:inherit}
.bm-home__wrap{width:min(1200px,calc(100% - 48px));margin:0 auto}

/* Header */
.bm-home__header{height:72px;background:#02050b;border-bottom:1px solid rgba(255,255,255,.055);position:relative;z-index:50}
.bm-home__nav{height:100%;display:flex;align-items:center;justify-content:space-between}
.bm-home__brand{display:flex;align-items:center;gap:11px;text-decoration:none;flex:0 0 auto}
.bm-home__mark{width:40px;height:40px;border-radius:11px;display:grid;place-items:center;background:linear-gradient(135deg,#087cff,#653eff);box-shadow:0 0 26px rgba(48,117,255,.28);font-size:11px;font-weight:1000}
.bm-home__brand-text b{display:block;font-size:16px;line-height:1;letter-spacing:.06em}
.bm-home__brand-text small{display:block;margin-top:5px;color:#78879d;font-size:7px;letter-spacing:.22em}
.bm-home__nav-center{display:flex;align-items:center;gap:29px;margin-left:auto;margin-right:40px}
.bm-home__nav-center a{font-size:11px;color:#b8c4d5;text-decoration:none;transition:color .16s ease}
.bm-home__nav-center a:hover{color:#fff}
.bm-home__nav-right{display:flex;align-items:center;gap:8px}
.bm-home__icon{width:36px;height:36px;border:1px solid var(--line);border-radius:10px;display:grid;place-items:center;background:#050b14;color:#c6d1df;text-decoration:none;font-size:14px}
.bm-home__icon:hover{border-color:rgba(70,168,255,.55);color:#fff}
.bm-home__login{height:36px;padding:0 15px;border-radius:10px;display:inline-flex;align-items:center;gap:7px;background:linear-gradient(110deg,#146cff,#513eff);border:1px solid #61aaff;color:#fff!important;text-decoration:none;font-size:9px;font-weight:950;box-shadow:0 0 18px rgba(40,110,255,.18)}
.bm-home__mobile{display:none;width:38px;height:38px;border:1px solid var(--line);border-radius:9px;background:#050b14;color:#fff}

/* One background image. No global theme background participates. */
.bm-home__visual{position:relative;height:540px;overflow:hidden;background:#02050b}
.bm-home__visual img{position:absolute;left:0;top:0;width:100%;height:calc(100% - 1px);display:block;object-fit:cover;object-position:center top}
.bm-home__visual:after{content:"";position:absolute;left:0;right:0;bottom:0;height:1px;background:#02050b;z-index:2}
.bm-home__hero{position:relative;z-index:3;min-height:430px;display:flex;align-items:center}
.bm-home__hero-inner{padding:35px 0 0}
.bm-home__eyebrow{font-size:9px;font-weight:900;letter-spacing:.38em;color:#d6dfeb;margin-bottom:18px}
.bm-home__title{margin:0;max-width:800px;font-size:clamp(64px,7vw,102px);line-height:.83;letter-spacing:-.065em;font-weight:850}
.bm-home__title span{display:block;color:var(--blue)}
.bm-home__lead{max-width:600px;margin:15px 0 0;color:#d1d9e5;font-size:13px;line-height:1.55}

/* Stats */
.bm-home__body{position:relative;z-index:5;margin-top:-72px;padding-bottom:55px}
.bm-home__stats{display:grid;grid-template-columns:repeat(4,1fr);overflow:hidden;background:rgba(3,10,19,.94);border:1px solid var(--line);border-radius:14px;box-shadow:0 18px 45px rgba(0,0,0,.32)}
.bm-home__stat{min-height:82px;padding:19px 22px;border-right:1px solid var(--line)}
.bm-home__stat:last-child{border-right:0}
.bm-home__stat strong{display:block;font-size:20px;line-height:1}
.bm-home__stat small{display:block;margin-top:8px;color:#8493a8;font-size:8px;letter-spacing:.14em;text-transform:uppercase}

/* News */
.bm-home__news{margin-top:14px}
.bm-home__news-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.bm-home__news-card{min-height:150px;padding:16px;border:1px solid var(--line);border-radius:13px;background:linear-gradient(145deg,rgba(7,17,30,.96),rgba(2,7,14,.98));text-decoration:none;transition:transform .16s ease,border-color .16s ease}
.bm-home__news-card:hover{transform:translateY(-2px);border-color:rgba(68,167,255,.48)}
.bm-home__news-top{display:flex;justify-content:space-between;gap:10px;color:#42baff;font-size:8px;font-weight:900;letter-spacing:.15em}
.bm-home__news-top time{color:#718198;font-weight:500;letter-spacing:0}
.bm-home__news-card img{width:100%;height:95px;object-fit:cover;display:block;margin:11px 0;border-radius:8px}
.bm-home__news-card h3{margin:9px 0 7px;font-size:14px;line-height:1.25}
.bm-home__news-card p{margin:0;color:#8998ad;font-size:10px;line-height:1.5}
.bm-home__empty{padding:21px;border:1px dashed var(--line);border-radius:12px;color:#8291a5;font-size:10px;background:rgba(3,8,15,.45)}

/* Footer */
.bm-home__footer{border-top:1px solid rgba(255,255,255,.045);background:#02050b}
.bm-home__footer-inner{min-height:92px;display:flex;align-items:center;justify-content:space-between;gap:24px}
.bm-home__footer-brand{font-size:12px;font-weight:900;letter-spacing:.08em}
.bm-home__footer-tag{display:block;margin-top:4px;color:#64738a;font-size:7px;letter-spacing:.22em}
.bm-home__footer-links{display:flex;gap:20px;flex-wrap:wrap;justify-content:center}
.bm-home__footer-links a{color:#7f8ea3;text-decoration:none;font-size:9px}
.bm-home__footer-links a:hover{color:#fff}
.bm-home__footer-social{display:flex;gap:8px}
.bm-home__footer-social a{width:32px;height:32px;display:grid;place-items:center;border:1px solid rgba(115,177,230,.16);border-radius:8px;color:#9eacc0;text-decoration:none;font-size:12px}
.bm-home__footer-social a:hover{border-color:rgba(68,167,255,.5);color:#fff}

@media(max-width:900px){
 .bm-home__wrap{width:calc(100% - 32px)}
 .bm-home__nav-center,.bm-home__nav-right .bm-home__icon{display:none}
 .bm-home__mobile{display:block}
 .bm-home__visual{height:600px}
 .bm-home__hero{min-height:485px}
 .bm-home__hero-inner{padding-top:45px}
 .bm-home__title{font-size:68px}
 .bm-home__body{margin-top:-78px}
 .bm-home__stats{grid-template-columns:1fr 1fr}
 .bm-home__stat:nth-child(2){border-right:0}
 .bm-home__stat:nth-child(-n+2){border-bottom:1px solid var(--line)}
 .bm-home__news-grid{grid-template-columns:1fr}
 .bm-home__footer-inner{align-items:flex-start;flex-direction:column;padding:22px 0}
}
@media(max-width:600px){
 .bm-home__wrap{width:calc(100% - 24px)}
 .bm-home__header{height:64px}
 .bm-home__brand-text small{display:none}
 .bm-home__visual{height:545px}
 .bm-home__hero{min-height:440px}
 .bm-home__hero-inner{padding-top:38px}
 .bm-home__title{font-size:53px}
 .bm-home__lead{font-size:12px}
 .bm-home__body{margin-top:-58px}
 .bm-home__stat{padding:16px}
}
</style>

<main class="bm-home">
    <header class="bm-home__header">
        <div class="bm-home__wrap bm-home__nav">
            <a class="bm-home__brand" href="{{ url('/') }}">
                <span class="bm-home__mark">BM</span>
                <span class="bm-home__brand-text"><b>BALTICM</b><small>PLAY TOGETHER</small></span>
            </a>
            <nav class="bm-home__nav-center" aria-label="Main navigation">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/forum') }}">Forum</a>
                <a href="{{ url('/servers') }}">Servers</a>
                <a href="{{ url('/online') }}">Online</a>
                <a href="{{ url('/statistics') }}">Statistics</a>
                <a href="{{ url('/about') }}">About</a>
            </nav>
            <div class="bm-home__nav-right">
                <a class="bm-home__icon" href="#" aria-label="Messages"><i class="bi bi-chat-square-text"></i></a>
                <a class="bm-home__icon" href="#" aria-label="Search"><i class="bi bi-search"></i></a>
                <a class="bm-home__icon" href="#" aria-label="Notifications"><i class="bi bi-bell"></i></a>
                @auth
                    <a class="bm-home__login" href="{{ route('profile.index') }}"><i class="bi bi-person"></i> {{ Auth::user()->name }}</a>
                @else
                    <a class="bm-home__login" href="{{ route('login') }}"><i class="bi bi-person"></i> LOGIN</a>
                @endauth
                <button class="bm-home__mobile" type="button" aria-label="Menu"><i class="bi bi-list"></i></button>
            </div>
        </div>
    </header>

    <div class="bm-home__visual">
        <img src="{{ theme_asset('balticm-background-web.webp') }}" alt="">
        <section class="bm-home__hero">
            <div class="bm-home__wrap bm-home__hero-inner">
                <div class="bm-home__eyebrow">G A M I N G &nbsp; C O M M U N I T Y</div>
                <h1 class="bm-home__title">BALTICM<span>PLAY TOGETHER.</span></h1>
                <p class="bm-home__lead">A home for players, creators and communities. Play together. Grow together.</p>
            </div>
        </section>
    </div>

    <section class="bm-home__body">
        <div class="bm-home__wrap">
            <div class="bm-home__stats">
                <div class="bm-home__stat"><strong>{{ number_format(\Azuriom\Models\User::count()) }}</strong><small>Community Members</small></div>
                <div class="bm-home__stat"><strong>{{ $servers->count() }}+</strong><small>Active Servers</small></div>
                <div class="bm-home__stat"><strong>EU</strong><small>Community</small></div>
                <div class="bm-home__stat"><strong>24/7</strong><small>Online Support</small></div>
            </div>

            @if($message)
                <div class="bm-home__empty" style="margin-top:14px">{{ $message }}</div>
            @endif

            <section class="bm-home__news" id="latest-news">
                <div class="bm-home__news-grid">
                    @if($posts->isEmpty())
                        <div class="bm-home__empty">No news published yet. More BalticM updates are coming soon.</div>
                    @else
                        @foreach($posts->take(3) as $post)
                            <a class="bm-home__news-card" href="{{ route('posts.show', $post->slug) }}">
                                <div class="bm-home__news-top"><span>NEWS</span><time>{{ format_date($post->created_at) }}</time></div>
                                @if($post->hasImage())
                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
                                @endif
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                            </a>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
    </section>

    <footer class="bm-home__footer">
        <div class="bm-home__wrap bm-home__footer-inner">
            <div>
                <div class="bm-home__footer-brand">BALTICM</div>
                <span class="bm-home__footer-tag">PLAY TOGETHER</span>
            </div>
            <nav class="bm-home__footer-links" aria-label="Footer">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/forum') }}">Forum</a>
                <a href="{{ url('/servers') }}">Servers</a>
                <a href="{{ url('/about') }}">About</a>
            </nav>
            <div class="bm-home__footer-social">
                <a href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener" aria-label="Discord"><i class="bi bi-discord"></i></a>
                <a href="https://www.youtube.com/@MiersBerzins" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                <a href="https://www.twitch.tv/miersberzins" target="_blank" rel="noopener" aria-label="Twitch"><i class="bi bi-twitch"></i></a>
            </div>
        </div>
    </footer>
</main>
@endsection
