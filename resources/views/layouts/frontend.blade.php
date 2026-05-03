<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Prime Trade Access | An All-In-One Crypto Trading Platform')</title>
    <meta name="description"
        content="Trade Bitcoin, Ethereum, and more on Prime Trade Access. Enjoy secure, simple trading and asset management.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --ndax-lime: #C8F524;
            --ndax-dark: #0D0D0D;
            --ndax-dark-nav: #161616;
            --ndax-hero-bg: linear-gradient(135deg, #1a1040 0%, #0f0a2e 30%, #1a0a3a 60%, #0a0a2a 100%);
            --ndax-blue-glow: #4444ff;
            --ndax-purple: #6B3FA0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--ndax-dark);
            color: #fff;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* ========== ALERT BAR ========== */
        .alert-bar {
            background: var(--ndax-lime);
            color: #000;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            position: relative;
            z-index: 100;
            gap: 12px;
            text-align: center;
            line-height: 1.4;
        }

        .alert-bar p {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 900px;
        }

        .alert-bar .dismiss-btn {
            background: none;
            border: none;
            color: #000;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
            padding: 2px 8px;
            font-family: 'Inter', sans-serif;
        }

        .alert-bar.hidden {
            display: none;
        }

        /* ========== NAVBAR ========== */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 32px;
            background: var(--ndax-dark-nav);
            position: sticky;
            top: 0;
            z-index: 90;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-icon {
            display: flex;
            align-items: center;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #fff;
        }

        .logo-divider {
            width: 1px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 8px;
        }

        .partner-badge {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .partner-badge .shield-icon {
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partner-text {
            font-size: 10px;
            font-weight: 600;
            line-height: 1.2;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Desktop nav links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links a {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-links .chevron {
            font-size: 10px;
            opacity: 0.6;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-auth-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-auth-links a {
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .login-link {
            color: rgba(255, 255, 255, 0.9);
        }

        .login-link:hover {
            color: #fff;
        }

        .signup-link {
            color: #fff;
        }

        .signup-link:hover {
            opacity: 0.85;
        }

        .icon-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #2a2a2a;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            color: #fff;
        }

        .icon-btn:hover {
            background: #3a3a3a;
        }

        .hamburger-btn {
            display: none;
        }

        /* ========== HERO SECTION ========== */
        .hero {
            position: relative;
            min-height: calc(100vh - 100px);
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 60px 32px 80px;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
            background: #0d0f1a;
        }

        /* Large purple/blue blob — upper right */
        .hero-bg::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -15%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(70, 50, 220, 0.55) 0%, rgba(50, 30, 180, 0.3) 40%, transparent 70%);
            border-radius: 50%;
            animation: blobDrift 18s ease-in-out infinite alternate;
        }

        /* Smaller blue accent blob — mid-right */
        .hero-bg::after {
            content: '';
            position: absolute;
            top: 10%;
            right: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(60, 80, 255, 0.4) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(20px);
            animation: blobDrift 14s ease-in-out infinite alternate-reverse;
        }

        @keyframes blobDrift {
            0% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(-20px, 15px) scale(1.05);
            }

            100% {
                transform: translate(10px, -10px) scale(0.97);
            }
        }

        .hero-gradient-accent {
            position: absolute;
            bottom: -10%;
            left: 20%;
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse, rgba(80, 40, 180, 0.25) 0%, transparent 70%);
            z-index: 0;
            animation: blobDrift 22s ease-in-out infinite alternate;
        }

        .hero-green-accent {
            position: absolute;
            left: -2%;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 280px;
            background: var(--ndax-lime);
            border-radius: 0 4px 4px 0;
            z-index: 2;
        }

        /* Tilted card behind hero content */
        .hero-card {
            position: absolute;
            top: 5%;
            left: 3%;
            right: 15%;
            bottom: 5%;
            background: linear-gradient(160deg, rgba(25, 20, 60, 0.7) 0%, rgba(15, 12, 40, 0.85) 100%);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            z-index: 1;
            transform: rotate(-1deg);
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-text {
            max-width: 600px;
            flex-shrink: 0;
        }

        .hero-text h1 {
            font-size: clamp(42px, 6vw, 72px);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
            margin-bottom: 24px;
            color: #fff;
        }

        .hero-text p {
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.7);
            max-width: 440px;
            margin-bottom: 32px;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ndax-lime);
            color: #000;
            font-size: 15px;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .hero-cta:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        /* Floating coins */
        .hero-coins {
            position: relative;
            width: 420px;
            height: 420px;
            flex-shrink: 0;
        }

        .coin {
            position: absolute;
            animation: float 6s ease-in-out infinite;
        }

        .coin img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .coin-btc {
            width: 180px;
            height: 180px;
            top: 20px;
            right: 40px;
            animation-delay: 0s;
        }

        .coin-pink {
            width: 160px;
            height: 160px;
            bottom: 10px;
            right: -10px;
            animation-delay: 2s;
        }

        .coin-silver {
            width: 80px;
            height: 80px;
            top: 60px;
            left: 40px;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(3deg);
            }
        }

        /* ========== CHAT BUTTON ========== */
        .chat-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #333;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        .chat-btn:hover {
            background: #444;
            transform: scale(1.05);
        }

        .chat-btn svg {
            width: 24px;
            height: 24px;
            color: #fff;
        }

        /* ========== MOBILE MENU OVERLAY ========== */
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 200;
            flex-direction: column;
            padding: 80px 32px 32px;
        }

        .mobile-menu-overlay.active {
            display: flex;
        }

        .mobile-menu-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: #2a2a2a;
            border: none;
            color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-menu-overlay a {
            font-size: 18px;
            font-weight: 600;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-menu-overlay .mobile-auth {
            margin-top: auto;
            display: flex;
            gap: 12px;
            padding-top: 24px;
        }

        .mobile-menu-overlay .mobile-auth a {
            flex: 1;
            text-align: center;
            padding: 14px;
            border-radius: 8px;
            border-bottom: none;
            justify-content: center;
        }

        .mobile-menu-overlay .mobile-auth .m-login {
            background: rgba(255, 255, 255, 0.08);
        }

        .mobile-menu-overlay .mobile-auth .m-signup {
            background: var(--ndax-lime);
            color: #000;
        }

        /* ========== SECTION STYLES ========== */
        .section {
            padding: 100px 32px;
            position: relative;
        }

        .section-inner {
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        .section-label {
            color: var(--ndax-lime);
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: clamp(32px, 4vw, 48px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            letter-spacing: -1px;
            max-width: 800px;
        }

        .section-desc {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            margin-bottom: 40px;
            max-width: 700px;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .btn-lime {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background: var(--ndax-lime);
            color: #000;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-lime:hover {
            filter: brightness(1.1);
        }

        /* ========== TICKER / STATS ========== */
        .stats-ticker {
            background: #111;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 24px 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .ticker-track {
            display: inline-flex;
            gap: 60px;
            animation: ticker 30s linear infinite;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* ========== TABS COMPONENT ========== */
        .tab-nav {
            display: flex;
            gap: 12px;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 16px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .tab-nav::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            font-size: 15px;
            font-weight: 600;
            padding: 8px 16px;
            cursor: pointer;
            transition: all 0.2s;
            border-radius: 8px;
            white-space: nowrap;
        }

        .tab-btn:hover {
            color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.05);
        }

        .tab-btn.active {
            color: #000;
            background: #fff;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease forwards;
        }

        .tab-content.active {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tab-text {
            flex: 1;
        }

        .tab-text h3 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .tab-text p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .tab-image {
            flex: 1;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .tab-image-placeholder {
            font-size: 48px;
            opacity: 0.3;
        }

        /* ========== CRYPTO SHOULDN'T BE CRYPTIC ========== */
        .learn-section {
            background: #111;
        }

        .learn-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .learn-visual {
            aspect-ratio: 1;
            background-image: url('{{ asset("images/product_passive.png") }}');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .learn-visual:hover {
            transform: translateY(-5px) scale(1.02);
        }

        /* ========== FEATURES SECTION ========== */
        .features-section {
            background: var(--ndax-dark);
        }

        /* ========== TESTIMONIALS ========== */
        .testimonials {
            background: #111;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .testimonial-card {
            background: #1a1a1a;
            padding: 32px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .stars {
            color: #F5A623;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .testimonial-text {
            font-size: 15px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.8);
            flex: 1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .testimonial-name {
            font-size: 14px;
            font-weight: 600;
        }

        .testimonial-link {
            font-size: 12px;
            color: var(--ndax-lime);
            text-decoration: underline;
        }

        /* ========== BUSINESS SOLUTIONS ========== */
        .business-section {
            background: var(--ndax-dark);
        }

        /* ========== CAREERS CTA ========== */
        .careers-section {
            background: #111;
        }

        .careers-card {
            background: linear-gradient(135deg, var(--ndax-purple), #3A1F5D);
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            position: relative;
            overflow: hidden;
        }

        .careers-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .careers-label {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, 0.8);
        }

        .careers-title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            line-height: 1.1;
        }

        /* ========== BLOG ========== */
        .blog-section {
            background: var(--ndax-dark);
        }

        .crypto-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            gap: 24px;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .blog-card {
            background: #111;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.04);
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .blog-thumb {
            height: 180px;
            background: #1a1a1a;
            position: relative;
        }

        .blog-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .blog-body h3 {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 16px;
            flex: 1;
        }

        .read-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--ndax-lime);
            display: inline-flex;
            align-items: center;
        }

        /* ========== FOOTER ========== */
        .site-footer {
            background: #0a0a0a;
            padding: 80px 32px 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-brand .footer-logo {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .footer-brand p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            line-height: 1.6;
            max-width: 300px;
        }

        .footer-col h4 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
        }

        .footer-col a {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            margin-bottom: 12px;
            transition: color 0.2s;
        }

        .footer-col a:hover {
            color: #fff;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
        }

        .footer-socials {
            display: flex;
            gap: 16px;
        }

        .footer-socials a {
            color: rgba(255, 255, 255, 0.5);
            font-size: 16px;
            transition: color 0.2s;
        }

        .footer-socials a:hover {
            color: #fff;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .hero-coins {
                width: 300px;
                height: 300px;
            }

            .coin-btc {
                width: 140px;
                height: 140px;
            }

            .coin-pink {
                width: 120px;
                height: 120px;
            }

            .coin-silver {
                width: 60px;
                height: 60px;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .nav-auth-links {
                display: none;
            }

            .hamburger-btn {
                display: flex;
            }

            .navbar {
                padding: 12px 20px;
            }

            .hero {
                padding: 40px 20px 60px;
                min-height: auto;
            }

            .hero-card {
                top: 2%;
                left: 4%;
                right: 4%;
                bottom: 3%;
                border-radius: 18px;
            }

            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-text {
                max-width: 100%;
            }

            .hero-text p {
                margin: 0 auto 32px;
            }

            .hero-coins {
                width: 240px;
                height: 240px;
            }

            .tab-content.active {
                flex-direction: column;
            }

            .learn-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .crypto-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .tab-nav {
                gap: 6px;
            }

            .tab-btn {
                padding: 8px 14px;
                font-size: 12px;
            }
        }

        /* Plan Cards added back to make sure dashboard dynamic styles work */
        .plan-card {
            background: #111;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: transform 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .plan-title {
            font-size: 20px;
            font-weight: 700;
        }

        .plan-roi {
            font-size: 36px;
            font-weight: 800;
            color: var(--ndax-lime);
        }

        .plan-meta {
            display: flex;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }
    </style>
    @stack('styles')
    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = 'fcd805574ebf2082b1afb7ec22afa3d6c97b04e8';
        window.smartsupp || (function (d) {
            var s, c, o = smartsupp = function () { o._.push(arguments) }; o._ = [];
            s = d.getElementsByTagName('script')[0]; c = d.createElement('script');
            c.type = 'text/javascript'; c.charset = 'utf-8'; c.async = true;
            c.src = 'https://www.smartsuppchat.com/loader.js?'; s.parentNode.insertBefore(c, s);
        })(document);
    </script>
    <noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>

</head>

<body>
    <!-- Alert Bar -->
    <div class="alert-bar" id="alertBar">
        <p>Alert: Protect Your Account – Prime Trade Access will never contact you to request funds, passwords, or
            personal
            information. Contact Prime Trade Access Support directly if y...</p>
        <button class="dismiss-btn"
            onclick="document.getElementById('alertBar').classList.add('hidden')">Dismiss</button>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-left">
            <a href="/" class="logo-area">
                <div class="logo-icon">
                    <!-- Prime Trade Access Logo SVG -->
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <rect x="2" y="8" width="10" height="16" rx="1" fill="#C8F524" />
                        <rect x="8" y="4" width="10" height="16" rx="1" fill="#8BC34A" transform="rotate(10 8 4)" />
                        <rect x="14" y="10" width="8" height="14" rx="1" fill="#4CAF50" transform="rotate(-5 14 10)" />
                    </svg>
                </div>
                <span class="logo-text">Prime Trade Access</span>
                <div class="logo-divider"></div>
                <div class="partner-badge">
                    <div class="shield-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5zm0 2.18l7 3.82v5c0 4.52-3.15 8.72-7 9.93-3.85-1.21-7-5.41-7-9.93V8l7-3.82z" />
                        </svg>
                    </div>
                    <span class="partner-text">Official<br>Partner</span>
                </div>
            </a>
            <div class="nav-links">
                <a href="{{ route('frontend.products') }}"
                    class="{{ request()->routeIs('frontend.products') ? 'active' : '' }}">Products</a>
                <a href="{{ route('frontend.features') }}"
                    class="{{ request()->routeIs('frontend.features') ? 'active' : '' }}">Features</a>
                <a href="{{ route('frontend.markets') }}"
                    class="{{ request()->routeIs('frontend.markets') ? 'active' : '' }}">Markets</a>
                <a href="{{ route('frontend.learn') }}"
                    class="{{ request()->routeIs('frontend.learn') ? 'active' : '' }}">Learn</a>
                <a href="{{ route('frontend.company') }}"
                    class="{{ request()->routeIs('frontend.company') ? 'active' : '' }}">Company</a>
            </div>
        </div>
        <div class="nav-right">
            <div class="nav-auth-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="signup-link">Dashboard</a>
                @else
                    <a href="/login" class="login-link">Login</a>
                    <a href="/register" class="signup-link">Register</a>
                @endauth
            </div>
            <button class="icon-btn download-btn" aria-label="Download app">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
            </button>
            <button class="icon-btn hamburger-btn" id="hamburgerBtn" aria-label="Menu">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay" id="mobileMenu">
        <button class="mobile-menu-close" id="mobileMenuClose">&times;</button>
        <a href="{{ route('frontend.products') }}">Products</a>
        <a href="{{ route('frontend.features') }}">Features</a>
        <a href="{{ route('frontend.markets') }}">Markets</a>
        <a href="{{ route('frontend.learn') }}">Learn</a>
        <a href="{{ route('frontend.company') }}">Company</a>
        <div class="mobile-auth">
            @auth
                <a href="{{ route('dashboard') }}" class="m-signup">Dashboard</a>
            @else
                <a href="/login" class="m-login">Login</a>
                <a href="/register" class="m-signup">Register</a>
            @endauth
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer" id="footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">Prime Trade Access</div>
                    <p>Trade Bitcoin, Ethereum, and more on Prime Trade Access. Enjoy secure, simple trading and asset
                        management.</p>
                </div>
                <div class="footer-col">
                    <h4>Products</h4>
                    <a href="{{ route('frontend.products') }}#simple">Simple Trading</a>
                    <a href="{{ route('frontend.products') }}#advanced">Advanced Trading</a>
                    <a href="{{ route('frontend.products') }}#staking">Staking</a>
                    <a href="{{ route('frontend.products') }}#otc">Wealth (OTC)</a>
                    <a href="{{ route('frontend.products') }}#fees">Fees</a>
                </div>
                <div class="footer-col">
                    <h4>Features</h4>
                    <a href="{{ route('frontend.features') }}#security">Advanced Security</a>
                    <a href="{{ route('frontend.features') }}#invest">Auto Invest</a>
                    <a href="{{ route('frontend.features') }}#orders">Order Types</a>
                    <a href="{{ route('frontend.features') }}#tax">Tax Reporting</a>
                    <a href="{{ route('frontend.features') }}#address">Address Book</a>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <a href="{{ route('frontend.company') }}">About Us</a>
                    <a href="{{ route('frontend.company') }}#careers">Careers</a>
                    <a href="{{ route('frontend.learn') }}">Blog</a>
                    <a href="{{ route('frontend.company') }}#contact">Contact</a>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <a href="#">Terms of Service</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">AML Policy</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Prime Trade Access. All rights reserved.</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Twitter">𝕏</a>
                    <a href="#" aria-label="LinkedIn">in</a>
                    <a href="#" aria-label="Instagram">📷</a>
                    <a href="#" aria-label="YouTube">▶</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Chat Button -->
    <button class="chat-btn" id="chatBtn" aria-label="Chat">
        <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z" />
            <circle cx="8" cy="10" r="1.2" />
            <circle cx="12" cy="10" r="1.2" />
            <circle cx="16" cy="10" r="1.2" />
        </svg>
    </button>

    <script>
        // Mobile menu toggle
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuClose = document.getElementById('mobileMenuClose');

        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', () => {
                mobileMenu.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            mobileMenuClose.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });

            mobileMenu.addEventListener('click', (e) => {
                if (e.target === mobileMenu) {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }

        // Dismiss alert bar
        const dismissBtn = document.querySelector('#alertBar .dismiss-btn');
        if (dismissBtn) {
            dismissBtn.addEventListener('click', () => {
                document.getElementById('alertBar').style.display = 'none';
            });
        }
    </script>
    @stack('scripts')
</body>

</html>