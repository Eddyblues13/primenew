@extends('layouts.frontend')
@section('title', 'Company | Prime Trade Access')

@section('content')
    <!-- Hero -->
    <section class="hero" style="min-height: 50vh;">
        <div class="hero-bg"></div>
        <div class="hero-gradient-accent"></div>
        <div class="hero-green-accent"></div>
        <div class="hero-content" style="flex-direction: column; text-align: center;">
            <div class="hero-text" style="max-width: 800px;">
                <div class="section-label" style="text-align:center;">Our Company</div>
                <h1>Trust Is The New Currency</h1>
                <p style="margin: 0 auto 32px; max-width: 600px;">Stepping into the future shouldn't require a leap of faith. Prime Trade Access has the experience and expertise to guide you every step of the way.</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" style="background: #111;">
        <div class="section-inner">
            <div class="learn-grid">
                <div>
                    <div class="section-label">About Us</div>
                    <div class="section-title">Built By Traders, For Traders</div>
                    <p class="section-desc">Prime Trade Access was founded on a simple principle: everyone deserves access to a secure, institutional-grade cryptocurrency platform. We are dedicated to providing the highest level of security, transparency, and innovation to our clients across the globe.</p>
                    <p class="section-desc">Our platform bridges the gap between traditional finance and digital assets, ensuring that whether you are a retail investor or a large institution, you have the tools you need to succeed in the crypto ecosystem.</p>
                </div>
                <div class="tab-image" style="aspect-ratio: 1; border-radius: 20px;">
                    <img src="{{ asset('images/product_trading.png') }}" style="width:100%; height:100%; object-fit:cover;" alt="About Us">
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="section" style="background: var(--ndax-dark);">
        <div class="section-inner">
            <div class="section-label" style="text-align:center;">Our Principles</div>
            <div class="section-title" style="margin: 0 auto 60px; text-align: center;">Core Values</div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
                <div class="plan-card">
                    <div style="font-size: 32px; margin-bottom: 16px;">🛡️</div>
                    <div class="plan-title">Security First</div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.6;">We employ institutional-grade security infrastructure to protect our clients' assets and data at all times.</p>
                </div>
                <div class="plan-card">
                    <div style="font-size: 32px; margin-bottom: 16px;">🔍</div>
                    <div class="plan-title">Transparency</div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.6;">No hidden fees. We believe in building trust through clear communication and transparent business practices.</p>
                </div>
                <div class="plan-card">
                    <div style="font-size: 32px; margin-bottom: 16px;">⚡</div>
                    <div class="plan-title">Innovation</div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.6;">We constantly evolve our platform to provide cutting-edge tools and products for the modern digital asset market.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Careers CTA -->
    <section class="section careers-section" id="careers">
        <div class="section-inner">
            <div class="careers-card">
                <div class="careers-label">Join Our Team</div>
                <h2 class="careers-title">We're Building The Future.<br>Want To Help?</h2>
                <a href="#" class="btn-lime">View Open Positions →</a>
            </div>
        </div>
    </section>
@endsection
