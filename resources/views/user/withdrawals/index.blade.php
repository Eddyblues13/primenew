@extends('user.layouts.app')

@section('title', 'Request Withdrawal')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl text-slate-100 font-bold">Request Withdrawal 💸</h1>
        <p class="text-sm text-slate-400 mt-2">Withdraw your funds safely and securely.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <!-- Withdrawal Form -->
        <div class="xl:col-span-2">
            <div class="glass-panel rounded-xl border border-slate-700/50 p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-24 h-24 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                
                <h2 class="text-xl font-bold text-slate-100 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Withdrawal Details
                </h2>

                <form action="{{ route('withdrawals.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        
                        <!-- Amount -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-medium text-slate-300" for="amount">Amount (USD)</label>
                                <span class="text-xs text-slate-400">Available: <span class="text-blue-400 font-semibold cursor-pointer" onclick="fillMaxBalance()">$</span><span class="text-blue-400 font-semibold cursor-pointer" id="available-balance-span" onclick="fillMaxBalance()">{{ number_format($user->balance, 2, '.', '') }}</span></span>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-medium">$</span>
                                </div>
                                <input id="amount" name="amount" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg pl-8 pr-20 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="number" step="0.01" min="10" placeholder="0.00" required>
                                <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                                    <button type="button" onclick="fillMaxBalance()" class="bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 text-xs font-semibold py-1 px-2.5 rounded transition-colors border border-blue-500/30">
                                        MAX
                                    </button>
                                </div>
                            </div>
                            @error('amount') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Method -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="method">Withdrawal Method</label>
                            <select id="method" name="method" onchange="toggleWithdrawalMethod(this.value)" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" required>
                                <option value="" disabled selected>Select a payment method...</option>
                                <option value="bitcoin">Bitcoin (BTC)</option>
                                <option value="ethereum">Ethereum (ETH)</option>
                                <option value="usdt_trc20">USDT (TRC20)</option>
                                <option value="bank_transfer">Direct Bank Wire Transfer</option>
                                <option value="paypal">PayPal</option>
                            </select>
                            @error('method') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Crypto Fields -->
                        <div id="crypto-fields" class="hidden space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2" id="destination-label" for="destination">Wallet Address</label>
                                <input id="destination" name="destination" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" placeholder="Enter your crypto wallet address">
                                <p class="text-xs text-slate-500 mt-2 flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Please verify your wallet address carefully. Transactions are irreversible once processed.
                                </p>
                                @error('destination') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Bank Transfer Fields -->
                        <div id="bank-fields" class="hidden space-y-4 bg-slate-800/20 p-5 rounded-xl border border-slate-700/50">
                            <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Wire Transfer Details</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1" for="bank_name">Bank Name</label>
                                    <input id="bank_name" name="bank_name" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" placeholder="e.g. JPMorgan Chase Bank">
                                    @error('bank_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1" for="account_name">Account Holder Name</label>
                                    <input id="account_name" name="account_name" value="{{ $user->name }}" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" placeholder="Full name on account">
                                    @error('account_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1" for="account_number">Account Number / IBAN</label>
                                    <input id="account_number" name="account_number" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" placeholder="Account Number or IBAN">
                                    @error('account_number') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1" for="routing_number">Routing Number / SWIFT/BIC (Optional)</label>
                                    <input id="routing_number" name="routing_number" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" placeholder="Routing or SWIFT Code">
                                    @error('routing_number') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="mt-2">
                                <label class="block text-xs font-semibold text-slate-400 uppercase mb-1" for="bank_address">Bank Branch Address (Optional)</label>
                                <textarea id="bank_address" name="bank_address" rows="2" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-none" placeholder="Enter bank address or branch details"></textarea>
                                @error('bank_address') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- PayPal Fields -->
                        <div id="paypal-fields" class="hidden space-y-4 bg-slate-800/20 p-5 rounded-xl border border-slate-700/50">
                            <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">PayPal Details</h3>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase mb-1" for="paypal_email">PayPal Email Address</label>
                                <input id="paypal_email" name="paypal_email" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="email" placeholder="e.g. youremail@example.com">
                                <p class="text-xs text-slate-500 mt-2 flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Please ensure this is the email linked to your verified PayPal account.
                                </p>
                                @error('paypal_email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2.5 px-6 rounded-lg transition-colors shadow-lg shadow-blue-500/20">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Summary -->
        <div class="xl:col-span-1">
            <div class="glass-panel rounded-xl border border-slate-700/50 p-6">
                <h2 class="text-xl font-bold text-slate-100 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Summary
                </h2>

                <div class="space-y-4">
                    <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700/50">
                        <p class="text-sm text-slate-400 mb-1">Total Balance</p>
                        <p class="text-2xl font-bold text-white">${{ number_format($user->balance, 2) }}</p>
                    </div>
                </div>

                <div class="mt-6 text-sm text-slate-400 space-y-2">
                    <p class="flex items-start">
                        <svg class="w-4 h-4 text-amber-500 mr-2 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        All withdrawals are subject to administrative approval.
                    </p>
                    <p class="flex items-start">
                        <svg class="w-4 h-4 text-blue-500 mr-2 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        The requested amount will be temporarily deducted from your balance until approved or rejected.
                    </p>
                </div>
                
                <div class="mt-6 pt-6 border-t border-slate-700/50">
                    <a href="{{ route('withdrawals.history') }}" class="text-blue-500 hover:text-blue-400 text-sm font-medium transition-colors flex items-center justify-center">
                        View Withdrawal History
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function fillMaxBalance() {
        const balance = document.getElementById('available-balance-span').innerText;
        document.getElementById('amount').value = balance;
    }

    function toggleWithdrawalMethod(method) {
        const cryptoFields = document.getElementById('crypto-fields');
        const bankFields = document.getElementById('bank-fields');
        const paypalFields = document.getElementById('paypal-fields');
        const destinationInput = document.getElementById('destination');
        const destinationLabel = document.getElementById('destination-label');
        
        const bankNameInput = document.getElementById('bank_name');
        const accountNameInput = document.getElementById('account_name');
        const accountNumberInput = document.getElementById('account_number');
        const paypalEmailInput = document.getElementById('paypal_email');

        // Reset requirements and hide all
        destinationInput.required = false;
        bankNameInput.required = false;
        accountNameInput.required = false;
        accountNumberInput.required = false;
        paypalEmailInput.required = false;

        cryptoFields.classList.add('hidden');
        bankFields.classList.add('hidden');
        paypalFields.classList.add('hidden');

        if (method === 'bank_transfer') {
            bankFields.classList.remove('hidden');
            bankNameInput.required = true;
            accountNameInput.required = true;
            accountNumberInput.required = true;
        } else if (method === 'paypal') {
            paypalFields.classList.remove('hidden');
            paypalEmailInput.required = true;
        } else {
            cryptoFields.classList.remove('hidden');
            destinationInput.required = true;
            
            if (method === 'bitcoin') {
                destinationLabel.innerText = 'Bitcoin (BTC) Wallet Address';
                destinationInput.placeholder = 'e.g. 1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
            } else if (method === 'ethereum') {
                destinationLabel.innerText = 'Ethereum (ETH) Wallet Address';
                destinationInput.placeholder = 'e.g. 0x71C7656EC7ab88b098defB751B7401B5f6d8976F';
            } else if (method === 'usdt_trc20') {
                destinationLabel.innerText = 'USDT (TRC20) Wallet Address';
                destinationInput.placeholder = 'e.g. TXxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
            } else {
                destinationLabel.innerText = 'Wallet Address';
                destinationInput.placeholder = 'Enter your wallet address';
            }
        }
    }
    
    // Automatically trigger on page load if validation errors occurred
    document.addEventListener('DOMContentLoaded', function() {
        const methodSelect = document.getElementById('method');
        if (methodSelect.value) {
            toggleWithdrawalMethod(methodSelect.value);
        }
    });
</script>
@endsection
