@extends('layouts.base')

@section('title', 'BalticM — Play Together')
@section('description', 'BalticM — a gaming community for players, creators and communities.')

@section('app')
<style>
    .bm-footer { border-top: 1px solid var(--bm-line) !important; }
    .bm-copy { border-top: 0 !important; }
    html, body { overflow-x: hidden !important; }
    .bm-community-strip {
        margin-left: calc(50% - 50vw) !important;
        margin-right: calc(50% - 50vw) !important;
        padding-left: max(24px, calc((100vw - 1200px) / 2)) !important;
        padding-right: max(24px, calc((100vw - 1200px) / 2)) !important;
        width: auto !important;
        border-top: 0 !important;
        border-bottom: 0 !important;
    }
</style>
<main>
    <section class="bm-hero">
        <div class="bm-hero-art">
            <div class="bm-glow"></div>
            <div class="bm-moon"></div>
            <div class="bm-city"></div>
            <div class="bm-figure"></div>
            <div class="bm-scan"></div>
        </div>
        <div class="bm-wrap bm-hero-inner">
            <div class="bm-eyebrow">G A M I N G &nbsp; C O M M U N I T Y</div>
            <h1>BALTICM<span>PLAY TOGETHER.</span></h1>
            <p class="bm-lead">A home for players, creators and communities. Play together. Grow together.</p>
        </div>
    </section>

    <div class="bm-wrap">
        <section class="bm-stats">
            <div class="bm-stat"><b>{{ number_format(\Azuriom\Models\User::count()) }}</b><span>Community Members</span></div>
            <div class="bm-stat"><b>{{ $servers->count() }}+</b><span>Active Servers</span></div>
            <div class="bm-stat"><b>EU</b><span>Community</span></div>
            <div class="bm-stat"><b>24/7</b><span>Online Support</span></div>
        </section>

        @if($message)
            <section class="bm-message">{{ $message }}</section>
        @endif

        <section class="bm-latest" id="latest-news">
            <div class="bm-news-grid">
                @if($posts->isEmpty())
                    <div class="bm-news-empty">No news published yet. More BalticM updates are coming soon.</div>
                @else
                    @foreach($posts->take(3) as $post)
                        <a class="bm-news-card" href="{{ route('posts.show', $post->slug) }}">
                            <div class="bm-news-topline">
                                <span>NEWS</span>
                                <small>{{ format_date($post->created_at) }}</small>
                            </div>
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
                            @endif
                            <div class="bm-news-body">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                <span class="bm-read">READ STORY <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </section>

        <section class="bm-cta">
            <div>
                <div class="bm-cta-label">BALTICM COMMUNITY</div>
                <h2>PLAY TOGETHER. ANYTIME. ANYWHERE.</h2>
                <p>Join our community and be part of something bigger.</p>
            </div>
            <a class="bm-btn bm-primary" href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener">
                <i class="bi bi-discord"></i> JOIN OUR DISCORD
            </a>
        </section>

        <section class="bm-community-strip">
            <div><i class="bi bi-people-fill"></i><span><b>Active Community</b><small>Players from all over Europe</small></span></div>
            <div><i class="bi bi-shield-fill-check"></i><span><b>Secure &amp; Stable</b><small>Reliable gaming experience</small></span></div>
            <div><i class="bi bi-controller"></i><span><b>Multiple Games</b><small>More titles coming soon</small></span></div>
            <div><i class="bi bi-heart"></i><span><b>Built Together</b><small>By the community, for the community</small></span></div>
        </section>
    </div>
</main>
@endsection
