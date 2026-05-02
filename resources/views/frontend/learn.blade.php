@extends('layouts.frontend')
@section('title', 'Learn | Prime Trade Access')

@section('content')
    <!-- Hero -->
    <section class="hero" style="min-height: 50vh;">
        <div class="hero-bg"></div>
        <div class="hero-gradient-accent"></div>
        <div class="hero-green-accent"></div>
        <div class="hero-content" style="flex-direction: column; text-align: center;">
            <div class="hero-text" style="max-width: 800px;">
                <div class="section-label" style="text-align:center;">Learn & Blog</div>
                <h1>Crypto Shouldn't Be Cryptic</h1>
                <p style="margin: 0 auto 32px; max-width: 600px;">We're more than a trading platform — we're your resource to learn, expand your understanding, and achieve your trading objectives.</p>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="section blog-section" id="blog" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="crypto-header">
                <div>
                    <div class="section-title">Latest Articles</div>
                    <p class="section-desc" style="margin-bottom:0;">All that's new and improved in the world of crypto, from news to tutorials to market insights.</p>
                </div>
            </div>
            <div class="blog-grid" style="margin-top: 40px;">
                <!-- Article 1 -->
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_trading.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <div style="font-size: 12px; color: var(--ndax-lime); margin-bottom: 8px; font-weight: 600;">Market Insights</div>
                        <h3>Prime Trade Access Ice Playoffs Are Here! Make Picks. Climb the Leaderboard. Win Bigger.</h3>
                        <a href="{{ route('frontend.blog.article', 'ice-playoffs') }}" class="read-link" style="margin-top: auto;">Read Article →</a>
                    </div>
                </div>
                <!-- Article 2 -->
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_passive.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <div style="font-size: 12px; color: var(--ndax-lime); margin-bottom: 8px; font-weight: 600;">Tutorials</div>
                        <h3>Staking on Prime Trade Access: How You Could Earn Rewards in a Volatile Market</h3>
                        <a href="{{ route('frontend.blog.article', 'staking-guide') }}" class="read-link" style="margin-top: auto;">Read Article →</a>
                    </div>
                </div>
                <!-- Article 3 -->
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_trading.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <div style="font-size: 12px; color: var(--ndax-lime); margin-bottom: 8px; font-weight: 600;">Education</div>
                        <h3>What Is the Fear and Greed Index in Crypto?</h3>
                        <a href="{{ route('frontend.blog.article', 'fear-and-greed-index') }}" class="read-link" style="margin-top: auto;">Read Article →</a>
                    </div>
                </div>
                <!-- Article 4 -->
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_passive.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <div style="font-size: 12px; color: var(--ndax-lime); margin-bottom: 8px; font-weight: 600;">Platform News</div>
                        <h3>Understanding Advanced Order Types: A Comprehensive Guide</h3>
                        <a href="{{ route('frontend.blog.article', 'advanced-orders') }}" class="read-link" style="margin-top: auto;">Read Article →</a>
                    </div>
                </div>
                <!-- Article 5 -->
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_trading.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <div style="font-size: 12px; color: var(--ndax-lime); margin-bottom: 8px; font-weight: 600;">Education</div>
                        <h3>How to Secure Your Crypto Assets in 2026</h3>
                        <a href="{{ route('frontend.blog.article', 'security-guide') }}" class="read-link" style="margin-top: auto;">Read Article →</a>
                    </div>
                </div>
                <!-- Article 6 -->
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_passive.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <div style="font-size: 12px; color: var(--ndax-lime); margin-bottom: 8px; font-weight: 600;">Market Insights</div>
                        <h3>The Role of Institutional Adoption in Crypto's Future</h3>
                        <a href="{{ route('frontend.blog.article', 'institutional-adoption') }}" class="read-link" style="margin-top: auto;">Read Article →</a>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 60px;">
                <button class="btn-outline">Load More Articles</button>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section careers-section">
        <div class="section-inner">
            <div class="careers-card">
                <div class="careers-label">Knowledge is Power</div>
                <h2 class="careers-title">Apply Your Knowledge.<br>Start Trading.</h2>
                <a href="/register" class="btn-lime">Create Account →</a>
            </div>
        </div>
    </section>
@endsection
