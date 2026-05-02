@extends('admin.layouts.app')

@section('title', 'Investment Plans | Admin PTA')
@section('header_title', 'Investment Plans')

@section('content')
<div x-data="{ 
        activeTab: 'tesla',
        createModalOpen: false,
        editModalOpen: false,
        editForm: { id: '', name: '', type: 'tesla', min_amount: '', max_amount: '', roi_percent: '', duration_days: '' },
        
        openEditModal(plan) {
            this.editForm = { ...plan };
            this.editModalOpen = true;
        }
    }" class="max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl text-white font-bold tracking-tight">Investment Plans</h1>
            <p class="text-gray-400 text-sm mt-1">Manage Tesla and Crypto investment plans.</p>
        </div>
        <button @click="createModalOpen = true" class="bg-brand-500 hover:bg-brand-400 text-white px-5 py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-brand-500/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Create Plan
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-2 border-b border-dark-600 pb-px">
        <button @click="activeTab = 'tesla'" :class="{ 'text-brand-400 border-brand-500': activeTab === 'tesla', 'text-gray-400 border-transparent hover:text-white': activeTab !== 'tesla' }" class="px-6 py-3 border-b-2 font-medium transition-colors">
            Tesla Plans
        </button>
        <button @click="activeTab = 'crypto'" :class="{ 'text-brand-400 border-brand-500': activeTab === 'crypto', 'text-gray-400 border-transparent hover:text-white': activeTab !== 'crypto' }" class="px-6 py-3 border-b-2 font-medium transition-colors">
            Crypto Plans
        </button>
    </div>

    <!-- Tesla Plans Tab -->
    <div x-show="activeTab === 'tesla'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($teslaPlans as $plan)
        <div class="glass-panel rounded-xl border border-dark-600 p-6 flex flex-col relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <h3 class="text-xl font-bold text-white">{{ $plan->name }}</h3>
                <span class="px-2.5 py-1 bg-blue-500/10 text-blue-400 text-xs font-semibold rounded-lg uppercase tracking-wider">{{ $plan->type }}</span>
            </div>
            
            <div class="space-y-3 mb-6 relative z-10">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Min Amount</span>
                    <span class="text-white font-medium">${{ number_format($plan->min_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Max Amount</span>
                    <span class="text-white font-medium">${{ number_format($plan->max_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">ROI</span>
                    <span class="text-green-400 font-medium">{{ $plan->roi_percent }}%</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Duration</span>
                    <span class="text-white font-medium">{{ $plan->duration_days }} Days</span>
                </div>
            </div>

            <div class="mt-auto flex gap-2 relative z-10">
                <button @click="openEditModal({{ json_encode($plan) }})" class="flex-1 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit
                </button>
                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this plan?');">
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
        
        @if($teslaPlans->isEmpty())
        <div class="col-span-full py-12 text-center border-2 border-dashed border-dark-600 rounded-xl">
            <p class="text-gray-400">No Tesla plans found. Create one to get started.</p>
        </div>
        @endif
    </div>

    <!-- Crypto Plans Tab -->
    <div x-show="activeTab === 'crypto'" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cryptoPlans as $plan)
        <div class="glass-panel rounded-xl border border-dark-600 p-6 flex flex-col relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <h3 class="text-xl font-bold text-white">{{ $plan->name }}</h3>
                <span class="px-2.5 py-1 bg-amber-500/10 text-amber-400 text-xs font-semibold rounded-lg uppercase tracking-wider">{{ $plan->type }}</span>
            </div>
            
            <div class="space-y-3 mb-6 relative z-10">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Min Amount</span>
                    <span class="text-white font-medium">${{ number_format($plan->min_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Max Amount</span>
                    <span class="text-white font-medium">${{ number_format($plan->max_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">ROI</span>
                    <span class="text-green-400 font-medium">{{ $plan->roi_percent }}%</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Duration</span>
                    <span class="text-white font-medium">{{ $plan->duration_days }} Days</span>
                </div>
            </div>

            <div class="mt-auto flex gap-2 relative z-10">
                <button @click="openEditModal({{ json_encode($plan) }})" class="flex-1 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit
                </button>
                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this plan?');">
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
        
        @if($cryptoPlans->isEmpty())
        <div class="col-span-full py-12 text-center border-2 border-dashed border-dark-600 rounded-xl">
            <p class="text-gray-400">No Crypto plans found. Create one to get started.</p>
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
                    <h3 class="text-xl font-semibold text-white">Create Investment Plan</h3>
                    <button @click="createModalOpen = false" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <form action="{{ route('admin.plans.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Plan Name</label>
                            <input type="text" name="name" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Type</label>
                            <select name="type" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                                <option value="tesla">Tesla</option>
                                <option value="crypto">Crypto</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Min Amount ($)</label>
                                <input type="number" step="0.01" name="min_amount" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Max Amount ($)</label>
                                <input type="number" step="0.01" name="max_amount" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">ROI Percent (%)</label>
                                <input type="number" step="0.01" name="roi_percent" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Duration (Days)</label>
                                <input type="number" name="duration_days" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="createModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-brand-500 text-white rounded-lg font-medium hover:bg-brand-400">Create Plan</button>
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
                    <h3 class="text-xl font-semibold text-white">Edit Investment Plan</h3>
                    <button @click="editModalOpen = false" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <form :action="`/admin/plans/${editForm.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-6 py-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Plan Name</label>
                            <input type="text" name="name" x-model="editForm.name" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Type</label>
                            <select name="type" x-model="editForm.type" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                                <option value="tesla">Tesla</option>
                                <option value="crypto">Crypto</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Min Amount ($)</label>
                                <input type="number" step="0.01" name="min_amount" x-model="editForm.min_amount" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Max Amount ($)</label>
                                <input type="number" step="0.01" name="max_amount" x-model="editForm.max_amount" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">ROI Percent (%)</label>
                                <input type="number" step="0.01" name="roi_percent" x-model="editForm.roi_percent" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Duration (Days)</label>
                                <input type="number" name="duration_days" x-model="editForm.duration_days" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                            </div>
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
