@extends('user.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl text-slate-100 font-bold">Account Settings ✨</h1>
        <p class="text-sm text-slate-400 mt-2">Manage your profile details and security settings.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <!-- Profile Settings -->
        <div class="xl:col-span-2">
            <div class="glass-panel rounded-xl border border-slate-700/50 p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-24 h-24 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                
                <h2 class="text-xl font-bold text-slate-100 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile Information
                </h2>

                <form action="{{ route('settings.profile') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Name -->
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="name">Full Name</label>
                            <input id="name" name="name" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" value="{{ old('name', $user->name) }}" required>
                            @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="username">Username</label>
                            <input id="username" name="username" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" value="{{ old('username', $user->username) }}">
                            @error('username') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="email">Email Address <span class="text-xs text-slate-500">(Read only)</span></label>
                            <input id="email" class="w-full bg-slate-900/50 border border-slate-700/50 rounded-lg px-4 py-3 text-slate-400 cursor-not-allowed" type="email" value="{{ $user->email }}" disabled>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="phone">Phone Number</label>
                            <input id="phone" name="phone" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" value="{{ old('phone', $user->phone) }}">
                            @error('phone') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Country -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="country">Country</label>
                            <input id="country" name="country" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" type="text" value="{{ old('country', $user->country) }}">
                            @error('country') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2.5 px-6 rounded-lg transition-colors shadow-lg shadow-blue-500/20">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="xl:col-span-1">
            <div class="glass-panel rounded-xl border border-slate-700/50 p-6">
                <h2 class="text-xl font-bold text-slate-100 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Security
                </h2>

                <form action="{{ route('settings.password') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        
                        <!-- Current Password -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="current_password">Current Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <input id="current_password" name="current_password" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 pr-10 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" :type="show ? 'text' : 'password'" required>
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-200">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                            @error('current_password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="password">New Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <input id="password" name="password" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 pr-10 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" :type="show ? 'text' : 'password'" required>
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-200">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                            @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2" for="password_confirmation">Confirm Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <input id="password_confirmation" name="password_confirmation" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 pr-10 text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" :type="show ? 'text' : 'password'" required>
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-200">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-2.5 px-6 rounded-lg transition-colors shadow-lg shadow-indigo-500/20 w-full md:w-auto">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Information Box -->
            <div class="mt-6 bg-slate-800/30 border border-slate-700/50 rounded-xl p-5 flex items-start">
                <svg class="w-5 h-5 text-amber-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-sm text-slate-400">
                    <p class="mb-2">For your security, please use a strong password containing a mix of letters, numbers, and symbols.</p>
                    <p>If you suspect unauthorized access, change your password immediately.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
