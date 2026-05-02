@extends('admin.layouts.app')

@section('title', 'Settings | Admin PTA')
@section('header_title', 'Admin Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <div>
        <h1 class="text-2xl text-white font-bold tracking-tight">Account Settings</h1>
        <p class="text-gray-400 text-sm mt-1">Manage your administrative profile and security preferences.</p>
    </div>

    <!-- Profile Update -->
    <div class="glass-panel border border-dark-600 rounded-xl overflow-hidden">
        <div class="p-6 md:p-8 border-b border-dark-600">
            <h2 class="text-lg font-semibold text-white mb-6">Profile Information</h2>
            
            <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ $admin->name }}" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ $admin->email }}" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-500" required>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-brand-500 hover:bg-brand-400 text-white rounded-lg font-medium transition-colors">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Update -->
    <div class="glass-panel border border-dark-600 rounded-xl overflow-hidden">
        <div class="p-6 md:p-8 border-b border-dark-600">
            <h2 class="text-lg font-semibold text-white mb-6">Change Password</h2>
            
            <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-6">
                @csrf
                <div class="max-w-md space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" name="current_password" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 pr-10 text-white focus:outline-none focus:border-brand-500" required>
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-300">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 pr-10 text-white focus:outline-none focus:border-brand-500" required minlength="6">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-300">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 pr-10 text-white focus:outline-none focus:border-brand-500" required minlength="6">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-300">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-dark-700 hover:bg-dark-600 text-white border border-dark-600 rounded-lg font-medium transition-colors">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
