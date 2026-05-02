@extends('admin.layouts.app')

@section('title', 'Dashboard | Admin PTA')
@section('header_title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    
    <!-- Stats Overview -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="glass-panel p-6 rounded-2xl border border-dark-600 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <p class="text-gray-400 font-medium mb-1">Total Users</p>
            <h2 class="text-3xl font-bold text-white tracking-tight">{{ $stats['total_users'] }}</h2>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-dark-600 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-gray-400 font-medium mb-1">Total Deposits</p>
            <h2 class="text-3xl font-bold text-white tracking-tight">${{ number_format($stats['total_deposits'], 2) }}</h2>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-dark-600 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0zm-1.07 18.062v-1.84c-3.143-.377-4.14-2.584-4.14-2.584.806-.44.896-.347.896-.347 1.157.962 3.102 1.353 4.295.69 1.488-.823.957-2.73-1.03-3.665-2.288-1.078-4.996-2.023-4.524-5.115.343-2.247 2.37-3.414 4.503-3.722V-.001h1.983v1.654c2.616.48 3.528 2.274 3.528 2.274-.632.617-.837.545-.837.545-.92-1.025-2.618-1.32-3.738-.646-1.094.66-1.125 2.18-.088 2.87 2.316 1.542 5.285 2.057 4.542 5.438-.55 2.502-2.82 3.486-4.39 3.926v1.98h-1.999z"></path></svg>
                </div>
            </div>
            <p class="text-gray-400 font-medium mb-1">Pending Withdrawals</p>
            <h2 class="text-3xl font-bold text-white tracking-tight">{{ $stats['pending_withdrawals'] }}</h2>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-dark-600 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/3"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
            <p class="text-gray-400 font-medium mb-1">Active Investments</p>
            <h2 class="text-3xl font-bold text-white tracking-tight">{{ $stats['active_investments'] }}</h2>
        </div>
        
    </section>

</div>
@endsection
