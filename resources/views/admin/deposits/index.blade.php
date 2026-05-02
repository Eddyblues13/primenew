@extends('admin.layouts.app')

@section('title', 'Manage Deposits | Admin PTA')
@section('header_title', 'Manage Deposits')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-100 font-bold">Deposits</h1>
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
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Method</div></th>
                        <th class="px-4 py-4 whitespace-nowrap"><div class="font-semibold text-left">Date</div></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-700/50">
                    @foreach($deposits as $deposit)
                    <tr class="hover:bg-slate-800/20">
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-slate-300">{{ $deposit->user->name ?? 'Unknown' }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-white font-medium">${{ number_format($deposit->amount, 2) }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-slate-400">{{ strtoupper($deposit->method ?? 'unknown') }}</div></td>
                        <td class="px-4 py-4 whitespace-nowrap"><div class="text-slate-500">{{ $deposit->created_at->format('M d, Y h:i A') }}</div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $deposits->links() }}
    </div>
</div>
@endsection
