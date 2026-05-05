@extends('user.layouts.app')

@section('title', 'Dashboard | Prime Trade Access')
@section('header_title', 'Welcome back, ' . (auth()->user()->name ?? 'Investor'))

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    
    <!-- Balance Overview -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Balance -->
        <div class="glass-panel p-8 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center">
            <div class="absolute right-0 top-0 w-32 h-32 bg-brand-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-3 tracking-tight">$ {{ number_format(auth()->user()->balance, 2) }}</h2>
            <p class="text-gray-400 font-medium text-sm tracking-widest uppercase">Total Balance</p>
        </div>

        <!-- Capital -->
        <div class="glass-panel p-8 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-3 tracking-tight">$ {{ number_format(auth()->user()->deposits->where('status', 'approved')->sum('amount'), 2) }}</h2>
            <p class="text-gray-400 font-medium text-sm tracking-widest uppercase">Capital</p>
        </div>

        <!-- Profit Earned -->
        <div class="glass-panel p-8 rounded-2xl border border-dark-600 relative overflow-hidden flex flex-col justify-center">
            <div class="absolute right-0 top-0 w-32 h-32 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-3 tracking-tight">$ {{ number_format(auth()->user()->profits->where('type', 'add')->sum('amount') - auth()->user()->profits->where('type', 'subtract')->sum('amount'), 2) }}</h2>
            <p class="text-gray-400 font-medium text-sm tracking-widest uppercase">Profit Earned</p>
        </div>
    </section>

    <!-- Quick Actions -->
    <div class="flex gap-4">
        <a href="{{ route('deposits.index') }}" class="flex-1 text-center bg-brand-500 hover:bg-brand-400 text-white px-6 py-3.5 rounded-xl font-semibold transition-colors shadow-[0_0_15px_rgba(160,113,255,0.4)]">Deposit</a>
        <a href="{{ route('withdrawals.index') }}" class="flex-1 text-center bg-dark-700 hover:bg-dark-600 text-white px-6 py-3.5 rounded-xl font-semibold transition-colors border border-dark-600">Withdraw</a>
    </div>

    <!-- Assets Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tesla Card -->
        <div class="glass-panel rounded-2xl border border-dark-600 overflow-hidden">
            <div class="p-6 border-b border-dark-600 flex justify-between items-center bg-dark-800/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-600 text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-[0_0_15px_rgba(220,38,38,0.5)]">T</div>
                    <div>
                        <h3 class="font-bold text-white">Tesla, Inc.</h3>
                        <p class="text-xs text-gray-400">TSLA • Equity</p>
                    </div>
                </div>
                <div class="text-right">
                    <h4 class="font-bold text-white text-lg">$245.80</h4>
                    <p class="text-xs text-green-400">+2.4% Today</p>
                </div>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Your Holding</p>
                        <p class="text-2xl font-bold text-white">376.5 <span class="text-sm font-normal text-gray-500">Shares</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-400 mb-1">Value</p>
                        <p class="text-xl font-semibold text-white">$92,543.70</p>
                    </div>
                </div>
                <!-- Mock Chart -->
                <div class="h-24 w-full bg-gradient-to-t from-red-500/10 to-transparent border-b-2 border-red-500 relative flex items-end justify-between px-2 pb-2">
                    <div class="w-1 bg-red-500 h-1/3 rounded-t-sm opacity-50"></div>
                    <div class="w-1 bg-red-500 h-1/2 rounded-t-sm opacity-50"></div>
                    <div class="w-1 bg-red-500 h-2/5 rounded-t-sm opacity-50"></div>
                    <div class="w-1 bg-red-500 h-3/5 rounded-t-sm opacity-50"></div>
                    <div class="w-1 bg-red-500 h-1/2 rounded-t-sm opacity-50"></div>
                    <div class="w-1 bg-red-500 h-4/5 rounded-t-sm opacity-80 shadow-[0_0_8px_rgba(239,68,68,1)]"></div>
                </div>
                <button class="w-full mt-6 bg-dark-700 hover:bg-dark-600 text-white py-2.5 rounded-xl font-medium transition-colors text-sm">Trade TSLA</button>
            </div>
        </div>

        <!-- Crypto Card -->
        <div class="glass-panel rounded-2xl border border-dark-600 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-dark-600 bg-dark-800/50 flex justify-between items-center">
                <h3 class="font-bold text-white">Crypto Assets</h3>
                <a href="#" class="text-sm text-brand-400 hover:text-brand-300">View All</a>
            </div>
            <div class="p-0 flex-1">
                <!-- BTC -->
                <div class="flex items-center justify-between p-6 border-b border-dark-600 hover:bg-dark-700/50 transition-colors cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center text-orange-400 border border-orange-500/30">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M14.5 12c1.5 0 2.5-1 2.5-2.5S16 7 14.5 7H9v10h6c1.5 0 2.5-1 2.5-2.5S16 12 14.5 12zm-3-3h2.5c.5 0 1 .5 1 1s-.5 1-1 1H11.5V9zm3 6H11.5v-2H14.5c.5 0 1 .5 1 1s-.5 1-1 1z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-white">Bitcoin</p>
                            <p class="text-xs text-gray-400">BTC</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-white">0.5421 BTC</p>
                        <p class="text-sm text-gray-400">$35,840.10</p>
                    </div>
                </div>
                <!-- ETH -->
                <div class="flex items-center justify-between p-6 hover:bg-dark-700/50 transition-colors cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 border border-blue-500/30">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L4 14l8 2 8-2L12 2zm0 14.5l-6-1.5 6-6 6 6-6 1.5zM12 18l-8-2.5L12 22l8-6.5L12 18z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-white">Ethereum</p>
                            <p class="text-xs text-gray-400">ETH</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-white">4.205 ETH</p>
                        <p class="text-sm text-gray-400">$14,006.70</p>
                    </div>
                </div>
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
