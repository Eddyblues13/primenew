@extends('layouts.frontend')
@section('title', 'Features | Prime Trade Access')

@section('content')
    <!-- Hero -->
    <section class="hero" style="min-height: 50vh;">
        <div class="hero-bg"></div>
        <div class="hero-gradient-accent"></div>
        <div class="hero-green-accent"></div>
        <div class="hero-content" style="flex-direction: column; text-align: center;">
            <div class="hero-text" style="max-width: 800px;">
                <div class="section-label" style="text-align:center;">Our Features</div>
                <h1>Powerful Yet Simple</h1>
                <p style="margin: 0 auto 32px; max-width: 600px;">We take everything you need and make it accessible. Everything you need. Nothing you don't.</p>
                <a href="/register" class="hero-cta">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Advanced Security -->
    <section class="section" id="security" style="background: #111;">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-label">Advanced Security</div>
                    <div class="section-title">Your Assets Are Safe With Us</div>
                    <p class="section-desc">Experience robust security measures, including cold and hot wallet storage, multi-signature authorization, MPC technology protection, and regular security audits. Trade confidently, knowing your assets and personal information are safe.</p>
                    <ul style="list-style: none; padding: 0; margin-bottom: 32px;">
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Cold & hot wallet storage
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Multi-signature authorization
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> MPC technology protection
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Regular third-party audits
                        </li>
                    </ul>
                </div>
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px;">
                    <img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Security">
                </div>
            </div>
        </div>
    </section>

    <!-- Auto Invest -->
    <section class="section" id="invest" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="learn-grid">
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px; order: -1;">
                    <img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Auto Invest">
                </div>
                <div>
                    <div class="section-label">Auto Invest</div>
                    <div class="section-title">Set It and Forget It</div>
                    <p class="section-desc">Automate your crypto purchases with Dollar-Cost Averaging (DCA) and scheduled purchases to diversify your portfolio effortlessly. Set your strategy, and let Prime Trade Access handle the rest.</p>
                    <a href="/register" class="btn-lime">Start Auto Investing →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Advanced Order Types -->
    <section class="section" id="orders" style="background: #111;">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-label">Order Types</div>
                    <div class="section-title">Advanced Order Types for Every Strategy</div>
                    <p class="section-desc">Optimize your trades with limit orders, stop orders, trailing stop orders, fill or kill orders, and more. Execute your strategy with precision using our powerful order engine.</p>
                    <ul style="list-style: none; padding: 0; margin-bottom: 32px;">
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Limit Orders
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Stop & Trailing Stop
                        </li>
                        <li style="padding: 10px 0; color: rgba(255,255,255,0.7); font-size: 15px; display: flex; align-items: center; gap: 10px;">
                            <span style="color: var(--ndax-lime); font-weight: 700;">✓</span> Fill or Kill (FOK)
                        </li>
                    </ul>
                    <a href="/register" class="btn-lime">Start Trading →</a>
                </div>
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px;">
                    <img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Order Types">
                </div>
            </div>
        </div>
    </section>

    <!-- Affiliate Rewards -->
    <section class="section" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="learn-grid">
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px; order: -1;">
                    <img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Affiliate">
                </div>
                <div>
                    <div class="section-label">Affiliate Rewards</div>
                    <div class="section-title">Earn While You Share</div>
                    <p class="section-desc">Earn rewards through our affiliate program by sharing your unique link and inviting others to join Prime Trade Access. Receive bonuses for each qualifying referral.</p>
                    <a href="/register" class="btn-lime">Join Affiliate Program →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Address Book -->
    <section class="section" id="address" style="background: #111;">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-label">Address Book</div>
                    <div class="section-title">Manage Your Crypto Addresses</div>
                    <p class="section-desc">Effortlessly manage crypto transactions with our Address Book: store addresses, execute withdrawals directly, enhance security with whitelisting, and access comprehensive transaction histories.</p>
                    <a href="/register" class="btn-lime">Get Started →</a>
                </div>
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px;">
                    <img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Address Book">
                </div>
            </div>
        </div>
    </section>

    <!-- Tax Reporting -->
    <section class="section" id="tax" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="learn-grid">
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px; order: -1;">
                    <img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Tax Reporting">
                </div>
                <div>
                    <div class="section-label">Tax Reporting</div>
                    <div class="section-title">Crypto Taxes Made Easy</div>
                    <p class="section-desc">Prime Trade Access makes tax reporting easy with comprehensive reports and tax software integration, helping you file your crypto taxes effortlessly.</p>
                    <a href="/register" class="btn-lime">Learn More →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section careers-section">
        <div class="section-inner">
            <div class="careers-card">
                <div class="careers-label">Ready To Get Started?</div>
                <h2 class="careers-title">Experience Premium<br>Trading Features.</h2>
                <a href="/register" class="btn-lime">Create Account →</a>
            </div>
        </div>
    </section>
@endsection
