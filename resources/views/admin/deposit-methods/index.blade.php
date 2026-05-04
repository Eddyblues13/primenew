@extends('admin.layouts.app')

@section('title', 'Deposit Details | Admin PTA')
@section('header_title', 'Deposit Details')

@section('content')
<div x-data="{
        createModalOpen: false,
        editModalOpen: false,
        editForm: { id: '', name: '', currency_code: '', type: 'crypto', wallet_address: '', bank_details: '', qr_code_url: '', is_active: true },

        openEditModal(method) {
            this.editForm = {
                id: method.id,
                name: method.name,
                currency_code: method.currency_code,
                type: method.type,
                wallet_address: method.wallet_address || '',
                bank_details: method.bank_details || '',
                qr_code_url: method.qr_code_url || '',
                is_active: method.is_active ? true : false,
            };
            this.editModalOpen = true;
        }
    }" class="max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl text-white font-bold tracking-tight">Deposit Details</h1>
            <p class="text-gray-400 text-sm mt-1">Manage deposit methods, wallet addresses, and bank details shown to users.</p>
        </div>
        <button @click="createModalOpen = true" class="bg-brand-500 hover:bg-brand-400 text-white px-5 py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-brand-500/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Add Method
        </button>
    </div>

    <!-- Methods Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($methods as $method)
        <div class="glass-panel rounded-xl border border-dark-600 p-6 flex flex-col relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br {{ $method->type === 'crypto' ? 'from-orange-500/5' : 'from-blue-500/5' }} to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $method->type === 'crypto' ? 'bg-orange-500/20 text-orange-400 border-orange-500/30' : 'bg-blue-500/20 text-blue-400 border-blue-500/30' }} border">
                        @if($method->type === 'crypto')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">{{ $method->name }}</h3>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $method->currency_code }}</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg uppercase tracking-wider {{ $method->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                    {{ $method->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <div class="space-y-3 mb-6 relative z-10 flex-1">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Type</span>
                    <span class="text-white font-medium capitalize">{{ $method->type }}</span>
                </div>
                @if($method->wallet_address)
                <div class="text-sm">
                    <span class="text-gray-400 block mb-1">Wallet Address</span>
                    <span class="text-white font-mono text-xs bg-dark-700 px-3 py-2 rounded-lg block break-all">{{ $method->wallet_address }}</span>
                </div>
                @endif
                @if($method->bank_details)
                <div class="text-sm">
                    <span class="text-gray-400 block mb-1">Bank Details</span>
                    <span class="text-white text-xs bg-dark-700 px-3 py-2 rounded-lg block break-all">{{ $method->bank_details }}</span>
                </div>
                @endif
                @if($method->qr_code_url)
                <div class="text-sm">
                    <span class="text-gray-400 block mb-1">QR Code URL</span>
                    <span class="text-white font-mono text-xs bg-dark-700 px-3 py-2 rounded-lg block truncate">{{ $method->qr_code_url }}</span>
                </div>
                @endif
            </div>

            <div class="mt-auto flex gap-2 relative z-10">
                <button @click="openEditModal({{ json_encode($method) }})" class="flex-1 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit
                </button>
                <form action="{{ route('admin.deposit-methods.destroy', $method) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this deposit method?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg transition-colors text-sm font-medium flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach

        @if($methods->isEmpty())
        <div class="col-span-full py-12 text-center border-2 border-dashed border-dark-600 rounded-xl">
            <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-gray-400">No deposit methods found. Add one to get started.</p>
        </div>
        @endif
    </div>

    <!-- Create Modal -->
    <div x-show="createModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" @click="createModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="px-6 py-6 border-b border-dark-600 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">Add Deposit Method</h3>
                    <button @click="createModalOpen = false" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <form action="{{ route('admin.deposit-methods.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-4 max-h-[60vh] overflow-y-auto">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Method Name</label>
                                <input type="text" name="name" placeholder="e.g. Bitcoin" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Currency Code</label>
                                <input type="text" name="currency_code" placeholder="e.g. BTC" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Type</label>
                                <select name="type" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                                    <option value="crypto">Crypto</option>
                                    <option value="fiat">Fiat</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                                <select name="is_active" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Wallet Address</label>
                            <input type="text" name="wallet_address" placeholder="Crypto wallet address (leave blank for fiat)" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Bank Details</label>
                            <textarea name="bank_details" rows="3" placeholder="Bank name, account number, routing, etc. (leave blank for crypto)" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">QR Code URL</label>
                            <input type="text" name="qr_code_url" placeholder="https://example.com/qr.png" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500">
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="createModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-brand-500 text-white rounded-lg font-medium hover:bg-brand-400">Create Method</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="editModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" @click="editModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="px-6 py-6 border-b border-dark-600 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">Edit Deposit Method</h3>
                    <button @click="editModalOpen = false" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <form :action="`/admin/deposit-methods/${editForm.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-6 py-6 space-y-4 max-h-[60vh] overflow-y-auto">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Method Name</label>
                                <input type="text" name="name" x-model="editForm.name" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Currency Code</label>
                                <input type="text" name="currency_code" x-model="editForm.currency_code" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Type</label>
                                <select name="type" x-model="editForm.type" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                                    <option value="crypto">Crypto</option>
                                    <option value="fiat">Fiat</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                                <select name="is_active" x-model="editForm.is_active" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500">
                                    <option :value="true">Active</option>
                                    <option :value="false">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Wallet Address</label>
                            <input type="text" name="wallet_address" x-model="editForm.wallet_address" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Bank Details</label>
                            <textarea name="bank_details" rows="3" x-model="editForm.bank_details" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">QR Code URL</label>
                            <input type="text" name="qr_code_url" x-model="editForm.qr_code_url" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500">
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="editModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-brand-500 text-white rounded-lg font-medium hover:bg-brand-400">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
