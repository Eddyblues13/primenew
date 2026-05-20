@extends('user.layouts.app')

@section('title', 'Withdrawal History')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Page Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-100 font-bold">Withdrawal History 📋</h1>
            <p class="text-sm text-slate-400 mt-2">Track the status of your recent withdrawal requests.</p>
        </div>
        
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
            <a href="{{ route('withdrawals.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-colors shadow-lg shadow-blue-500/20 inline-flex items-center">
                <svg class="w-4 h-4 fill-current opacity-50 shrink-0 mr-2" viewBox="0 0 16 16">
                    <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                </svg>
                New Withdrawal
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="glass-panel rounded-xl border border-slate-700/50 relative overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-auto w-full divide-y divide-slate-700/50">
                <thead class="text-xs uppercase text-slate-400 bg-slate-800/50">
                    <tr>
                        <th class="px-4 py-4 whitespace-nowrap">
                            <div class="font-semibold text-left">Date</div>
                        </th>
                        <th class="px-4 py-4 whitespace-nowrap">
                            <div class="font-semibold text-left">Method</div>
                        </th>
                        <th class="px-4 py-4 whitespace-nowrap">
                            <div class="font-semibold text-left">Destination</div>
                        </th>
                        <th class="px-4 py-4 whitespace-nowrap">
                            <div class="font-semibold text-left">Amount</div>
                        </th>
                        <th class="px-4 py-4 whitespace-nowrap">
                            <div class="font-semibold text-left">Status</div>
                        </th>
                    </tr>
                </thead>
                
                <tbody class="text-sm divide-y divide-slate-700/50">
                    @forelse($withdrawals as $withdrawal)
                    <tr class="hover:bg-slate-800/20 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-slate-300">{{ $withdrawal->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-slate-500">{{ $withdrawal->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-slate-300 font-medium">{{ strtoupper($withdrawal->method) }}</div>
                        </td>
                        <td class="px-4 py-4">
                            @if(\Illuminate\Support\Str::startsWith($withdrawal->destination, '{') && ($decoded = json_decode($withdrawal->destination, true)))
                                <div class="space-y-1 text-xs text-slate-300">
                                    @if(!empty($decoded['paypal_email']))
                                        <div><span class="text-slate-500 font-semibold uppercase text-[10px] tracking-wider">PayPal:</span> {{ $decoded['paypal_email'] }}</div>
                                    @else
                                        <div><span class="text-slate-500 font-semibold uppercase text-[10px] tracking-wider">Bank:</span> {{ $decoded['bank_name'] ?? '' }}</div>
                                        <div><span class="text-slate-500 font-semibold uppercase text-[10px] tracking-wider">Holder:</span> {{ $decoded['account_name'] ?? '' }}</div>
                                        <div><span class="text-slate-500 font-semibold uppercase text-[10px] tracking-wider">Acc/IBAN:</span> {{ $decoded['account_number'] ?? '' }}</div>
                                        @if(!empty($decoded['routing_number']))
                                            <div><span class="text-slate-500 font-semibold uppercase text-[10px] tracking-wider">Routing:</span> {{ $decoded['routing_number'] }}</div>
                                        @endif
                                        @if(!empty($decoded['bank_address']))
                                            <div><span class="text-slate-500 font-semibold uppercase text-[10px] tracking-wider">Branch:</span> {{ $decoded['bank_address'] }}</div>
                                        @endif
                                    @endif
                                </div>
                            @else
                                <div class="text-slate-400 font-mono text-xs max-w-xs truncate" title="{{ $withdrawal->destination }}">
                                    {{ $withdrawal->destination }}
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-white font-medium">${{ number_format($withdrawal->amount, 2) }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($withdrawal->status == 'pending')
                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-amber-500/10 text-amber-500">Pending</div>
                            @elseif($withdrawal->status == 'approved')
                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-emerald-500/10 text-emerald-500">Approved</div>
                            @else
                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-rose-500/10 text-rose-500">Rejected</div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-800/50 mb-4">
                                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-slate-300 mb-1">No withdrawals found</h3>
                            <p class="text-slate-500 text-sm">You haven't made any withdrawal requests yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
