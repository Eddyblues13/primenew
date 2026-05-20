@extends('user.layouts.app')

@section('title', 'Dashboard | Prime Trade Access')
@section('header_title', 'Welcome back, ' . (auth()->user()->name ?? 'Investor'))

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    
    <!-- Welcome Greeting -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">Welcome, {{ auth()->user()->name ?? 'Investor' }} 👋</h1>
            <p class="text-gray-400 text-sm mt-1">Here is what's happening with your account today.</p>
        </div>
    </div>

    <!-- Balance Overview -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 xl:gap-3">
        <!-- Total Balance -->
        <div class="glass-panel p-6 xl:p-4 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center min-w-0">
            <div class="absolute right-0 top-0 w-32 h-32 bg-brand-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-3xl sm:text-4xl xl:text-2xl 2xl:text-3xl font-bold text-white mb-2 tracking-tight truncate">$ {{ number_format(auth()->user()->balance, 2) }}</h2>
            <p class="text-gray-400 font-medium text-xs xl:text-[11px] 2xl:text-xs tracking-widest uppercase">Total Balance</p>
        </div>

        <!-- Capital -->
        <div class="glass-panel p-6 xl:p-4 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center min-w-0">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-3xl sm:text-4xl xl:text-2xl 2xl:text-3xl font-bold text-white mb-2 tracking-tight truncate">$ {{ number_format(auth()->user()->deposits->where('status', 'approved')->sum('amount') + auth()->user()->manual_deposits, 2) }}</h2>
            <p class="text-gray-400 font-medium text-xs xl:text-[11px] 2xl:text-xs tracking-widest uppercase">Capital</p>
        </div>

        <!-- Profit Earned -->
        <div class="glass-panel p-6 xl:p-4 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center min-w-0">
            <div class="absolute right-0 top-0 w-32 h-32 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-3xl sm:text-4xl xl:text-2xl 2xl:text-3xl font-bold text-white mb-2 tracking-tight truncate">$ {{ number_format(auth()->user()->profits->where('type', 'add')->sum('amount') - auth()->user()->profits->where('type', 'subtract')->sum('amount'), 2) }}</h2>
            <p class="text-gray-400 font-medium text-xs xl:text-[11px] 2xl:text-xs tracking-widest uppercase">Profit Earned</p>
        </div>

        <!-- Sign Up Bonus -->
        <div class="glass-panel p-6 xl:p-4 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center min-w-0">
            <div class="absolute right-0 top-0 w-32 h-32 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-3xl sm:text-4xl xl:text-2xl 2xl:text-3xl font-bold text-white mb-2 tracking-tight truncate">$ {{ number_format(auth()->user()->signup_bonus, 2) }}</h2>
            <p class="text-gray-400 font-medium text-xs xl:text-[11px] 2xl:text-xs tracking-widest uppercase">Sign Up Bonus</p>
        </div>

        <!-- Affiliate Bonus -->
        <div class="glass-panel p-6 xl:p-4 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center min-w-0">
            <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-3xl sm:text-4xl xl:text-2xl 2xl:text-3xl font-bold text-white mb-2 tracking-tight truncate">$ {{ number_format(auth()->user()->affiliate_bonus, 2) }}</h2>
            <p class="text-gray-400 font-medium text-xs xl:text-[11px] 2xl:text-xs tracking-widest uppercase">Affiliate Bonus</p>
        </div>
    </section>

    <!-- Quick Actions Grid -->
    <section class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Deposit Funds -->
        <a href="{{ route('deposits.index') }}" class="group flex flex-col items-center justify-center gap-3 p-6 rounded-2xl bg-blue-600 hover:bg-blue-500 transition-all duration-200 shadow-lg shadow-blue-600/20 hover:shadow-blue-500/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">FUND ACCOUNT</span>
        </a>

        <!-- Withdrawals -->
        <a href="{{ route('withdrawals.index') }}" class="group flex flex-col items-center justify-center gap-3 p-6 rounded-2xl bg-orange-500 hover:bg-orange-400 transition-all duration-200 shadow-lg shadow-orange-500/20 hover:shadow-orange-400/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">WITHDRAW</span>
        </a>

        <!-- Tesla Investment -->
        <a href="{{ route('investments.tesla') }}" class="group flex flex-col items-center justify-center gap-3 p-6 rounded-2xl bg-red-600 hover:bg-red-500 transition-all duration-200 shadow-lg shadow-red-600/20 hover:shadow-red-500/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">TESLA INVEST</span>
        </a>

        <!-- Crypto Investment -->
        <a href="{{ route('investments.crypto') }}" class="group flex flex-col items-center justify-center gap-3 p-6 rounded-2xl bg-emerald-600 hover:bg-emerald-500 transition-all duration-200 shadow-lg shadow-emerald-600/20 hover:shadow-emerald-500/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">CRYPTO INVEST</span>
        </a>

        <!-- Investment History -->
        <a href="{{ route('investments.history') }}" class="group flex flex-col items-center justify-center gap-3 p-6 rounded-2xl bg-purple-600 hover:bg-purple-500 transition-all duration-200 shadow-lg shadow-purple-600/20 hover:shadow-purple-500/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">TRADE HISTORY</span>
        </a>

        <!-- KYC Verification -->
        <a href="{{ route('kyc.index') }}" class="group flex flex-col items-center justify-center gap-3 p-6 rounded-2xl bg-teal-600 hover:bg-teal-500 transition-all duration-200 shadow-lg shadow-teal-600/20 hover:shadow-teal-500/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">VERIFY KYC</span>
        </a>
    </section>

    <!-- Referral Link Section -->
    <section class="glass-panel p-6 rounded-2xl border border-dark-600 relative overflow-hidden">
        <div class="absolute right-0 top-0 w-64 h-64 bg-brand-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 -translate-y-1/2 translate-x-1/3"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Invite Friends, Earn $10</h3>
                <p class="text-gray-400 text-sm">Share your referral link with friends and earn a $10 bonus for every new member who signs up.</p>
            </div>
            <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
                <input type="text" readonly value="{{ url('/register?ref=' . auth()->user()->referral_code) }}" id="referralLink" class="bg-dark-900 border border-dark-600 rounded-xl px-4 py-3 text-white text-sm w-full md:w-80 focus:outline-none focus:border-brand-500 transition-colors">
                <button onclick="copyReferralLink()" class="bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3 px-6 rounded-xl transition-colors shadow-lg shadow-brand-500/20 flex-shrink-0 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                    Copy Link
                </button>
            </div>
        </div>
    </section>

    <script>
        function copyReferralLink() {
            var copyText = document.getElementById("referralLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            
            // Dispatch a notification event if Alpine toast is present
            window.dispatchEvent(new CustomEvent('notify', {
                detail: { message: 'Referral link copied to clipboard!', type: 'success' }
            }));
        }
    </script>


    <!-- Live Market Ticker Tape -->
    <section class="glass-panel rounded-2xl border border-dark-600 overflow-hidden">
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
            {
                "symbols": [
                    {"proName": "NASDAQ:TSLA", "title": "Tesla"},
                    {"proName": "BITSTAMP:BTCUSD", "title": "Bitcoin"},
                    {"proName": "BITSTAMP:ETHUSD", "title": "Ethereum"},
                    {"proName": "NASDAQ:AAPL", "title": "Apple"},
                    {"proName": "NASDAQ:AMZN", "title": "Amazon"},
                    {"proName": "BINANCE:SOLUSDT", "title": "Solana"},
                    {"proName": "BINANCE:BNBUSDT", "title": "BNB"},
                    {"proName": "FX:EURUSD", "title": "EUR/USD"},
                    {"proName": "FX:GBPUSD", "title": "GBP/USD"}
                ],
                "showSymbolLogo": true,
                "isTransparent": true,
                "displayMode": "adaptive",
                "colorTheme": "dark",
                "locale": "en"
            }
            </script>
        </div>
    </section>

    <!-- Market Overview Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Live Tesla Chart -->
        <div class="glass-panel rounded-2xl border border-dark-600 overflow-hidden">
            <div class="p-4 border-b border-dark-600 bg-dark-800/50">
                <h3 class="font-bold text-white flex items-center gap-2">
                    <div class="w-7 h-7 bg-red-600 text-white rounded-lg flex items-center justify-center font-bold text-sm">T</div>
                    Tesla Live Chart
                </h3>
            </div>
            <div class="tradingview-widget-container" style="height: 350px;">
                <div id="tradingview-chart-tsla" style="height: 100%;"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                {
                    "autosize": true,
                    "symbol": "NASDAQ:TSLA",
                    "interval": "15",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "1",
                    "locale": "en",
                    "backgroundColor": "rgba(19, 14, 32, 0)",
                    "gridColor": "rgba(42, 37, 54, 0.3)",
                    "hide_top_toolbar": true,
                    "hide_legend": false,
                    "save_image": false,
                    "hide_volume": true,
                    "support_host": "https://www.tradingview.com"
                }
                </script>
            </div>
        </div>

        <!-- Live Crypto Prices -->
        <div class="glass-panel rounded-2xl border border-dark-600 overflow-hidden">
            <div class="p-4 border-b border-dark-600 bg-dark-800/50">
                <h3 class="font-bold text-white flex items-center gap-2">
                    <div class="w-7 h-7 bg-orange-500/20 text-orange-400 rounded-lg flex items-center justify-center border border-orange-500/30">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14.5 12c1.5 0 2.5-1 2.5-2.5S16 7 14.5 7H9v10h6c1.5 0 2.5-1 2.5-2.5S16 12 14.5 12zm-3-3h2.5c.5 0 1 .5 1 1s-.5 1-1 1H11.5V9zm3 6H11.5v-2H14.5c.5 0 1 .5 1 1s-.5 1-1 1z"/></svg>
                    </div>
                    Crypto Market
                </h3>
            </div>
            <div class="tradingview-widget-container" style="height: 350px;">
                <div class="tradingview-widget-container__widget" style="height: 100%;"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-crypto-coins-heatmap.js" async>
                {
                    "dataSource": "Crypto",
                    "blockSize": "market_cap_calc",
                    "blockColor": "change",
                    "locale": "en",
                    "symbolUrl": "",
                    "colorTheme": "dark",
                    "hasTopBar": false,
                    "isDataSet498Enabled": false,
                    "isZoomEnabled": true,
                    "hasSymbolTooltip": true,
                    "width": "100%",
                    "height": "100%"
                }
                </script>
            </div>
        </div>
    </section>

    <!-- Recent Transactions -->
    <section class="glass-panel rounded-2xl border border-dark-600 overflow-hidden">
        <div class="p-6 border-b border-dark-600 flex justify-between items-center bg-dark-800/50">
            <h3 class="font-bold text-white">Recent Transactions</h3>
            <button class="text-gray-400 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg></button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-400">
                <thead class="text-xs uppercase bg-dark-700/50 border-b border-dark-600">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-300">Type</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-300">Asset</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-300">Amount</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-300">Date</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-300 text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-dark-600 hover:bg-dark-700/30">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 text-green-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg> Buy</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-white">Tesla (TSLA)</td>
                        <td class="px-6 py-4">10.5 Shares</td>
                        <td class="px-6 py-4">Today, 14:32</td>
                        <td class="px-6 py-4 text-right"><span class="bg-green-500/10 text-green-400 px-2.5 py-1 rounded-md text-xs font-medium border border-green-500/20">Completed</span></td>
                    </tr>
                    <tr class="border-b border-dark-600 hover:bg-dark-700/30">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 text-red-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg> Sell</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-white">Ethereum (ETH)</td>
                        <td class="px-6 py-4">0.5 ETH</td>
                        <td class="px-6 py-4">Yesterday, 09:15</td>
                        <td class="px-6 py-4 text-right"><span class="bg-green-500/10 text-green-400 px-2.5 py-1 rounded-md text-xs font-medium border border-green-500/20">Completed</span></td>
                    </tr>
                    <tr class="hover:bg-dark-700/30">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 text-blue-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg> Deposit</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-white">USD</td>
                        <td class="px-6 py-4">$5,000.00</td>
                        <td class="px-6 py-4">May 01, 2026</td>
                        <td class="px-6 py-4 text-right"><span class="bg-green-500/10 text-green-400 px-2.5 py-1 rounded-md text-xs font-medium border border-green-500/20">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Market Overview Chart -->
    <section class="glass-panel rounded-2xl border border-dark-600 overflow-hidden mt-6">
        <div class="p-4 md:p-6 border-b border-dark-600 flex justify-between items-center bg-dark-800/50">
            <h3 class="font-bold text-white text-base md:text-lg">Market Overview</h3>
        </div>
        <div class="h-[350px] sm:h-[400px] md:h-[500px] lg:h-[600px] w-full bg-dark-900">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container" style="height:100%;width:100%">
              <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
              <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
              {
              "autosize": true,
              "width": "100%",
              "height": "100%",
              "symbol": "BITSTAMP:BTCUSD",
              "interval": "1",
              "timezone": "Etc/UTC",
              "theme": "dark",
              "style": "1",
              "locale": "en",
              "enable_publishing": false,
              "backgroundColor": "#08060f",
              "gridColor": "#2a2536",
              "hide_top_toolbar": false,
              "hide_legend": false,
              "save_image": false,
              "allow_symbol_change": true,
              "calendar": false,
              "support_host": "https://www.tradingview.com"
            }
              </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </section>

</div>
@endsection
