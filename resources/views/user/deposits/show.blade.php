@extends('user.layouts.app')

@section('title', 'Deposit via ' . $method->name . ' | Prime Trade Access')
@section('header_title', 'Deposit via ' . $method->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('deposits.index') }}" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-white">Deposit via {{ $method->name }}</h2>
            <p class="text-gray-400 text-sm">Follow the instructions below to complete your deposit.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Payment Details Column -->
        <div class="glass-panel p-6 rounded-2xl border border-dark-600 h-full">
            <h3 class="text-lg font-bold text-white mb-4 border-b border-dark-600 pb-2">Payment Details</h3>
            
            @if($method->type == 'crypto')
                <div class="flex flex-col items-center mb-6">
                    <div class="bg-white p-2 rounded-xl mb-4">
                        <img src="{{ $method->qr_code_url }}" alt="QR Code" class="w-32 h-32">
                    </div>
                    <p class="text-xs text-gray-400 text-center">Scan this QR code or copy the address below to send {{ $method->currency_code }}.</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-gray-400 mb-1">Wallet Address</label>
                    <div class="flex">
                        <input type="text" id="wallet-address" value="{{ $method->wallet_address }}" readonly class="w-full bg-dark-700 border border-dark-600 rounded-l-xl px-4 py-2.5 text-white focus:outline-none text-sm font-mono">
                        <button onclick="copyAddress()" class="bg-brand-500 hover:bg-brand-400 text-white px-4 py-2.5 rounded-r-xl transition-colors font-medium text-sm flex items-center gap-2" id="copy-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            Copy
                        </button>
                    </div>
                </div>
                
                <div class="bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 p-3 rounded-xl text-xs">
                    <span class="font-bold">Warning:</span> Only send {{ $method->currency_code }} to this address. Sending any other asset will result in permanent loss.
                </div>
            @else
                <div class="mb-4">
                    <label class="block text-sm text-gray-400 mb-1">Bank Information</label>
                    <div class="bg-dark-700 border border-dark-600 rounded-xl p-4 text-white text-sm font-mono whitespace-pre-wrap">{{ $method->bank_details }}</div>
                </div>
                <div class="bg-brand-500/10 border border-brand-500/20 text-brand-400 p-3 rounded-xl text-xs">
                    <span class="font-bold">Instructions:</span> Please include your username ({{ auth()->user()->username }}) in the transfer reference.
                </div>
            @endif
        </div>

        <!-- Submission Form Column -->
        <div class="glass-panel p-6 rounded-2xl border border-dark-600">
            <h3 class="text-lg font-bold text-white mb-4 border-b border-dark-600 pb-2">Submit Proof of Payment</h3>
            
            <form action="{{ route('deposits.store', $method->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Amount Sent (in USD value)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="amount" step="0.01" min="10" required class="w-full bg-dark-700 border border-dark-600 rounded-xl pl-8 pr-4 py-2.5 text-white focus:outline-none focus:border-brand-500 transition-colors" placeholder="0.00">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Upload Receipt / Screenshot</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dark-600 border-dashed rounded-xl hover:border-brand-500 transition-colors relative bg-dark-700 group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400 group-hover:text-brand-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-400 justify-center">
                                <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-brand-400 hover:text-brand-300 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input id="file-upload" name="proof" type="file" class="sr-only" required accept="image/*,.pdf" onchange="updateFileName(this)">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500" id="file-name">PNG, JPG, PDF up to 5MB</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-brand-500 hover:bg-brand-400 text-white py-3 rounded-xl font-bold transition-colors shadow-[0_0_15px_rgba(160,113,255,0.3)] hover:shadow-[0_0_20px_rgba(160,113,255,0.5)]">
                    Submit Deposit Request
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyAddress() {
        var copyText = document.getElementById("wallet-address");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(copyText.value);
        
        var btn = document.getElementById("copy-btn");
        var originalText = btn.innerHTML;
        btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Copied!';
        btn.classList.replace('bg-brand-500', 'bg-green-500');
        btn.classList.replace('hover:bg-brand-400', 'hover:bg-green-400');
        
        setTimeout(function() {
            btn.innerHTML = originalText;
            btn.classList.replace('bg-green-500', 'bg-brand-500');
            btn.classList.replace('hover:bg-green-400', 'hover:bg-brand-400');
        }, 2000);
    }

    function updateFileName(input) {
        var fileName = input.files[0].name;
        document.getElementById('file-name').textContent = 'Selected: ' + fileName;
    }
</script>
@endpush
@endsection
