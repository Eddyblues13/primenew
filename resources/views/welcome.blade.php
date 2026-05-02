@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-bg"></div>
        <div class="hero-gradient-accent"></div>
        <div class="hero-green-accent"></div>
        <div class="hero-card"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1>Trust Is The<br>New Currency</h1>
                <p>Stepping into the future shouldn't require a leap of faith. Prime Trade Access has the experience and expertise to
                    guide you every step of the way and the track record to back it up.</p>
                <a href="#" class="hero-cta">Get Started</a>
            </div>
            <div class="hero-coins">
                <div class="coin coin-btc">
                    <img src="{{ asset('images/bitcoin-coin.png') }}" alt="Bitcoin" loading="eager">
                </div>
                <div class="coin coin-pink">
                    <img src="{{ asset('images/pink-coin.png') }}" alt="Crypto coin" loading="eager">
                </div>
                <div class="coin coin-silver">
                    <img src="{{ asset('images/silver-coin.png') }}" alt="Silver coin" loading="eager">
                </div>
            </div>
        </div>
    </section>

    <!-- Crypto Prices Section -->
    <section class="section crypto-prices" id="cryptoPrices">
        <div class="section-inner">
            <div class="crypto-header">
                <h2 class="section-title">Crypto Prices</h2>
                <a href="#" class="btn-outline">View All →</a>
            </div>
            <div class="price-grid">
                <div class="price-card">
                    <div class="price-card-top">
                        <div class="price-coin-icon" style="background:#f7931a;color:#fff;">₿</div>
                        <div>
                            <div class="price-coin-name">Bitcoin</div>
                            <div class="price-coin-symbol">BTC</div>
                        </div>
                    </div>
                    <div class="price-value">$96,432.10</div>
                    <div class="price-change price-up">▲ +2.34%</div>
                </div>
                <div class="price-card">
                    <div class="price-card-top">
                        <div class="price-coin-icon" style="background:#627eea;color:#fff;">Ξ</div>
                        <div>
                            <div class="price-coin-name">Ethereum</div>
                            <div class="price-coin-symbol">ETH</div>
                        </div>
                    </div>
                    <div class="price-value">$1,838.45</div>
                    <div class="price-change price-up">▲ +1.87%</div>
                </div>
                <div class="price-card">
                    <div class="price-card-top">
                        <div class="price-coin-icon" style="background:#26a17b;color:#fff;">₮</div>
                        <div>
                            <div class="price-coin-name">Tether</div>
                            <div class="price-coin-symbol">USDT</div>
                        </div>
                    </div>
                    <div class="price-value">$1.00</div>
                    <div class="price-change price-up">▲ +0.01%</div>
                </div>
                <div class="price-card">
                    <div class="price-card-top">
                        <div class="price-coin-icon" style="background:#2775ca;color:#fff;">S</div>
                        <div>
                            <div class="price-coin-name">Solana</div>
                            <div class="price-coin-symbol">SOL</div>
                        </div>
                    </div>
                    <div class="price-value">$152.78</div>
                    <div class="price-change price-down">▼ -0.45%</div>
                </div>
                <div class="price-card">
                    <div class="price-card-top">
                        <div class="price-coin-icon" style="background:#0033ad;color:#fff;">X</div>
                        <div>
                            <div class="price-coin-name">XRP</div>
                            <div class="price-coin-symbol">XRP</div>
                        </div>
                    </div>
                    <div class="price-value">$2.21</div>
                    <div class="price-change price-up">▲ +3.12%</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Investment Plans Section -->
    <section class="section plans-section" id="investment-plans">
        <div class="section-inner">
            <div class="section-label">Investment Vehicles</div>
            <div class="section-title">Institutional-grade investment plans.</div>
            <p class="section-desc">Choose a plan that fits your strategy. From high-growth Tesla stock indices to diversified Crypto portfolios.</p>
            
            <div class="tab-nav" id="planTabs">
                <button class="tab-btn active" data-tab="plan-tesla">Tesla Investment</button>
                <button class="tab-btn" data-tab="plan-crypto">Crypto Investment</button>
            </div>

            <!-- Tesla Plans -->
            <div class="tab-content active" id="plan-tesla">
                <div class="price-grid" style="width: 100%;">
                    @foreach($teslaPlans as $plan)
                    <div class="price-card" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div class="price-card-top">
                                <div class="price-coin-icon" style="background: var(--ndax-lime); color: #000;">⚡</div>
                                <div>
                                    <div class="price-coin-name">{{ $plan->name }}</div>
                                    <div class="price-coin-symbol">Tesla Index</div>
                                </div>
                            </div>
                            <div class="price-value" style="color: var(--ndax-lime);">{{ $plan->roi_percent }}% ROI</div>
                            <div class="price-change" style="margin-bottom: 20px;">Duration: {{ $plan->duration_days }} Days</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.6; margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span>Min Deposit:</span>
                                    <span style="color: #fff;">${{ number_format($plan->min_amount) }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Max Deposit:</span>
                                    <span style="color: #fff;">${{ number_format($plan->max_amount) }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('register') }}" class="btn-lime" style="width: 100%; justify-content: center; text-align: center;">Invest Now</a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Crypto Plans -->
            <div class="tab-content" id="plan-crypto">
                <div class="price-grid" style="width: 100%;">
                    @foreach($cryptoPlans as $plan)
                    <div class="price-card" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div class="price-card-top">
                                <div class="price-coin-icon" style="background: #4444ff; color: #fff;">₿</div>
                                <div>
                                    <div class="price-coin-name">{{ $plan->name }}</div>
                                    <div class="price-coin-symbol">Crypto Portfolio</div>
                                </div>
                            </div>
                            <div class="price-value" style="color: #4444ff;">{{ $plan->roi_percent }}% ROI</div>
                            <div class="price-change" style="margin-bottom: 20px;">Duration: {{ $plan->duration_days }} Days</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.6; margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span>Min Deposit:</span>
                                    <span style="color: #fff;">${{ number_format($plan->min_amount) }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Max Deposit:</span>
                                    <span style="color: #fff;">${{ number_format($plan->max_amount) }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('register') }}" class="btn-lime" style="width: 100%; justify-content: center; text-align: center;">Invest Now</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Our Products Section -->
    <section class="section products-section" id="products">
        <div class="section-inner">
            <div class="section-label">Our Products</div>
            <div class="section-title">Whatever you need. Wherever you need it.</div>
            <p class="section-desc">We've got you covered.</p>
            <a href="#" class="btn-outline" style="margin-bottom:40px;">View All →</a>
            <div class="tab-nav" id="productTabs">
                <button class="tab-btn active" data-tab="prod-earn">Earn Passive Income</button>
                <button class="tab-btn" data-tab="prod-advanced">Advanced Trading</button>
                <button class="tab-btn" data-tab="prod-simple">Simple Trading</button>
                <button class="tab-btn" data-tab="prod-otc">Wealth (OTC)</button>
                <button class="tab-btn" data-tab="prod-fees">Fees</button>
            </div>
            <div class="tab-content active" id="prod-earn">
                <div class="tab-text">
                    <h3>Earn Passive Income</h3>
                    <p>Unlock up to 13% APY on top cryptocurrencies like Ethereum, Cardano, and more. Experience secure
                        and reliable passive income with our easy-to-use staking platform.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Passive Income"></div>
            </div>
            <div class="tab-content" id="prod-advanced">
                <div class="tab-text">
                    <h3>Advanced Trading</h3>
                    <p>Discover powerful tools for traders: an intuitive interface, customizable charts, seamless order
                        execution, multiple order types, real-time market data, and technical indicators.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Advanced Trading"></div>
            </div>
            <div class="tab-content" id="prod-simple">
                <div class="tab-text">
                    <h3>Simple Trading</h3>
                    <p>Benefit from the convenience of one-click trading, allowing you to place buy and sell orders
                        instantly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Simple Trading"></div>
            </div>
            <div class="tab-content" id="prod-otc">
                <div class="tab-text">
                    <h3>Wealth (OTC)</h3>
                    <p>Personalized, over-the-counter trading services for high-net-worth individuals seeking private,
                        secure, high-volume trades. Access deep liquidity pools, a broad selection of digital assets,
                        and personalized service.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Wealth OTC"></div>
            </div>
            <div class="tab-content" id="prod-fees">
                <div class="tab-text">
                    <h3>Fees</h3>
                    <p>Benefit from a transparent fee structure, including a 0.2% trading fee, free Canadian dollar and
                        crypto deposits, and competitive withdrawal fees. Enjoy multiple funding options and multichain
                        support for cheaper withdrawals.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Fees"></div>
            </div>
        </div>
    </section>

    <!-- Crypto Shouldn't Be Cryptic -->
    <section class="section learn-section" id="learn">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-title">Crypto Shouldn't Be Cryptic</div>
                    <p class="section-desc">We're so much more than a trading platform — we're the one resource that's
                        here to help you learn, expand your understanding, and achieve your trading objectives.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="learn-visual"></div>
            </div>
        </div>
    </section>

    <!-- Our Features Section -->
    <section class="section features-section" id="features">
        <div class="section-inner">
            <div class="section-label">Our Features</div>
            <div class="section-title">Powerful yet simple.</div>
            <p class="section-desc">We take everything you need and make it accessible. Everything you need. Nothing you
                don't.</p>
            <a href="#" class="btn-outline" style="margin-bottom:40px;">View All →</a>
            <div class="tab-nav" id="featureTabs">
                <button class="tab-btn active" data-tab="feat-security">Advanced Security</button>
                <button class="tab-btn" data-tab="feat-invest">Auto Invest</button>
                <button class="tab-btn" data-tab="feat-orders">Advanced Order Types</button>
                <button class="tab-btn" data-tab="feat-affiliate">Affiliate Rewards</button>
                <button class="tab-btn" data-tab="feat-address">Address Book</button>
                <button class="tab-btn" data-tab="feat-tax">Tax Reporting</button>
            </div>
            <div class="tab-content active" id="feat-security">
                <div class="tab-text">
                    <h3>Advanced Security</h3>
                    <p>Experience robust security measures, such as cold and hot wallet storage, multi-signature
                        authorization, MPC technology protection, and regular security audits. Trade confidently,
                        knowing your assets and personal information are safe.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Security"></div>
            </div>
            <div class="tab-content" id="feat-invest">
                <div class="tab-text">
                    <h3>Auto Invest</h3>
                    <p>Automate your crypto purchases with Prime Trade Access' Auto Invest. Utilize Dollar-Cost Averaging (DCA) and
                        scheduled purchases to diversify your portfolio effortlessly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Auto Invest"></div>
            </div>
            <div class="tab-content" id="feat-orders">
                <div class="tab-text">
                    <h3>Advanced Order Types</h3>
                    <p>Optimize your trades with Prime Trade Access' advanced order types, including limit orders, stop orders,
                        trailing stop orders, fill or kill orders and more.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Advanced Order Types"></div>
            </div>
            <div class="tab-content" id="feat-affiliate">
                <div class="tab-text">
                    <h3>Affiliate Rewards</h3>
                    <p>Earn rewards through our affiliate program by sharing your unique link and inviting others to
                        join Prime Trade Access. Receive bonuses for each qualifying referral.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Affiliate Rewards"></div>
            </div>
            <div class="tab-content" id="feat-address">
                <div class="tab-text">
                    <h3>Address Book</h3>
                    <p>Effortlessly manage crypto transactions with Prime Trade Access' Address Book: store addresses, execute
                        withdrawals directly, enhance security with whitelisting, and access comprehensive transaction
                        histories.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Address Book"></div>
            </div>
            <div class="tab-content" id="feat-tax">
                <div class="tab-text">
                    <h3>Tax Reporting</h3>
                    <p>Prime Trade Access makes tax reporting easy with comprehensive reports and tax software integration, helping
                        you file your crypto taxes effortlessly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Tax Reporting"></div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testimonials" id="testimonials">
        <div class="section-inner">
            <div class="section-title">Don't Believe Us…</div>
            <p class="section-desc">We would say we're great. But don't believe us — listen to them.</p>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <div class="testimonial-text">I have been using Prime Trade Access for 3+ years and have had nothing but great
                        experiences! I trust them with all my crypto needs and appreciate all they do to give access to
                        the vast majority of legitimate cryptocurrencies...</div>
                    <div class="testimonial-author">
                        <span class="testimonial-name">— Travis S.</span>
                        <a href="#" class="testimonial-link">Read on Google</a>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <div class="testimonial-text">There are only a couple of good Canadian exchanges in my opinion. Prime Trade Access
                        is pretty much at the top of my list, and I have tried all Canadian exchanges. Spreads are good,
                        fees are competitive...</div>
                    <div class="testimonial-author">
                        <span class="testimonial-name">— Tony B.</span>
                        <a href="#" class="testimonial-link">Read on Google</a>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <div class="testimonial-text">Best Canadian crypto exchange and they keep growing to offer more
                        products. Easy to use and will be a long-term supporter and customer.</div>
                    <div class="testimonial-author">
                        <span class="testimonial-name">— Ron M.</span>
                        <a href="#" class="testimonial-link">Read on Google</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ready For Business -->
    <section class="section business-section" id="business">
        <div class="section-inner">
            <div class="section-label">Ready For Business</div>
            <div class="section-title">Looking to leverage the power of crypto for your customers?</div>
            <p class="section-desc">We have a range of solutions that can help.</p>
            <a href="#" class="btn-outline" style="margin-bottom:40px;">View All →</a>
            <div class="tab-nav" id="businessTabs">
                <button class="tab-btn active" data-tab="biz-treasury">Treasury Service</button>
                <button class="tab-btn" data-tab="biz-institutional">Institutional Solutions</button>
                <button class="tab-btn" data-tab="biz-liquidity">Liquidity Provider</button>
                <button class="tab-btn" data-tab="biz-whitelabel">White Label</button>
                <button class="tab-btn" data-tab="biz-mining">Crypto Mining</button>
                <button class="tab-btn" data-tab="biz-otc">OTC Desk</button>
                <button class="tab-btn" data-tab="biz-referrals">Referrals</button>
                <button class="tab-btn" data-tab="biz-finance">Financial Institutions</button>
            </div>
            <div class="tab-content active" id="biz-treasury">
                <div class="tab-text">
                    <h3>Treasury Service</h3>
                    <p>Prime Trade Access' Treasury Service provides businesses a secure environment for managing cryptocurrencies,
                        offering custody, trading, and staking within a robust security framework.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Treasury"></div>
            </div>
            <div class="tab-content" id="biz-institutional">
                <div class="tab-text">
                    <h3>Institutional Solutions</h3>
                    <p>Explore digital assets and Web3 products with Prime Trade Access' institutional solutions, allowing you to
                        integrate digital assets into your product offering seamlessly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Institutional"></div>
            </div>
            <div class="tab-content" id="biz-liquidity">
                <div class="tab-text">
                    <h3>Liquidity Provider</h3>
                    <p>Prime Trade Access offers businesses access to extensive liquidity pools, competitive spreads, and low trading
                        fees, enhancing the efficiency of high-volume cryptocurrency transactions.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Liquidity"></div>
            </div>
            <div class="tab-content" id="biz-whitelabel">
                <div class="tab-text">
                    <h3>White Label Trade Platform</h3>
                    <p>Empower your business with Prime Trade Access' plug-and-play white-label trading platform, providing
                        comprehensive solutions for acquiring cryptocurrency.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="White Label"></div>
            </div>
            <div class="tab-content" id="biz-mining">
                <div class="tab-text">
                    <h3>Crypto Mining</h3>
                    <p>Prime Trade Access offers crypto miners access to deep liquidity pools, robust security, and comprehensive
                        solutions to streamline operations.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Mining"></div>
            </div>
            <div class="tab-content" id="biz-otc">
                <div class="tab-text">
                    <h3>Over The Counter Desk</h3>
                    <p>Prime Trade Access' Over-The-Counter (OTC) Trading Desk provides high-net-worth clients with personalized and
                        secure trading, access to deep liquidity, and a wide selection of digital assets.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="OTC"></div>
            </div>
            <div class="tab-content" id="biz-referrals">
                <div class="tab-text">
                    <h3>Referrals</h3>
                    <p>Introduce businesses to Prime Trade Access' services and earn rewards for every successful referral.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_passive.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Referrals"></div>
            </div>
            <div class="tab-content" id="biz-finance">
                <div class="tab-text">
                    <h3>Financial Institutions</h3>
                    <p>Prime Trade Access empowers financial institutions with a secure framework for integrating digital currencies,
                        offering innovative solutions to expand their service offerings.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="Finance"></div>
            </div>
        </div>
    </section>

    <!-- Careers CTA -->
    <section class="section careers-section" id="careers">
        <div class="section-inner">
            <div class="careers-card">
                <div class="careers-label">Arrested Development</div>
                <h2 class="careers-title">We're Building The Future.<br>Want To Help?</h2>
                <a href="#" class="btn-lime">Get Started →</a>
            </div>
        </div>
    </section>

    <!-- Blog / What's Up -->
    <section class="section blog-section" id="blog">
        <div class="section-inner">
            <div class="crypto-header">
                <div>
                    <div class="section-title">What's Up? (And What's Down)</div>
                    <p class="section-desc" style="margin-bottom:0;">All that's new and improved in the world of crypto,
                        from news to articles to blogs to insights and everything in between.</p>
                </div>
                <a href="#" class="btn-outline">Learn More →</a>
            </div>
            <div class="blog-grid">
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_trading.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <h3>Prime Trade Access Ice Playoffs Are Here! Make Picks. Climb the Leaderboard. Win Bigger.</h3>
                        <a href="#" class="read-link">Read Article →</a>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_passive.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <h3>Staking on Prime Trade Access: How You Could Earn Rewards in a Volatile Market</h3>
                        <a href="#" class="read-link">Read Article →</a>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-thumb" style="background-image: url('{{ asset('images/product_trading.png') }}'); background-size: cover; background-position: center;"></div>
                    <div class="blog-body">
                        <h3>What Is the Fear and Greed Index in Crypto?</h3>
                        <a href="#" class="read-link">Read Article →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    @push('scripts')
    <script>
        // Parallax effect on coins
        document.addEventListener('mousemove', (e) => {
            const coins = document.querySelectorAll('.coin');
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;
            coins.forEach((coin, i) => {
                const speed = (i + 1) * 8;
                coin.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });

        // Tab switching for all tab sections
        document.querySelectorAll('.tab-nav').forEach(nav => {
            nav.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabId = btn.dataset.tab;
                    const section = nav.closest('.section');

                    // Update active button
                    nav.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    // Update active content
                    section.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });

        // Scroll reveal animation
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
    </script>
    @endpush
    
@endsection
