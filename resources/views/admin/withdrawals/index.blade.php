@extends('admin.layouts.app')

@section('title', 'Manage Withdrawals | Admin PTA')
@section('header_title', 'Manage Withdrawals')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-100 font-bold">Withdrawals</h1>
        </div>
    </div>

    <!-- Table -->
    <div class="glass-panel rounded-xl border border-slate-700/50 relative overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-auto w-full divide-y divide-slate-700/50">
                <thead class="text-xs uppercase text-slate-400 bg-slate-800/50">
                    <tr>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">User</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Amount</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Method & Dest</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Status</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Actions</div></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-700/50">
                    @foreach($withdrawals as $withdrawal)
                    <tr class="hover:bg-slate-800/20">
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-slate-300">{{ $withdrawal->user->name ?? 'Unknown' }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-white font-medium">${{ number_format($withdrawal->amount, 2) }}</div></td>
                        <td class="px-4 py-4">
                            <div class="text-slate-300 font-semibold text-xs mb-1">{{ strtoupper($withdrawal->method) }}</div>
                            @if(\Illuminate\Support\Str::startsWith($withdrawal->destination, '{') && ($decoded = json_decode($withdrawal->destination, true)))
                                <div class="space-y-0.5 text-[11px] text-slate-400">
                                    @if(!empty($decoded['paypal_email']))
                                        <div><span class="text-slate-600 font-medium">PayPal:</span> {{ $decoded['paypal_email'] }}</div>
                                    @else
                                        <div><span class="text-slate-600 font-medium">Bank:</span> {{ $decoded['bank_name'] ?? '' }}</div>
                                        <div><span class="text-slate-600 font-medium">Holder:</span> {{ $decoded['account_name'] ?? '' }}</div>
                                        <div><span class="text-slate-600 font-medium">Acc:</span> {{ $decoded['account_number'] ?? '' }}</div>
                                        @if(!empty($decoded['routing_number']))
                                            <div><span class="text-slate-600 font-medium">Rout/SWIFT:</span> {{ $decoded['routing_number'] }}</div>
                                        @endif
                                        @if(!empty($decoded['bank_address']))
                                            <div><span class="text-slate-600 font-medium">Branch:</span> {{ $decoded['bank_address'] }}</div>
                                        @endif
                                    @endif
                                </div>
                            @else
                                <div class="text-slate-400 text-xs font-mono select-all">{{ $withdrawal->destination }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($withdrawal->status == 'pending')
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 text-amber-500">Pending</span>
                            @elseif($withdrawal->status == 'approved')
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-500">Approved</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 text-rose-500">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($withdrawal->status == 'pending')
                                <button class="text-emerald-500 hover:text-emerald-400 mr-2">Approve</button>
                                <button class="text-rose-500 hover:text-rose-400">Reject</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $withdrawals->links() }}
    </div>
</div>
@endsection
