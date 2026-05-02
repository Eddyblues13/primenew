<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prime Trade Access | An All-In-One Crypto Trading Platform</title>
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

        .nav-links a:hover {
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
            background: var(--ndax-hero-bg);
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(80, 60, 220, 0.4) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            top: 10%;
            right: 20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(50, 50, 255, 0.5) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(40px);
        }

        .hero-gradient-accent {
            position: absolute;
            bottom: -10%;
            left: 30%;
            width: 500px;
            height: 300px;
            background: radial-gradient(ellipse, rgba(100, 50, 200, 0.3) 0%, transparent 70%);
            z-index: 0;
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
            background: linear-gradient(160deg, rgba(30, 20, 70, 0.6) 0%, rgba(15, 10, 45, 0.8) 100%);
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

        /* ========== RESPONSIVE ========== */
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
                transform: rotate(0deg);
            }

            .hero-content {
                flex-direction: column;
                text-align: left;
            }

            .hero-text h1 {
                font-size: 48px;
                letter-spacing: -1.5px;
            }

            .hero-text p {
                font-size: 14px;
            }

            .hero-coins {
                width: 100%;
                height: 250px;
                margin-top: 20px;
            }

            .coin-btc {
                width: 120px;
                height: 120px;
                top: 10px;
                right: 20px;
            }

            .coin-pink {
                width: 100px;
                height: 100px;
                bottom: 0;
                right: 0;
            }

            .coin-silver {
                width: 50px;
                height: 50px;
                top: 40px;
                left: 20px;
            }

            .hero-green-accent {
                display: none;
            }

            .hero-bg::before {
                width: 300px;
                height: 300px;
                right: -20%;
            }

            .hero-bg::after {
                width: 200px;
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .hero-text h1 {
                font-size: 40px;
            }

            .alert-bar {
                font-size: 12px;
                padding: 6px 12px;
            }
        }

        /* ========== SHARED SECTION STYLES ========== */
        .section {
            padding: 80px 32px;
            position: relative;
        }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--ndax-lime);
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.6);
            max-width: 560px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 12px 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            transition: all 0.2s;
            background: none;
            cursor: pointer;
        }

        .btn-outline:hover {
            border-color: var(--ndax-lime);
            color: var(--ndax-lime);
        }

        .btn-lime {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ndax-lime);
            color: #000;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-lime:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        /* ========== CRYPTO PRICES ========== */
        .crypto-prices {
            background: #111;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .crypto-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }

        .price-card {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s;
        }

        .price-card:hover {
            border-color: rgba(255, 255, 255, 0.12);
            transform: translateY(-2px);
        }

        .price-card-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .price-coin-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
        }

        .price-coin-name {
            font-size: 15px;
            font-weight: 600;
        }

        .price-coin-symbol {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
        }

        .price-value {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .price-change {
            font-size: 13px;
            font-weight: 600;
        }

        .price-up {
            color: #22c55e;
        }

        .price-down {
            color: #ef4444;
        }

        /* ========== PRODUCTS SECTION (TABS) ========== */
        .products-section {
            background: var(--ndax-dark);
        }

        .tab-nav {
            display: flex;
            gap: 8px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            white-space: nowrap;
        }

        .tab-btn.active,
        .tab-btn:hover {
            background: var(--ndax-lime);
            color: #000;
            border-color: var(--ndax-lime);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease;
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
            background: linear-gradient(135deg, #1a1040, #0f0a2e);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .learn-visual::before {
            content: '📚';
            font-size: 80px;
            opacity: 0.3;
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
            border-radius: 16px;
            padding: 28px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            font-size: 60px;
            color: var(--ndax-lime);
            opacity: 0.3;
            position: absolute;
            top: 12px;
            left: 20px;
            font-family: serif;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin-bottom: 20px;
            padding-top: 24px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .testimonial-name {
            font-size: 14px;
            font-weight: 700;
        }

        .testimonial-link {
            font-size: 12px;
            color: var(--ndax-lime);
            font-weight: 600;
        }

        .stars {
            color: #fbbf24;
            font-size: 14px;
            margin-bottom: 12px;
        }

        /* ========== BUSINESS SECTION ========== */
        .business-section {
            background: var(--ndax-dark);
        }

        /* ========== CAREERS CTA ========== */
        .careers-section {
            background: #111;
            overflow: hidden;
        }

        .careers-card {
            background: linear-gradient(135deg, #1a1040 0%, #2d1b69 50%, #0f0a2e 100%);
            border-radius: 24px;
            padding: 80px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .careers-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 245, 36, 0.1), transparent 70%);
            border-radius: 50%;
        }

        .careers-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--ndax-lime);
            margin-bottom: 16px;
        }

        .careers-title {
            font-size: clamp(28px, 4vw, 48px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 32px;
            letter-spacing: -1px;
        }

        /* ========== BLOG ========== */
        .blog-section {
            background: var(--ndax-dark);
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .blog-card {
            background: #1a1a1a;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.12);
        }

        .blog-thumb {
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, #1a1040, #16213e);
            position: relative;
            overflow: hidden;
        }

        .blog-thumb::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.4), transparent);
        }

        .blog-body {
            padding: 24px;
        }

        .blog-body h3 {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 16px;
        }

        .blog-body .read-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--ndax-lime);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* ========== FOOTER ========== */
        .site-footer {
            background: #111;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding: 60px 32px 32px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 48px;
        }

        .footer-brand .footer-logo {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .footer-brand p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
            line-height: 1.6;
            max-width: 280px;
        }

        .footer-col h4 {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-col a {
            display: block;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
            padding: 4px 0;
            transition: color 0.2s;
        }

        .footer-col a:hover {
            color: var(--ndax-lime);
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-bottom p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.3);
        }

        .footer-socials {
            display: flex;
            gap: 12px;
        }

        .footer-socials a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.2s;
            font-size: 14px;
        }

        .footer-socials a:hover {
            background: var(--ndax-lime);
            color: #000;
        }

        /* ========== ADDITIONAL RESPONSIVE ========== */
        @media (max-width: 768px) {
            .section {
                padding: 60px 20px;
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

            .careers-card {
                padding: 48px 24px;
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
    </style>
</head>

<body>
    <!-- Alert Bar -->
    <div class="alert-bar" id="alertBar">
        <p>Alert: Protect Your Account – Prime Trade Access will never contact you to request funds, passwords, or personal
            information. Contact Prime Trade Access Support directly if y...</p>
        <button class="dismiss-btn"
            onclick="document.getElementById('alertBar').classList.add('hidden')">Dismiss</button>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-left">
            <div class="logo-area">
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
            </div>
            <div class="nav-links">
                <a href="#">Products <span class="chevron">▾</span></a>
                <a href="#">Features <span class="chevron">▾</span></a>
                <a href="#">Markets <span class="chevron">▾</span></a>
                <a href="#">Learn <span class="chevron">▾</span></a>
                <a href="#">Company <span class="chevron">▾</span></a>
            </div>
        </div>
        <div class="nav-right">
            <div class="nav-auth-links">
                <a href="/login" class="login-link">Login</a>
                <a href="/register" class="signup-link">Register</a>
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
        <a href="#">Products <span class="chevron">▾</span></a>
        <a href="#">Features <span class="chevron">▾</span></a>
        <a href="#">Markets <span class="chevron">▾</span></a>
        <a href="#">Learn <span class="chevron">▾</span></a>
        <a href="#">Company <span class="chevron">▾</span></a>
        <div class="mobile-auth">
            <a href="/login" class="m-login">Login</a>
            <a href="/register" class="m-signup">Register</a>
        </div>
    </div>

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
                <div class="tab-image"><span class="tab-image-placeholder">📈</span></div>
            </div>
            <div class="tab-content" id="prod-advanced">
                <div class="tab-text">
                    <h3>Advanced Trading</h3>
                    <p>Discover powerful tools for traders: an intuitive interface, customizable charts, seamless order
                        execution, multiple order types, real-time market data, and technical indicators.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">📊</span></div>
            </div>
            <div class="tab-content" id="prod-simple">
                <div class="tab-text">
                    <h3>Simple Trading</h3>
                    <p>Benefit from the convenience of one-click trading, allowing you to place buy and sell orders
                        instantly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🖱️</span></div>
            </div>
            <div class="tab-content" id="prod-otc">
                <div class="tab-text">
                    <h3>Wealth (OTC)</h3>
                    <p>Personalized, over-the-counter trading services for high-net-worth individuals seeking private,
                        secure, high-volume trades. Access deep liquidity pools, a broad selection of digital assets,
                        and personalized service.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">💎</span></div>
            </div>
            <div class="tab-content" id="prod-fees">
                <div class="tab-text">
                    <h3>Fees</h3>
                    <p>Benefit from a transparent fee structure, including a 0.2% trading fee, free Canadian dollar and
                        crypto deposits, and competitive withdrawal fees. Enjoy multiple funding options and multichain
                        support for cheaper withdrawals.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">💰</span></div>
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
                <div class="tab-image"><span class="tab-image-placeholder">🔒</span></div>
            </div>
            <div class="tab-content" id="feat-invest">
                <div class="tab-text">
                    <h3>Auto Invest</h3>
                    <p>Automate your crypto purchases with Prime Trade Access' Auto Invest. Utilize Dollar-Cost Averaging (DCA) and
                        scheduled purchases to diversify your portfolio effortlessly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🤖</span></div>
            </div>
            <div class="tab-content" id="feat-orders">
                <div class="tab-text">
                    <h3>Advanced Order Types</h3>
                    <p>Optimize your trades with Prime Trade Access' advanced order types, including limit orders, stop orders,
                        trailing stop orders, fill or kill orders and more.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">⚡</span></div>
            </div>
            <div class="tab-content" id="feat-affiliate">
                <div class="tab-text">
                    <h3>Affiliate Rewards</h3>
                    <p>Earn rewards through our affiliate program by sharing your unique link and inviting others to
                        join Prime Trade Access. Receive bonuses for each qualifying referral.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🎁</span></div>
            </div>
            <div class="tab-content" id="feat-address">
                <div class="tab-text">
                    <h3>Address Book</h3>
                    <p>Effortlessly manage crypto transactions with Prime Trade Access' Address Book: store addresses, execute
                        withdrawals directly, enhance security with whitelisting, and access comprehensive transaction
                        histories.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">📒</span></div>
            </div>
            <div class="tab-content" id="feat-tax">
                <div class="tab-text">
                    <h3>Tax Reporting</h3>
                    <p>Prime Trade Access makes tax reporting easy with comprehensive reports and tax software integration, helping
                        you file your crypto taxes effortlessly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">📋</span></div>
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
                <div class="tab-image"><span class="tab-image-placeholder">🏦</span></div>
            </div>
            <div class="tab-content" id="biz-institutional">
                <div class="tab-text">
                    <h3>Institutional Solutions</h3>
                    <p>Explore digital assets and Web3 products with Prime Trade Access' institutional solutions, allowing you to
                        integrate digital assets into your product offering seamlessly.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🏢</span></div>
            </div>
            <div class="tab-content" id="biz-liquidity">
                <div class="tab-text">
                    <h3>Liquidity Provider</h3>
                    <p>Prime Trade Access offers businesses access to extensive liquidity pools, competitive spreads, and low trading
                        fees, enhancing the efficiency of high-volume cryptocurrency transactions.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">💧</span></div>
            </div>
            <div class="tab-content" id="biz-whitelabel">
                <div class="tab-text">
                    <h3>White Label Trade Platform</h3>
                    <p>Empower your business with Prime Trade Access' plug-and-play white-label trading platform, providing
                        comprehensive solutions for acquiring cryptocurrency.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🏷️</span></div>
            </div>
            <div class="tab-content" id="biz-mining">
                <div class="tab-text">
                    <h3>Crypto Mining</h3>
                    <p>Prime Trade Access offers crypto miners access to deep liquidity pools, robust security, and comprehensive
                        solutions to streamline operations.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">⛏️</span></div>
            </div>
            <div class="tab-content" id="biz-otc">
                <div class="tab-text">
                    <h3>Over The Counter Desk</h3>
                    <p>Prime Trade Access' Over-The-Counter (OTC) Trading Desk provides high-net-worth clients with personalized and
                        secure trading, access to deep liquidity, and a wide selection of digital assets.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🤝</span></div>
            </div>
            <div class="tab-content" id="biz-referrals">
                <div class="tab-text">
                    <h3>Referrals</h3>
                    <p>Introduce businesses to Prime Trade Access' services and earn rewards for every successful referral.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🔗</span></div>
            </div>
            <div class="tab-content" id="biz-finance">
                <div class="tab-text">
                    <h3>Financial Institutions</h3>
                    <p>Prime Trade Access empowers financial institutions with a secure framework for integrating digital currencies,
                        offering innovative solutions to expand their service offerings.</p>
                    <a href="#" class="btn-lime">Learn More →</a>
                </div>
                <div class="tab-image"><span class="tab-image-placeholder">🏛️</span></div>
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
                    <div class="blog-thumb"></div>
                    <div class="blog-body">
                        <h3>Prime Trade Access Ice Playoffs Are Here! Make Picks. Climb the Leaderboard. Win Bigger.</h3>
                        <a href="#" class="read-link">Read Article →</a>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-thumb" style="background: linear-gradient(135deg, #1a2040, #162e3e);"></div>
                    <div class="blog-body">
                        <h3>Staking on Prime Trade Access: How You Could Earn Rewards in a Volatile Market</h3>
                        <a href="#" class="read-link">Read Article →</a>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-thumb" style="background: linear-gradient(135deg, #2a1040, #1e0a3e);"></div>
                    <div class="blog-body">
                        <h3>What Is the Fear and Greed Index in Crypto?</h3>
                        <a href="#" class="read-link">Read Article →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer" id="footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">Prime Trade Access</div>
                    <p>Trade Bitcoin, Ethereum, and more on Prime Trade Access. Enjoy secure, simple trading and asset management.</p>
                </div>
                <div class="footer-col">
                    <h4>Products</h4>
                    <a href="#">Simple Trading</a>
                    <a href="#">Advanced Trading</a>
                    <a href="#">Staking</a>
                    <a href="#">Wealth (OTC)</a>
                    <a href="#">Fees</a>
                </div>
                <div class="footer-col">
                    <h4>Features</h4>
                    <a href="#">Advanced Security</a>
                    <a href="#">Auto Invest</a>
                    <a href="#">Order Types</a>
                    <a href="#">Tax Reporting</a>
                    <a href="#">Address Book</a>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <a href="#">About Us</a>
                    <a href="#">Careers</a>
                    <a href="#">Blog</a>
                    <a href="#">Contact</a>
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

        // Dismiss alert bar
        document.getElementById('alertBar').querySelector('.dismiss-btn').addEventListener('click', () => {
            document.getElementById('alertBar').style.display = 'none';
        });
    </script>
</body>

</html>