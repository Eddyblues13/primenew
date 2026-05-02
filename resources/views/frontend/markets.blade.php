@extends('layouts.frontend')
@section('title', 'Markets | Prime Trade Access')

@section('content')
    <!-- Hero -->
    <section class="hero" style="min-height: 50vh;">
        <div class="hero-bg"></div>
        <div class="hero-gradient-accent"></div>
        <div class="hero-green-accent"></div>
        <div class="hero-content" style="flex-direction: column; text-align: center;">
            <div class="hero-text" style="max-width: 800px;">
                <div class="section-label" style="text-align:center;">Our Markets</div>
                <h1>Explore Supported Assets</h1>
                <p style="margin: 0 auto 32px; max-width: 600px;">Trade a wide selection of top cryptocurrencies with deep liquidity, tight spreads, and instant execution.</p>
                <a href="/register" class="hero-cta">Start Trading</a>
            </div>
        </div>
    </section>

    <!-- Markets Table Section -->
    <section class="section" style="background: #111;">
        <div class="section-inner">
            <div class="section-label">Live Pricing</div>
            <div class="section-title">Cryptocurrency Markets</div>
            <p class="section-desc">View real-time prices, 24h volume, and market caps for all supported digital assets.</p>
            
            <div style="background: var(--ndax-dark); border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); overflow: hidden; margin-top: 40px;">
                <div style="padding: 20px 32px; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1px;">
                    <div>Asset</div>
                    <div style="text-align: right;">Price</div>
                    <div style="text-align: right;">24h Change</div>
                    <div style="text-align: right;">Market Cap</div>
                </div>
                
                <!-- Bitcoin -->
                <div style="padding: 24px 32px; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; border-bottom: 1px solid rgba(255,255,255,0.02); align-items: center; transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 40px; height: 40px; background: #F7931A; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">₿</div>
                        <div>
                            <div style="font-weight: 700; font-size: 16px;">Bitcoin</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.5);">BTC</div>
                        </div>
                    </div>
                    <div style="text-align: right; font-weight: 600;">$64,230.50</div>
                    <div style="text-align: right; font-weight: 600; color: var(--ndax-lime);">+2.45%</div>
                    <div style="text-align: right; color: rgba(255,255,255,0.7);">$1.2T</div>
                </div>

                <!-- Ethereum -->
                <div style="padding: 24px 32px; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; border-bottom: 1px solid rgba(255,255,255,0.02); align-items: center; transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 40px; height: 40px; background: #627EEA; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">Ξ</div>
                        <div>
                            <div style="font-weight: 700; font-size: 16px;">Ethereum</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.5);">ETH</div>
                        </div>
                    </div>
                    <div style="text-align: right; font-weight: 600;">$3,450.20</div>
                    <div style="text-align: right; font-weight: 600; color: var(--ndax-lime);">+1.80%</div>
                    <div style="text-align: right; color: rgba(255,255,255,0.7);">$415B</div>
                </div>

                <!-- Solana -->
                <div style="padding: 24px 32px; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; border-bottom: 1px solid rgba(255,255,255,0.02); align-items: center; transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #14F195, #9945FF); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">S</div>
                        <div>
                            <div style="font-weight: 700; font-size: 16px;">Solana</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.5);">SOL</div>
                        </div>
                    </div>
                    <div style="text-align: right; font-weight: 600;">$145.80</div>
                    <div style="text-align: right; font-weight: 600; color: #ff4444;">-0.50%</div>
                    <div style="text-align: right; color: rgba(255,255,255,0.7);">$65B</div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="/register" class="btn-outline">View All Markets →</a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section careers-section">
        <div class="section-inner">
            <div class="careers-card">
                <div class="careers-label">Deep Liquidity</div>
                <h2 class="careers-title">Trade Top Assets With<br>Unmatched Speed.</h2>
                <a href="/register" class="btn-lime">Start Trading →</a>
            </div>
        </div>
    </section>
@endsection
