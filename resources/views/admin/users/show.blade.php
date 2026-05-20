@extends('admin.layouts.app')

@section('title', 'View User | Admin PTA')
@section('header_title', 'User Details')

@section('content')
<div x-data="{ 
        balanceModalOpen: false, 
        profitModalOpen: false,
        mailModalOpen: false,
        bonusModalOpen: false,
        amountsModalOpen: false,
        activeTab: 'overview'
    }" class="max-w-7xl mx-auto space-y-6">

    <!-- Header Actions -->
    <div class="flex justify-between items-start gap-4">
        <div class="min-w-0">
            <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                <a href="{{ route('admin.users.index') }}" class="hover:text-white transition-colors">Users</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-white">{{ $user->name }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl text-white font-bold tracking-tight">{{ $user->name }}</h1>
        </div>
        
        <div class="relative" x-data="{ actionsOpen: false }">
            <button @click="actionsOpen = !actionsOpen" class="px-5 py-2.5 bg-dark-700 hover:bg-dark-600 border border-dark-600 text-white text-sm font-medium rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Actions
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': actionsOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <div x-show="actionsOpen" @click.outside="actionsOpen = false" 
                 x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-56 glass-panel border border-dark-600 rounded-xl shadow-2xl z-50 py-2 origin-top-right" style="display: none;">
                
                <button @click="balanceModalOpen = true; actionsOpen = false" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-dark-700 transition-colors">
                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Update Balance
                </button>

                <button @click="profitModalOpen = true; actionsOpen = false" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-dark-700 transition-colors">
                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Update Profit
                </button>

                <button @click="bonusModalOpen = true; actionsOpen = false" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-dark-700 transition-colors">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    Update Bonuses
                </button>

                <button @click="amountsModalOpen = true; actionsOpen = false" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-dark-700 transition-colors">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Update Manual Stats
                </button>

                <button @click="mailModalOpen = true; actionsOpen = false" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-dark-700 transition-colors">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Send Mail
                </button>

                <form action="{{ route('admin.users.loginAs', $user) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-dark-700 transition-colors">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Login As User
                    </button>
                </form>

                <div class="my-1 border-t border-dark-600"></div>

                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this user? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Stats & Profile -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="glass-panel rounded-xl border border-dark-600 overflow-hidden relative">
                <div class="h-24 bg-gradient-to-r from-brand-500 to-blue-500"></div>
                <div class="px-6 pb-6 relative">
                    <div class="w-20 h-20 rounded-xl bg-dark-800 border-4 border-dark-900 flex items-center justify-center text-2xl font-bold text-white -mt-10 mb-4 shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    
                    <h2 class="text-xl font-bold text-white mb-1">{{ $user->name }}</h2>
                    <p class="text-brand-400 text-sm mb-6">{{ '@' . $user->username }}</p>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Email Address</p>
                            <div class="flex items-center gap-2 text-white">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $user->email }}
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Phone Number</p>
                            <div class="flex items-center gap-2 text-white">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $user->phone ?? 'Not provided' }}
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Country</p>
                            <div class="flex items-center gap-2 text-white">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $user->country ?? 'Not provided' }}
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Registered</p>
                            <div class="flex items-center gap-2 text-white">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $user->created_at->format('M d, Y h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Balance Card -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-panel rounded-xl border border-dark-600 p-6 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-64 h-64 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 -translate-y-1/2 translate-x-1/3"></div>
                
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-6 relative z-10">
                    <div>
                        <p class="text-gray-400 font-medium mb-1 uppercase tracking-wider text-xs">Available Balance</p>
                        <h2 class="text-4xl font-bold text-white tracking-tight">${{ number_format($user->balance, 2) }}</h2>
                    </div>
                    
                    <button @click="balanceModalOpen = true" class="bg-brand-500 hover:bg-brand-400 text-white px-5 py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-brand-500/20 flex items-center gap-2 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Update Balance
                    </button>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-8 pt-6 border-t border-dark-600">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Total Deposits</p>
                        <p class="text-lg font-semibold text-white">${{ number_format($user->deposits->where('status', 'approved')->sum('amount') + $user->manual_deposits, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Total Withdrawn</p>
                        <p class="text-lg font-semibold text-white">${{ number_format($user->withdrawals->where('status', 'approved')->sum('amount') + $user->manual_withdrawals, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Pending W/D</p>
                        <p class="text-lg font-semibold text-amber-400">${{ number_format($user->withdrawals->where('status', 'pending')->sum('amount'), 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Active Invest</p>
                        <p class="text-lg font-semibold text-green-400">${{ number_format($user->investments->where('status', 'active')->sum('amount') + $user->manual_investments, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Sign Up Bonus</p>
                        <p class="text-lg font-semibold text-amber-400">${{ number_format($user->signup_bonus, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Affiliate Bonus</p>
                        <p class="text-lg font-semibold text-emerald-400">${{ number_format($user->affiliate_bonus, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex gap-2 overflow-x-auto border-b border-dark-600 pb-px hide-scrollbar">
                <button @click="activeTab = 'overview'" :class="{ 'text-brand-400 border-brand-500': activeTab === 'overview', 'text-gray-400 border-transparent hover:text-white': activeTab !== 'overview' }" class="px-4 py-2 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
                    Overview Activity
                </button>
                <button @click="activeTab = 'deposits'" :class="{ 'text-brand-400 border-brand-500': activeTab === 'deposits', 'text-gray-400 border-transparent hover:text-white': activeTab !== 'deposits' }" class="px-4 py-2 border-b-2 font-medium text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                    Deposits <span class="bg-dark-700 text-gray-300 py-0.5 px-2 rounded-full text-xs">{{ $user->deposits->count() }}</span>
                </button>
                <button @click="activeTab = 'withdrawals'" :class="{ 'text-brand-400 border-brand-500': activeTab === 'withdrawals', 'text-gray-400 border-transparent hover:text-white': activeTab !== 'withdrawals' }" class="px-4 py-2 border-b-2 font-medium text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                    Withdrawals <span class="bg-dark-700 text-gray-300 py-0.5 px-2 rounded-full text-xs">{{ $user->withdrawals->count() }}</span>
                </button>
                <button @click="activeTab = 'investments'" :class="{ 'text-brand-400 border-brand-500': activeTab === 'investments', 'text-gray-400 border-transparent hover:text-white': activeTab !== 'investments' }" class="px-4 py-2 border-b-2 font-medium text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                    Investments <span class="bg-dark-700 text-gray-300 py-0.5 px-2 rounded-full text-xs">{{ $user->investments->count() }}</span>
                </button>
            </div>

            <!-- Tabs Content -->
            <div class="glass-panel rounded-xl border border-dark-600 p-6 min-h-[300px]">
                
                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <p class="text-gray-400 mb-4">Recent activity overview for this user.</p>
                    
                    @php
                        $recentActivity = collect()
                            ->concat($user->deposits->map(function($item) { $item->type = 'Deposit'; return $item; }))
                            ->concat($user->withdrawals->map(function($item) { $item->type = 'Withdrawal'; return $item; }))
                            ->concat($user->investments->map(function($item) { $item->type = 'Investment'; return $item; }))
                            ->sortByDesc('created_at')
                            ->take(5);
                    @endphp

                    @if($recentActivity->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-gray-400">No recent activity.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($recentActivity as $activity)
                                <div class="flex items-center justify-between p-4 bg-dark-800/50 rounded-xl border border-dark-600">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 
                                            {{ $activity->type === 'Deposit' ? 'bg-green-500/10 text-green-500' : '' }}
                                            {{ $activity->type === 'Withdrawal' ? 'bg-amber-500/10 text-amber-500' : '' }}
                                            {{ $activity->type === 'Investment' ? 'bg-blue-500/10 text-blue-500' : '' }}
                                        ">
                                            @if($activity->type === 'Deposit') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg> @endif
                                            @if($activity->type === 'Withdrawal') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7 7v18"></path></svg> @endif
                                            @if($activity->type === 'Investment') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> @endif
                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm">{{ $activity->type }} <span class="text-gray-400 font-normal ml-1">via {{ strtoupper($activity->method ?? ($activity->plan->name ?? 'Unknown')) }}</span></p>
                                            <p class="text-xs text-gray-500 mt-0.5">{{ $activity->created_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-white font-semibold">${{ number_format($activity->amount, 2) }}</p>
                                        <p class="text-xs mt-0.5
                                            {{ $activity->status === 'approved' || $activity->status === 'active' ? 'text-green-400' : '' }}
                                            {{ $activity->status === 'pending' ? 'text-amber-400' : '' }}
                                            {{ $activity->status === 'rejected' ? 'text-red-400' : '' }}
                                        ">{{ ucfirst($activity->status) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Deposits Tab -->
                <div x-show="activeTab === 'deposits'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if($user->deposits->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No deposits found.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-500 uppercase bg-dark-800">
                                    <tr>
                                        <th class="px-4 py-3">Date</th>
                                        <th class="px-4 py-3">Method</th>
                                        <th class="px-4 py-3">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->deposits()->latest()->get() as $deposit)
                                    <tr class="border-b border-dark-600">
                                        <td class="px-4 py-3 text-gray-300">{{ $deposit->created_at->format('M d, Y h:i A') }}</td>
                                        <td class="px-4 py-3 text-white">{{ strtoupper($deposit->method) }}</td>
                                        <td class="px-4 py-3 font-semibold text-green-400">${{ number_format($deposit->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Withdrawals Tab -->
                <div x-show="activeTab === 'withdrawals'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if($user->withdrawals->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No withdrawals found.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-500 uppercase bg-dark-800">
                                    <tr>
                                        <th class="px-4 py-3">Date</th>
                                        <th class="px-4 py-3">Method</th>
                                        <th class="px-4 py-3">Amount</th>
                                        <th class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->withdrawals()->latest()->get() as $withdrawal)
                                    <tr class="border-b border-dark-600">
                                        <td class="px-4 py-3 text-gray-300">{{ $withdrawal->created_at->format('M d, Y h:i A') }}</td>
                                        <td class="px-4 py-3 text-white">
                                            <div class="font-medium text-xs mb-1">{{ strtoupper($withdrawal->method) }}</div>
                                            @if(\Illuminate\Support\Str::startsWith($withdrawal->destination, '{') && ($decoded = json_decode($withdrawal->destination, true)))
                                                <div class="space-y-0.5 text-[11px] text-gray-400">
                                                    <div><span class="text-gray-600 font-medium">Bank:</span> {{ $decoded['bank_name'] ?? '' }}</div>
                                                    <div><span class="text-gray-600 font-medium">Holder:</span> {{ $decoded['account_name'] ?? '' }}</div>
                                                    <div><span class="text-gray-600 font-medium">Acc:</span> {{ $decoded['account_number'] ?? '' }}</div>
                                                    <div><span class="text-gray-600 font-medium">Rout/SWIFT:</span> {{ $decoded['routing_number'] ?? '' }}</div>
                                                    @if(!empty($decoded['bank_address']))
                                                        <div><span class="text-gray-600 font-medium">Branch:</span> {{ $decoded['bank_address'] ?? '' }}</div>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-500 select-all">{{ $withdrawal->destination }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 font-semibold text-amber-400">${{ number_format($withdrawal->amount, 2) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $withdrawal->status === 'approved' ? 'bg-green-500/10 text-green-500' : '' }}
                                                {{ $withdrawal->status === 'pending' ? 'bg-amber-500/10 text-amber-500' : '' }}
                                                {{ $withdrawal->status === 'rejected' ? 'bg-red-500/10 text-red-500' : '' }}
                                            ">{{ ucfirst($withdrawal->status) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Investments Tab -->
                <div x-show="activeTab === 'investments'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if($user->investments->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No investments found.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-500 uppercase bg-dark-800">
                                    <tr>
                                        <th class="px-4 py-3">Date</th>
                                        <th class="px-4 py-3">Plan</th>
                                        <th class="px-4 py-3">Amount</th>
                                        <th class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->investments()->latest()->get() as $investment)
                                    <tr class="border-b border-dark-600">
                                        <td class="px-4 py-3 text-gray-300">{{ $investment->created_at->format('M d, Y h:i A') }}</td>
                                        <td class="px-4 py-3 text-white">{{ $investment->plan->name ?? 'Unknown' }}</td>
                                        <td class="px-4 py-3 font-semibold text-blue-400">${{ number_format($investment->amount, 2) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $investment->status === 'active' ? 'bg-green-500/10 text-green-500' : 'bg-gray-500/10 text-gray-400' }}">{{ ucfirst($investment->status) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Modals -->

    <!-- Update Balance Modal -->
    <div x-show="balanceModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="balanceModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="balanceModalOpen = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="balanceModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div class="px-6 py-6 border-b border-dark-600 flex items-center justify-between">
                    <h3 class="text-xl leading-6 font-semibold text-white" id="modal-title">Update Balance</h3>
                    <button @click="balanceModalOpen = false" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form action="{{ route('admin.users.balance', $user) }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-5">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Action</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="add" class="peer sr-only" checked>
                                    <div class="rounded-lg border border-dark-600 px-4 py-3 text-center hover:bg-dark-700 peer-checked:bg-brand-500/10 peer-checked:border-brand-500 peer-checked:text-brand-400 transition-colors">
                                        <span class="block text-sm font-medium text-gray-300 peer-checked:text-brand-400">Add Funds</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="subtract" class="peer sr-only">
                                    <div class="rounded-lg border border-dark-600 px-4 py-3 text-center hover:bg-dark-700 peer-checked:bg-red-500/10 peer-checked:border-red-500 peer-checked:text-red-400 transition-colors">
                                        <span class="block text-sm font-medium text-gray-300 peer-checked:text-red-400">Debit Funds</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Amount (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="amount" step="0.01" min="0.01" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors" required>
                            </div>
                        </div>

                        <div class="bg-dark-800/80 rounded-lg p-4 text-sm text-gray-400">
                            Current balance: <span class="text-white font-medium">${{ number_format($user->balance, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="balanceModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-brand-500 text-white rounded-lg font-medium hover:bg-brand-400 transition-colors shadow-lg shadow-brand-500/20">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Profit Modal -->
    <div x-show="profitModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title-profit" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="profitModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="profitModalOpen = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="profitModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div class="px-6 py-6 border-b border-dark-600 flex items-center justify-between">
                    <h3 class="text-xl leading-6 font-semibold text-white" id="modal-title-profit">Update Profit</h3>
                    <button @click="profitModalOpen = false" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form action="{{ route('admin.users.profit', $user) }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-5">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Action</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="add" class="peer sr-only" checked>
                                    <div class="rounded-lg border border-dark-600 px-4 py-3 text-center hover:bg-dark-700 peer-checked:bg-brand-500/10 peer-checked:border-brand-500 peer-checked:text-brand-400 transition-colors">
                                        <span class="block text-sm font-medium text-gray-300 peer-checked:text-brand-400">Add Profit</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="subtract" class="peer sr-only">
                                    <div class="rounded-lg border border-dark-600 px-4 py-3 text-center hover:bg-dark-700 peer-checked:bg-red-500/10 peer-checked:border-red-500 peer-checked:text-red-400 transition-colors">
                                        <span class="block text-sm font-medium text-gray-300 peer-checked:text-red-400">Deduct Profit</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Amount (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="amount" step="0.01" min="0.01" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors" required>
                            </div>
                        </div>

                        <div class="bg-dark-800/80 rounded-lg p-4 text-sm text-gray-400">
                            Current balance: <span class="text-white font-medium">${{ number_format($user->balance, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="profitModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-brand-500 text-white rounded-lg font-medium hover:bg-brand-400 transition-colors shadow-lg shadow-brand-500/20">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Send Mail Modal -->
    <div x-show="mailModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="mailModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="mailModalOpen = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="mailModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                
                <div class="px-6 py-6 border-b border-dark-600 flex items-center justify-between">
                    <h3 class="text-xl leading-6 font-semibold text-white" id="modal-title">Send Email to {{ $user->name }}</h3>
                    <button @click="mailModalOpen = false" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form action="{{ route('admin.users.mail', $user) }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-5">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">To</label>
                            <input type="text" value="{{ $user->email }}" class="w-full bg-dark-800 border border-dark-600 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed" disabled>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Subject</label>
                            <input type="text" name="subject" placeholder="Enter email subject" class="w-full bg-dark-800 border border-dark-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                            <textarea name="message" rows="6" placeholder="Type your message here..." class="w-full bg-dark-800 border border-dark-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-none" required></textarea>
                            <p class="text-xs text-gray-500 mt-2">The message will be wrapped in the standard email template with a greeting to the user.</p>
                        </div>

                    </div>
                    
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="mailModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-400 transition-colors shadow-lg shadow-blue-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Bonuses Modal -->
    <div x-show="bonusModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title-bonus" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="bonusModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="bonusModalOpen = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="bonusModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div class="px-6 py-6 border-b border-dark-600 flex items-center justify-between">
                    <h3 class="text-xl leading-6 font-semibold text-white" id="modal-title-bonus">Update Bonuses</h3>
                    <button @click="bonusModalOpen = false" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form action="{{ route('admin.users.bonus', $user) }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-5">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Sign Up Bonus (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="signup_bonus" step="0.01" min="0" value="{{ $user->signup_bonus }}" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Affiliate Bonus (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="affiliate_bonus" step="0.01" min="0" value="{{ $user->affiliate_bonus }}" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors" required>
                            </div>
                        </div>

                        <div class="bg-dark-800/80 rounded-lg p-4 text-sm text-gray-400">
                            These bonus values are displayed on the user's dashboard. Changing them updates the displayed amount immediately.
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="bonusModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-400 transition-colors shadow-lg shadow-amber-500/20">Save Bonuses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Manual Stats Modal -->
    <div x-show="amountsModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title-amounts" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="amountsModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="amountsModalOpen = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="amountsModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div class="px-6 py-6 border-b border-dark-600 flex items-center justify-between">
                    <h3 class="text-xl leading-6 font-semibold text-white" id="modal-title-amounts">Update Manual Stats</h3>
                    <button @click="amountsModalOpen = false" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form action="{{ route('admin.users.amounts', $user) }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-5">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Total Deposits Modifier (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="manual_deposits" step="0.01" value="{{ $user->manual_deposits }}" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Total Withdrawn Modifier (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="manual_withdrawals" step="0.01" value="{{ $user->manual_withdrawals }}" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Active Invest Modifier (USD)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">$</span>
                                </div>
                                <input type="number" name="manual_investments" step="0.01" value="{{ $user->manual_investments }}" placeholder="0.00" class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                            </div>
                        </div>

                        <div class="bg-dark-800/80 rounded-lg p-4 text-sm text-gray-400">
                            These modifiers are ADDED to the user's actual approved transactions. Use negative values to reduce the displayed amount. For example, setting deposits modifier to -50 will reduce their displayed total deposits by $50.
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="amountsModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-400 transition-colors shadow-lg shadow-cyan-500/20">Save Modifiers</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
