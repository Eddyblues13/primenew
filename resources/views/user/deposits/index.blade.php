@extends('user.layouts.app')

@section('title', 'Select Deposit Method | Prime Trade Access')
@section('header_title', 'Deposit Funds')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-2">Select Deposit Method</h2>
        <p class="text-gray-400">Choose how you want to fund your account. We support both fiat and crypto deposits.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($methods as $method)
            <a href="{{ route('deposits.show', $method->id) }}" class="glass-panel p-6 rounded-2xl border border-dark-600 hover:border-brand-500 transition-colors group cursor-pointer block">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $method->type == 'crypto' ? 'bg-orange-500/20 text-orange-400 border-orange-500/30' : 'bg-blue-500/20 text-blue-400 border-blue-500/30' }} border">
                        @if($method->type == 'crypto')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white group-hover:text-brand-400 transition-colors">{{ $method->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $method->currency_code }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500">
                    Deposit funds using {{ $method->name }}. Instant processing upon network confirmation.
                </p>
                <div class="mt-4 flex justify-end">
                    <span class="text-brand-400 text-sm font-medium flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                        Select <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
