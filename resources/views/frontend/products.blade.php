@extends('layouts.frontend')
@section('title', 'Products | Prime Trade Access')

@section('content')
    <!-- Hero -->
    <section class="hero" style="min-height: 50vh;">
        <div class="hero-bg"></div>
        <div class="hero-gradient-accent"></div>
        <div class="hero-green-accent"></div>
        <div class="hero-content" style="flex-direction: column; text-align: center;">
            <div class="hero-text" style="max-width: 800px;">
                <div class="section-label" style="text-align:center;">Our Products</div>
                <h1>Everything You Need To Trade With Confidence</h1>
                <p style="margin: 0 auto 32px; max-width: 600px;">From simple buy & sell to advanced order types and OTC desks — Prime Trade Access has the right tool for every trader.</p>
                <a href="/register" class="hero-cta">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Simple Trading -->
    <section class="section" id="simple" style="background: #111;">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-label">Simple Trading</div>
                    <div class="section-title">Buy & Sell Crypto Instantly</div>
                    <p class="section-desc">Our Simple Trade platform makes it easy for anyone to buy and sell cryptocurrency. Just select your asset, enter an amount, and execute your trade instantly.</p>
                    <ul style="list-style: none; padding: 0; margin-bottom: 32px;">
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> One-click buy & sell
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Real-time market pricing
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Beginner-friendly interface
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Instant order execution
                        </li>
                    </ul>
                    <a href="/register" class="btn-lime">Start Trading →</a>
                </div>
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px;">
                    <img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Simple Trading">
                </div>
            </div>
        </div>
    </section>

    <!-- Advanced Trading -->
    <section class="section" id="advanced" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="learn-grid">
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px; order: -1;">
                    <img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Advanced Trading">
                </div>
                <div>
                    <div class="section-label">Advanced Trading</div>
                    <div class="section-title">Professional-Grade Trading Tools</div>
                    <p class="section-desc">Access our full-featured trading engine with advanced charting, multiple order types, real-time market data, and deep liquidity pools designed for serious traders.</p>
                    <ul style="list-style: none; padding: 0; margin-bottom: 32px;">
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Limit, Stop, and Trailing orders
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> TradingView charting integration
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Real-time order book depth
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> API access for bots
                        </li>
                    </ul>
                    <a href="/register" class="btn-lime">Start Trading →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Staking -->
    <section class="section" id="staking" style="background: #111;">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-label">Staking</div>
                    <div class="section-title">Earn Passive Income on Your Crypto</div>
                    <p class="section-desc">Put your digital assets to work. Stake supported cryptocurrencies and earn competitive rewards — all within the security of the Prime Trade Access platform.</p>
                    <ul style="list-style: none; padding: 0; margin-bottom: 32px;">
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Earn daily, weekly, or monthly
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> No lock-up period on select assets
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Auto-compounding rewards
                        </li>
                    </ul>
                    <a href="/register" class="btn-lime">Start Earning →</a>
                </div>
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px;">
                    <img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Staking">
                </div>
            </div>
        </div>
    </section>

    <!-- Wealth OTC -->
    <section class="section" id="otc" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="learn-grid">
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px; order: -1;">
                    <img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="OTC Desk">
                </div>
                <div>
                    <div class="section-label">Wealth (OTC)</div>
                    <div class="section-title">White-Glove Service for High-Volume Trades</div>
                    <p class="section-desc">Personalized, over-the-counter trading for high-net-worth individuals and institutions. Access deep liquidity pools, a broad selection of digital assets, and dedicated account management.</p>
                    <a href="/register" class="btn-lime">Contact Wealth Team →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Fees -->
    <section class="section" id="fees" style="background: #111;">
        <div class="section-inner" style="text-align: center;">
            <div class="section-label" style="text-align:center;">Transparent Pricing</div>
            <div class="section-title" style="margin: 0 auto 24px; text-align: center;">Simple, Competitive Fees</div>
            <p class="section-desc" style="margin: 0 auto 60px; text-align: center;">No hidden charges. What you see is what you pay.</p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; max-width: 900px; margin: 0 auto;">
                <div class="plan-card" style="text-align: center;">
                    <div style="font-size: 14px; font-weight: 600; color: var(--ndax-lime); text-transform: uppercase; letter-spacing: 1px;">Trading Fee</div>
                    <div style="font-size: 48px; font-weight: 800; color: #fff;">0.2%</div>
                    <div style="font-size: 14px; color: rgba(255,255,255,0.5);">Per trade, maker & taker</div>
                </div>
                <div class="plan-card" style="text-align: center;">
                    <div style="font-size: 14px; font-weight: 600; color: var(--ndax-lime); text-transform: uppercase; letter-spacing: 1px;">Deposits</div>
                    <div style="font-size: 48px; font-weight: 800; color: #fff;">Free</div>
                    <div style="font-size: 14px; color: rgba(255,255,255,0.5);">CAD & crypto deposits</div>
                </div>
                <div class="plan-card" style="text-align: center;">
                    <div style="font-size: 14px; font-weight: 600; color: var(--ndax-lime); text-transform: uppercase; letter-spacing: 1px;">Withdrawals</div>
                    <div style="font-size: 48px; font-weight: 800; color: #fff;">Low</div>
                    <div style="font-size: 14px; color: rgba(255,255,255,0.5);">Competitive flat-rate fees</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section careers-section">
        <div class="section-inner">
            <div class="careers-card">
                <div class="careers-label">Ready To Trade?</div>
                <h2 class="careers-title">Start Your Crypto Journey<br>Today.</h2>
                <a href="/register" class="btn-lime">Create Account →</a>
            </div>
        </div>
    </section>
@endsection
