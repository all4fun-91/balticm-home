@extends('layouts.base')

@section('title', 'BalticM — Play Together')
@section('description', 'BalticM — a gaming community for players, creators and communities.')

@section('app')
<style>
/* =========================================================
   BALTICM HOME — standalone page
   Homepage styling is isolated here.
   ========================================================= */
html,body{overflow-x:hidden!important}
body.balticm-theme{background:#02050b!important;background-image:none!important}

.bm-home,
.bm-home *{box-sizing:border-box}
.bm-home{--bg:#02050b;--panel:rgba(4,12,23,.92);--line:rgba(115,177,230,.20);--muted:#8797ac;--blue:#2f9cff;position:relative;isolation:isolate;overflow:hidden;background:#02050b!important;background-image:none!important;color:#f5f8ff;font-family:Inter,system-ui,-apple-system,"Segoe UI",sans-serif}
.bm-home a{color:inherit}

/* Only this image is allowed to provide the homepage artwork. */
.bm-home__backdrop{position:absolute;z-index:-1;top:0;left:0;right:0;height:560px;overflow:hidden;background:#02050b}
.bm-home__backdrop img{position:absolute;left:0;top:0;width:100%;height:auto;max-width:none;display:block}

.bm-home__hero{min-height:405px;display:flex;align-items:center;background:transparent!important;background-image:none!important}
.bm-home__wrap{width:min(1200px,calc(100% - 48px));margin:0 auto}
.bm-home__hero-inner{padding:70px 0 42px}
.bm-home__eyebrow{font-size:10px;font-weight:900;letter-spacing:.38em;color:#d2dceb;margin-bottom:16px}
.bm-home__title{margin:0;max-width:760px;font-size:clamp(62px,7vw,96px);line-height:.84;letter-spacing:-.065em;font-weight:800}
.bm-home__title span{display:block;color:var(--blue)}
.bm-home__lead{max-width:600px;margin:14px 0 0;color:#d2d9e5;font-size:14px;line-height:1.55}
.bm-home__content{position:relative;z-index:2;padding-bottom:46px;background:transparent!important;background-image:none!important}
.bm-home__stats{display:grid;grid-template-columns:repeat(4,1fr);overflow:hidden;margin-top:-2px;background:rgba(3,10,19,.93);border:1px solid var(--line);border-radius:14px;box-shadow:0 18px 45px rgba(0,0,0,.28)}
.bm-home__stat{min-height:82px;padding:18px 22px;border-right:1px solid var(--line)}
.bm-home__stat:last-child{border-right:0}
.bm-home__stat strong{display:block;font-size:21px;line-height:1}
.bm-home__stat small{display:block;margin-top:8px;color:#8493a8;font-size:8px;letter-spacing:.14em;text-transform:uppercase}
.bm-home__news{margin-top:14px}
.bm-home__news-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.bm-home__news-card{min-height:145px;padding:17px;border:1px solid var(--line);border-radius:13px;background:linear-gradient(145deg,rgba(7,17,30,.96),rgba(2,7,14,.98));text-decoration:none;transition:transform .18s ease,border-color .18s ease,background .18s ease}
.bm-home__news-card:hover{transform:translateY(-2px);border-color:rgba(68,167,255,.45);background:linear-gradient(145deg,rgba(9,21,37,.98),rgba(3,8,16,.99))}
.bm-home__news-top{display:flex;justify-content:space-between;gap:10px;color:#41baff;font-size:8px;font-weight:900;letter-spacing:.15em}
.bm-home__news-top time{color:#6f7f94;font-weight:500;letter-spacing:0}
.bm-home__news-card img{width:100%;height:96px;object-fit:cover;display:block;margin:12px 0;border-radius:8px}
.bm-home__news-card h3{margin:11px 0 7px;font-size:14px;line-height:1.25}
.bm-home__news-card p{margin:0;color:#8998ad;font-size:10px;line-height:1.5}
.bm-home__empty{padding:22px;border:1px dashed var(--line);border-radius:12px;color:#7f8da2;font-size:11px;background:rgba(3,8,15,.55)}

.bm-home__footer{border-top:0!important;background:#02050b!important;background-image:none!important}
.bm-home__footer-inner{min-height:82px;display:flex;align-items:center;justify-content:space-between;gap:20px}
.bm-home__footer-brand{font-size:12px;font-weight:900;letter-spacing:.08em}
.bm-home__footer-tag{display:block;margin-top:4px;color:#64738a;font-size:7px;letter-spacing:.22em}
.bm-home__footer-links{display:flex;gap:20px;flex-wrap:wrap;justify-content:center}
.bm-home__footer-links a{color:#7f8ea3;text-decoration:none;font-size:9px}
.bm-home__footer-links a:hover{color:#fff}
.bm-home__footer-social{display:flex;gap:8px}
.bm-home__footer-social a{width:32px;height:32px;display:grid;place-items:center;border:1px solid rgba(115,177,230,.16);border-radius:8px;color:#9eacc0;text-decoration:none;font-size:12px}
.bm-home__footer-social a:hover{border-color:rgba(68,167,255,.5);color:#fff}

/* Kill the old Azuriom/global footer on this page only. */
body:has(.bm-home)>footer,
#app + footer{display:none!important}

/* Kill old theme artwork/rules if they target generic main elements. */
.bm-home .bm-hero,
.bm-home .bm-latest,
.bm-home .bm-cta,
.bm-home .bm-community-strip{background:none!important;background-image:none!important;border:0!important;box-shadow:none!important}

@media(max-width:900px){
 .bm-home__wrap{width:calc(100% - 32px)}
 .bm-home__backdrop{height:620px}
 .bm-home__hero{min-height:465px}
 .bm-home__hero-inner{padding:65px 0 55px}
 .bm-home__stats{grid-template-columns:1fr 1fr}
 .bm-home__stat:nth-child(2){border-right:0}
 .bm-home__stat:nth-child(-n+2){border-bottom:1px solid var(--line)}
 .bm-home__news-grid{grid-template-columns:1fr}
 .bm-home__footer-inner{align-items:flex-start;flex-direction:column;padding:22px 0}
}
@media(max-width:600px){
 .bm-home__wrap{width:calc(100% - 24px)}
 .bm-home__backdrop{height:560px}
 .bm-home__hero{min-height:430px}
 .bm-home__hero-inner{padding:58px 0 50px}
 .bm-home__title{font-size:53px}
 .bm-home__lead{font-size:12px}
 .bm-home__stat{padding:16px}
}
</style>

<main class="bm-home">
    <div class="bm-home__backdrop" aria-hidden="true">
        <img src="{{ theme_asset('balticm-background-web.webp') }}" alt="">
    </div>

    <section class="bm-home__hero">
        <div class="bm-home__wrap bm-home__hero-inner">
            <div class="bm-home__eyebrow">G A M I N G &nbsp; C O M M U N I T Y</div>
            <h1 class="bm-home__title">BALTICM<span>PLAY TOGETHER.</span></h1>
            <p class="bm-home__lead">A home for players, creators and communities. Play together. Grow together.</p>
        </div>
    </section>

    <section class="bm-home__content">
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
