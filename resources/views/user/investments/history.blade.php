@extends('user.layouts.app')

@section('title', 'Investment History | Prime Trade Access')
@section('header_title', 'Investment History')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Your Investments</h2>
            <p class="text-gray-400">Track your active and completed investment portfolios.</p>
        </div>
        <div class="hidden sm:block text-right">
            <p class="text-sm text-gray-400">Total Invested</p>
            <p class="text-xl font-bold text-white">${{ number_format($investments->sum('amount'), 2) }}</p>
        </div>
    </div>

    @if($investments->isEmpty())
        <div class="glass-panel p-12 rounded-2xl border border-dark-600 text-center flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-dark-700 rounded-full flex items-center justify-center mb-4 border border-dark-600">
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">No Investments Yet</h3>
            <p class="text-gray-400 max-w-md mx-auto mb-6">You haven't made any investments. Explore our Tesla and Crypto pools to start earning ROI.</p>
            <div class="flex gap-4">
                <a href="{{ route('investments.tesla') }}" class="bg-red-600 hover:bg-red-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors shadow-[0_0_15px_rgba(220,38,38,0.3)]">Tesla Plans</a>
                <a href="{{ route('investments.crypto') }}" class="bg-orange-500 hover:bg-orange-400 text-white px-6 py-2.5 rounded-xl font-medium transition-colors shadow-[0_0_15px_rgba(249,115,22,0.3)]">Crypto Plans</a>
            </div>
        </div>
    @else
        <div class="glass-panel rounded-2xl border border-dark-600 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="text-xs uppercase bg-dark-700/50 border-b border-dark-600">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-300">Plan Details</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-300">Amount</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-300">Expected ROI</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-300">Start Date</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-300">End Date</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-300 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($investments as $investment)
                            <tr class="border-b border-dark-600 hover:bg-dark-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($investment->plan->type == 'tesla')
                                            <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-400 border border-red-500/30 flex items-center justify-center font-bold text-xs">T</div>
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-orange-500/20 text-orange-400 border border-orange-500/30 flex items-center justify-center font-bold text-xs">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14.5 12c1.5 0 2.5-1 2.5-2.5S16 7 14.5 7H9v10h6c1.5 0 2.5-1 2.5-2.5S16 12 14.5 12zm-3-3h2.5c.5 0 1 .5 1 1s-.5 1-1 1H11.5V9zm3 6H11.5v-2H14.5c.5 0 1 .5 1 1s-.5 1-1 1z"/></svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-white">{{ $investment->plan->name }}</p>
                                            <p class="text-xs text-gray-500 capitalize">{{ $investment->plan->type }} Pool</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-white">
                                    ${{ number_format($investment->amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-green-400">+{{ $investment->plan->roi_percent }}%</span>
                                    <p class="text-xs text-gray-500">${{ number_format($investment->amount * ($investment->plan->roi_percent / 100), 2) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $investment->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $investment->created_at->addDays($investment->plan->duration_days)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($investment->status == 'active')
                                        <span class="bg-brand-500/10 text-brand-400 px-2.5 py-1 rounded-md text-xs font-medium border border-brand-500/20">Active</span>
                                    @else
                                        <span class="bg-green-500/10 text-green-400 px-2.5 py-1 rounded-md text-xs font-medium border border-green-500/20">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
