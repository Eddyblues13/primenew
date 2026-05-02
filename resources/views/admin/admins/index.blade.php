@extends('admin.layouts.app')

@section('title', 'Manage Admins | Admin PTA')
@section('header_title', 'Manage Administrators')

@section('content')
<div x-data="{ createModalOpen: false }" class="max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl text-white font-bold tracking-tight">Administrators</h1>
            <p class="text-gray-400 text-sm mt-1">Manage admin access to the platform.</p>
        </div>
        <button @click="createModalOpen = true" class="bg-brand-500 hover:bg-brand-400 text-white px-5 py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-brand-500/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Add Admin
        </button>
    </div>

    <!-- Admins List -->
    <div class="glass-panel border border-dark-600 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-dark-800">
                    <tr>
                        <th class="px-6 py-4">Admin Name</th>
                        <th class="px-6 py-4">Email Address</th>
                        <th class="px-6 py-4">Added On</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-600/50">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-dark-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-brand-500 to-blue-500 p-px shrink-0">
                                    <div class="w-full h-full rounded-full bg-dark-800 flex items-center justify-center font-bold text-white text-xs">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                </div>
                                <span class="font-medium text-white">{{ $admin->name }}</span>
                                @if($admin->id === auth('admin')->id())
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-brand-500/20 text-brand-400 ml-2">You</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-300">{{ $admin->email }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $admin->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            @if($admin->id !== auth('admin')->id())
                                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" onsubmit="return confirm('Remove this administrator?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Remove Admin">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div x-show="createModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" @click="createModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            
            <div class="inline-block align-bottom glass-panel border border-dark-600 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                <div class="px-6 py-6 border-b border-dark-600 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">Add Administrator</h3>
                    <button @click="createModalOpen = false" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                
                <form action="{{ route('admin.admins.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                            <input type="text" name="name" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                            <input type="email" name="email" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-brand-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                            <div x-data="{ show: false }" class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 pr-10 text-white focus:outline-none focus:border-brand-500" required minlength="6">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-300">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                            <div x-data="{ show: false }" class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 pr-10 text-white focus:outline-none focus:border-brand-500" required minlength="6">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-300">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-dark-600 flex justify-end gap-3 bg-dark-800/30">
                        <button type="button" @click="createModalOpen = false" class="px-4 py-2 bg-dark-700 text-white rounded-lg font-medium hover:bg-dark-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-brand-500 text-white rounded-lg font-medium hover:bg-brand-400">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
