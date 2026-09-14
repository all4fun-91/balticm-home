@extends('layouts.base')

@section('title', 'BalticM — Play Together')
@section('description', 'BalticM — a gaming community for players, creators and communities.')

@section('app')
<style>
html,body{overflow-x:hidden!important;background:#02050b!important}
main.bm-home-main{position:relative!important;margin:0!important;padding:0!important;min-height:100vh!important;background:#02050b!important;border:0!important;box-shadow:none!important;overflow:hidden!important}
main.bm-home-main *{box-sizing:border-box}
.bm-home-hero{position:relative;min-height:500px;overflow:hidden;background:#02050b}
.bm-home-art{position:absolute;inset:0;overflow:hidden;background:#02050b;z-index:0}
.bm-home-art img{position:absolute;left:-1%;top:-1%;width:102%;height:102%;max-width:none;object-fit:cover;object-position:center center;display:block}
.bm-home-shade{position:absolute;inset:0;background:linear-gradient(90deg,rgba(2,5,11,.72) 0%,rgba(2,5,11,.25) 46%,rgba(2,5,11,.04) 100%),linear-gradient(180deg,rgba(2,5,11,.08) 0%,rgba(2,5,11,.02) 65%,#02050b 100%);z-index:1;pointer-events:none}
.bm-home-content{position:relative;z-index:2;width:min(1200px,calc(100% - 48px));margin:0 auto;padding:82px 0 105px;color:#f5f8ff}
.bm-home-eyebrow{font-size:10px;font-weight:900;letter-spacing:.38em;color:#d9e6f6}
.bm-home-title{margin:17px 0 12px;font-size:clamp(64px,7.2vw,104px);line-height:.84;letter-spacing:-.065em;font-weight:800}
.bm-home-title span{display:block;color:#2f9cff}
.bm-home-lead{margin:0;max-width:560px;color:#d1dbea;font-size:14px;line-height:1.6}
.bm-home-stats{position:relative;z-index:4;width:min(1080px,calc(100% - 48px));margin:-82px auto 0;display:grid;grid-template-columns:repeat(4,1fr);background:rgba(4,12,22,.92);border:1px solid rgba(102,164,220,.2);border-radius:14px;overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.28)}
.bm-home-stat{min-height:86px;padding:18px 22px;border-right:1px solid rgba(102,164,220,.16)}
.bm-home-stat:last-child{border-right:0}
.bm-home-stat b{display:block;font-size:21px;color:#f5f8ff}
.bm-home-stat span{display:block;margin-top:5px;font-size:8px;letter-spacing:.14em;text-transform:uppercase;color:#8495ab}
.bm-home-body{position:relative;z-index:2;width:min(1080px,calc(100% - 48px));margin:18px auto 0;padding-bottom:48px}
.bm-home-message{padding:14px 16px;margin-bottom:12px;border:1px solid rgba(102,164,220,.16);border-radius:10px;background:rgba(5,13,24,.78);color:#a8b8cb;font-size:10px}
.bm-home-news{margin:0;padding:0;background:transparent;border:0}
.bm-home-news-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.bm-home-news-empty{grid-column:1/-1;padding:16px;color:#718198;font-size:10px}
.bm-home-news-card{display:block;min-height:150px;overflow:hidden;border:1px solid rgba(102,164,220,.16);border-radius:12px;background:rgba(4,11,20,.9);color:#f5f8ff;text-decoration:none;box-shadow:0 12px 30px rgba(0,0,0,.16)}
.bm-home-news-card:hover{color:#fff;border-color:rgba(73,171,255,.42);transform:translateY(-2px)}
.bm-home-news-card img{width:100%;height:105px;object-fit:cover;display:block}
.bm-home-news-top{display:flex;justify-content:space-between;padding:12px 14px 0;color:#39b8ff;font-size:8px;letter-spacing:.14em;font-weight:900}
.bm-home-news-top small{color:#718198;font-size:8px;letter-spacing:0;font-weight:500}
.bm-home-news-body{padding:8px 14px 14px}
.bm-home-news-body h3{margin:0 0 7px;font-size:14px;line-height:1.2}
.bm-home-news-body p{margin:0;color:#8798ae;font-size:9px;line-height:1.45}
.bm-home-footer{margin:0;padding:28px 24px 32px;background:#02050b;border:0!important;box-shadow:none!important;text-align:center;color:#66758a;font-size:8px;letter-spacing:.12em}
.bm-home-footer strong{color:#aebdd0}
footer.bm-footer-new{display:none!important;height:0!important;margin:0!important;padding:0!important;border:0!important;background:#02050b!important;box-shadow:none!important}

@media(max-width:900px){
.bm-home-hero{min-height:500px}
.bm-home-content{padding:65px 0 105px}
.bm-home-title{font-size:68px}
.bm-home-news-grid{grid-template-columns:1fr}
}
@media(max-width:600px){
.bm-home-content,.bm-home-body{width:calc(100% - 24px)}
.bm-home-content{padding:58px 0 110px}
.bm-home-title{font-size:54px}
.bm-home-lead{font-size:12px}
.bm-home-stats{width:calc(100% - 24px);grid-template-columns:1fr 1fr;margin-top:-88px}
.bm-home-stat{padding:16px;border-bottom:1px solid rgba(102,164,220,.16)}
.bm-home-stat:nth-child(2){border-right:0}
.bm-home-stat:nth-child(3),.bm-home-stat:nth-child(4){border-bottom:0}
.bm-home-stat b{font-size:18px}
}
</style>

<main class="bm-home-main">
    <section class="bm-home-hero">
        <div class="bm-home-art">
            <img src="{{ theme_asset('balticm-background-web.webp') }}" alt="">
        </div>
        <div class="bm-home-shade"></div>
        <div class="bm-home-content">
            <div class="bm-home-eyebrow">G A M I N G &nbsp; C O M M U N I T Y</div>
            <h1 class="bm-home-title">BALTICM<span>PLAY TOGETHER.</span></h1>
            <p class="bm-home-lead">A home for players, creators and communities. Play together. Grow together.</p>
        </div>
    </section>

    <section class="bm-home-stats">
        <div class="bm-home-stat"><b>{{ number_format(\Azuriom\Models\User::count()) }}</b><span>Community Members</span></div>
        <div class="bm-home-stat"><b>{{ $servers->count() }}+</b><span>Active Servers</span></div>
        <div class="bm-home-stat"><b>EU</b><span>Community</span></div>
        <div class="bm-home-stat"><b>24/7</b><span>Online Support</span></div>
    </section>

    <div class="bm-home-body">
        @if($message)
            <div class="bm-home-message">{{ $message }}</div>
        @endif

        <section class="bm-home-news" id="latest-news">
            <div class="bm-home-news-grid">
                @if($posts->isEmpty())
                    <div class="bm-home-news-empty">No news published yet. More BalticM updates are coming soon.</div>
                @else
                    @foreach($posts->take(3) as $post)
                        <a class="bm-home-news-card" href="{{ route('posts.show', $post->slug) }}">
                            <div class="bm-home-news-top"><span>NEWS</span><small>{{ format_date($post->created_at) }}</small></div>
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
                            @endif
                            <div class="bm-home-news-body">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </section>
    </div>

    <footer class="bm-home-footer"><strong>BALTICM</strong> · PLAY TOGETHER</footer>
</main>
@endsection
