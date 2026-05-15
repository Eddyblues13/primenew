<nav class="topbar">
    <div class="wrap">
        <div class="toprow">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="teslaWordmark">
                <img src="{{ asset('images/logo.png') }}" alt="Prime Trade Access" style="height: 130px; display: inline-block;" />
            </a>

            <!-- Navigation Links -->
            <div class="navlinks">
                <a href="{{ route('home') }}" class="hover:text-[#E31937] transition-colors">Home</a>
                <a href="{{ route('investments.tesla') }}" class="hover:text-[#E31937] transition-colors">Invest</a>
                <a href="{{ route('frontend.markets') }}" class="hover:text-[#E31937] transition-colors">Markets</a>
                <a href="{{ route('frontend.products') }}" class="hover:text-[#E31937] transition-colors">Products</a>
                <a href="{{ route('frontend.company') }}" class="hover:text-[#E31937] transition-colors">Company</a>
            </div>

            <!-- Auth Links / Account -->
            <div class="auth-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="account hover:text-[#E31937] transition-colors">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="account hover:text-[#E31937] transition-colors" style="background: none; border: none; cursor: pointer; padding: 0;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="account hover:text-[#E31937] transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="account" style="padding: 8px 16px; background: #E31937; color: #fff; border-radius: 6px; font-weight: 600;">Sign Up</a>
                @endauth
                
                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                    <svg id="menuIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="closeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
