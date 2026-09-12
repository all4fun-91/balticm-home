@extends('layouts.base')

@section('title', 'BalticM — Play Together')
@section('description', 'BalticM — a gaming community for players, creators and communities.')

@section('app')
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
            <div class="bm-actions">
                <a class="bm-btn bm-primary" href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener">JOIN OUR DISCORD <i class="bi bi-arrow-right"></i></a>
                @if($server && $server->joinUrl())
                    <a class="bm-btn" href="{{ $server->joinUrl() }}">JOIN SERVER <i class="bi bi-arrow-right"></i></a>
                @else
                    <a class="bm-btn" href="#latest-news">EXPLORE BALTICM <i class="bi bi-arrow-right"></i></a>
                @endif
            </div>
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
            <div class="bm-section-title">
                <div><h2>LATEST NEWS</h2><span>Stay up to date with BalticM</span></div>
                @if(Route::has('posts.index'))
                    <a class="bm-btn" href="{{ route('posts.index') }}">VIEW ALL <i class="bi bi-arrow-right"></i></a>
                @endif
            </div>

            @if($posts->isEmpty())
                <div class="bm-news-empty">No news published yet. More BalticM updates are coming soon.</div>
            @else
                <div class="bm-news-grid">
                    @foreach($posts->take(3) as $post)
                        <a class="bm-news-card" href="{{ route('posts.show', $post->slug) }}">
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
                            @endif
                            <div class="bm-news-body">
                                <small>{{ format_date($post->created_at) }}</small>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="bm-feature-grid">
            <article class="bm-feature">
                <div class="bm-feature-icon"><i class="bi bi-controller"></i></div>
                <h3>PLAY TOGETHER</h3>
                <p>Gaming servers, events and a community built around playing together.</p>
                <a class="bm-go" href="#latest-news">EXPLORE <i class="bi bi-arrow-right"></i></a>
            </article>
            <article class="bm-feature">
                <div class="bm-feature-icon"><i class="bi bi-shield-check"></i></div>
                <h3>BUILT FOR COMMUNITY</h3>
                <p>Profiles, forums, rewards, shop systems and everything your community needs.</p>
                <a class="bm-go" href="{{ route('home') }}">DISCOVER <i class="bi bi-arrow-right"></i></a>
            </article>
        </section>

        <section class="bm-cta">
            <div><h2>PLAY TOGETHER. ANYTIME. ANYWHERE.</h2><p>Join our community and be part of something bigger.</p></div>
            <a class="bm-btn bm-primary" href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener">JOIN OUR DISCORD <i class="bi bi-arrow-right"></i></a>
        </section>
    </div>
</main>
@endsection
