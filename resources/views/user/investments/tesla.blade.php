@extends('user.layouts.app')

@section('title', 'Tesla Assets | Prime Trade Access')
@section('header_title', 'Tesla Investment Plans')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-lg shadow-[0_0_15px_rgba(220,38,38,0.5)]">T</span>
                Tesla Equity Plans
            </h2>
            <p class="text-gray-400">Invest directly in Tesla stock pools. Earn stable daily ROI.</p>
        </div>
        <div class="hidden sm:block text-right">
            <p class="text-sm text-gray-400">Available Balance</p>
            <p class="text-xl font-bold text-brand-400">${{ number_format(auth()->user()->balance ?? 0, 2) }}</p>
        </div>
    </div>

    @php
        $activeInvestment = auth()->user()->investments()->where('status', 'active')->whereHas('plan', function($q) { $q->where('type', 'tesla'); })->sum('amount');
        $totalEarned = auth()->user()->investments()->whereHas('plan', function($q) { $q->where('type', 'tesla'); })->sum('returns_earned');
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
        <div class="glass-panel p-6 rounded-2xl border border-dark-600 lg:col-span-2 relative overflow-hidden flex flex-col justify-center">
            <div class="absolute right-0 top-0 w-64 h-64 bg-red-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 translate-x-1/3 -translate-y-1/3"></div>
            <h3 class="text-xl font-bold text-white mb-2">Tesla Equity Investment</h3>
            <p class="text-gray-400 text-sm leading-relaxed max-w-2xl">
                Our Tesla equity pools offer exposure to high-growth TSLA shares without the need to actively trade. Funds are pooled and managed by our proprietary algorithms to generate stable, daily returns regardless of short-term market volatility. Choose a plan that fits your financial goals and lock in your expected ROI over the designated duration.
            </p>
            <div class="mt-6 flex items-center gap-6">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Sector</p>
                    <p class="text-white text-sm font-medium">Technology / Automotive</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Risk Level</p>
                    <p class="text-white text-sm font-medium">Moderate</p>
                </div>
            </div>
        </div>
        <div class="glass-panel p-6 rounded-2xl border border-dark-600 flex flex-col justify-center text-center">
            <p class="text-gray-400 text-sm font-medium mb-1">Active Tesla Investment</p>
            <p class="text-3xl font-bold text-white mb-4">${{ number_format($activeInvestment, 2) }}</p>
            
            <p class="text-gray-400 text-sm font-medium mb-1">Total Returns Earned</p>
            <p class="text-xl font-bold text-green-400">+${{ number_format($totalEarned, 2) }}</p>
        </div>
    </div>

    <h3 class="text-xl font-bold text-white mb-6">Available Plans</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($plans as $plan)
            <div class="glass-panel p-6 rounded-2xl border border-dark-600 hover:border-red-500/50 transition-colors flex flex-col h-full relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-500 rounded-full filter blur-3xl opacity-10 group-hover:opacity-20 transition-opacity"></div>
                
                <h3 class="text-xl font-bold text-white mb-1">{{ $plan->name }}</h3>
                <p class="text-sm text-gray-400 mb-6">Duration: {{ $plan->duration_days }} Days</p>
                
                <div class="mb-6 space-y-3 flex-1">
                    <div class="flex justify-between items-center pb-3 border-b border-dark-600/50">
                        <span class="text-gray-400 text-sm">Minimum</span>
                        <span class="text-white font-medium">${{ number_format($plan->min_amount) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-dark-600/50">
                        <span class="text-gray-400 text-sm">Maximum</span>
                        <span class="text-white font-medium">${{ number_format($plan->max_amount) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-dark-600/50">
                        <span class="text-gray-400 text-sm">Expected ROI</span>
                        <span class="text-green-400 font-bold">+{{ $plan->roi_percent }}%</span>
                    </div>
                </div>

                <form x-data="{ loading: false }" action="{{ route('investments.store', $plan->id) }}" method="POST" @submit="loading = true">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-xs text-gray-400 mb-1">Enter Amount (USD)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">$</span>
                            </div>
                            <input type="number" name="amount" min="{{ $plan->min_amount }}" max="{{ $plan->max_amount }}" step="0.01" required 
                                class="w-full bg-dark-700 border border-dark-600 rounded-xl pl-8 pr-4 py-2.5 text-white focus:outline-none focus:border-red-500/50 transition-colors text-sm" 
                                placeholder="0.00">
                        </div>
                    </div>
                    
                    <button type="submit" :disabled="loading" 
                        class="w-full bg-dark-700 hover:bg-red-600 text-white py-3 rounded-xl font-bold transition-all border border-dark-600 hover:border-red-500 flex justify-center items-center gap-2 group-hover:bg-red-600 group-hover:border-red-500"
                        :class="{'opacity-75 cursor-not-allowed': loading}">
                        
                        <span x-show="!loading">Invest Now</span>
                        <span x-show="loading" class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
