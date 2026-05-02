@extends('admin.layouts.app')

@section('title', 'Manage Investments | Admin PTA')
@section('header_title', 'Manage Investments')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-100 font-bold">Investments</h1>
        </div>
    </div>

    <!-- Table -->
    <div class="glass-panel rounded-xl border border-slate-700/50 relative overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-auto w-full divide-y divide-slate-700/50">
                <thead class="text-xs uppercase text-slate-400 bg-slate-800/50">
                    <tr>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">User</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Plan</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Amount</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Status</div></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-700/50">
                    @foreach($investments as $investment)
                    <tr class="hover:bg-slate-800/20">
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-slate-300">{{ $investment->user->name ?? 'Unknown' }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-slate-400">{{ $investment->plan->name ?? 'Unknown' }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-white font-medium">${{ number_format($investment->amount, 2) }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($investment->status == 'active')
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-500">Active</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-500/10 text-slate-500">{{ ucfirst($investment->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $investments->links() }}
    </div>
</div>
@endsection
