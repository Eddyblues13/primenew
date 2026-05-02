@extends('admin.layouts.app')

@section('title', 'Send Email Broadcast | Admin PTA')
@section('header_title', 'Send Mail')

@section('content')
<div x-data="{ recipientType: 'all' }" class="max-w-4xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl text-white font-bold tracking-tight">Send Broadcast Email</h1>
        <p class="text-gray-400 text-sm mt-1">Send a custom email to all users or select specific individuals.</p>
    </div>

    <form action="{{ route('admin.sendmail.send') }}" method="POST" class="glass-panel border border-dark-600 rounded-xl overflow-hidden">
        @csrf
        <div class="p-6 md:p-8 space-y-6 border-b border-dark-600">
            
            <!-- Recipient Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">Who should receive this email?</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="recipients" value="all" x-model="recipientType" class="peer sr-only">
                        <div class="rounded-xl border border-dark-600 p-4 hover:bg-dark-700 peer-checked:bg-brand-500/10 peer-checked:border-brand-500 transition-all flex gap-3">
                            <div class="mt-0.5 w-4 h-4 rounded-full border border-gray-500 peer-checked:border-brand-500 peer-checked:border-[4px]"></div>
                            <div>
                                <p class="text-white font-medium mb-1">All Users</p>
                                <p class="text-xs text-gray-400">Send to every registered user ({{ $users->count() }} users)</p>
                            </div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="recipients" value="selected" x-model="recipientType" class="peer sr-only">
                        <div class="rounded-xl border border-dark-600 p-4 hover:bg-dark-700 peer-checked:bg-blue-500/10 peer-checked:border-blue-500 transition-all flex gap-3">
                            <div class="mt-0.5 w-4 h-4 rounded-full border border-gray-500 peer-checked:border-blue-500 peer-checked:border-[4px]"></div>
                            <div>
                                <p class="text-white font-medium mb-1">Selected Users</p>
                                <p class="text-xs text-gray-400">Choose specific users from a list</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Specific Users Dropdown -->
            <div x-show="recipientType === 'selected'" x-collapse style="display: none;">
                <label class="block text-sm font-medium text-gray-300 mb-2">Select Users (Hold Ctrl/Cmd to select multiple)</label>
                <select name="user_ids[]" multiple class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-blue-500 h-40 hide-scrollbar" :required="recipientType === 'selected'">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" class="py-1">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Message Content -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Subject</label>
                <input type="text" name="subject" placeholder="e.g., Important Platform Update" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Message Content</label>
                <textarea name="message" rows="8" placeholder="Type your message here..." class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-500 resize-y" required></textarea>
                <p class="text-xs text-gray-500 mt-2">The message will be automatically wrapped in the platform's branded email template and greeted with the user's name.</p>
            </div>
            
        </div>

        <div class="px-6 md:px-8 py-5 bg-dark-800/30 flex justify-end gap-4">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 text-gray-400 hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-brand-500 hover:bg-brand-400 text-white rounded-lg font-medium transition-colors shadow-lg shadow-brand-500/20 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                Send Broadcast
            </button>
        </div>
    </form>

</div>
@endsection
