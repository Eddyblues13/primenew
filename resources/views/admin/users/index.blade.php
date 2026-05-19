@extends('admin.layouts.app')

@section('title', 'Manage Users | Admin PTA')
@section('header_title', 'Manage Users')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl text-white font-bold tracking-tight">Users</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $users->total() }} registered {{ Str::plural('user', $users->total()) }}</p>
        </div>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="relative">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, username, phone, or country..." class="w-full bg-dark-800 border border-dark-600 rounded-xl pl-12 pr-28 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors text-sm">
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 gap-1">
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="px-3 py-1.5 text-xs text-gray-400 hover:text-white transition-colors rounded-lg hover:bg-dark-700">Clear</a>
                @endif
                <button type="submit" class="px-4 py-1.5 bg-brand-500 hover:bg-brand-400 text-white text-sm font-medium rounded-lg transition-colors">Search</button>
            </div>
        </div>
    </form>

    @if(request('search'))
        <div class="flex items-center gap-2 text-sm text-gray-400">
            <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Showing results for "<span class="text-white font-medium">{{ request('search') }}</span>"
        </div>
    @endif

    <!-- Desktop Table View (hidden on mobile) -->
    <div class="hidden md:block glass-panel rounded-xl border border-dark-600 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-dark-600 bg-dark-800/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Country</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Balance</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-600/50">
                    @forelse($users as $user)
                    <tr class="hover:bg-dark-700/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-brand-500 to-blue-500 p-0.5 shrink-0">
                                    <div class="w-full h-full rounded-full bg-dark-800 flex items-center justify-center text-sm font-bold text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <p class="text-white font-medium text-sm">{{ $user->name }}</p>
                                    <p class="text-gray-500 text-xs">{{ '@' . $user->username }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-gray-300 text-sm">{{ $user->email }}</p>
                            <p class="text-gray-500 text-xs">{{ $user->phone ?? '—' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-300 text-sm">{{ $user->country ?? '—' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-white font-semibold text-sm">${{ number_format($user->balance, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-gray-400 text-sm">{{ $user->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-600 text-xs">{{ $user->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="p-2 text-gray-400 hover:text-brand-400 hover:bg-brand-500/10 rounded-lg transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Delete User">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-dark-700 mb-4">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-300 mb-1">No users found</h3>
                            <p class="text-gray-500 text-sm">
                                @if(request('search'))
                                    No users match "{{ request('search') }}". Try a different search.
                                @else
                                    No users have registered yet.
                                @endif
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View (hidden on desktop) -->
    <div class="md:hidden space-y-3">
        @forelse($users as $user)
        <div class="glass-panel rounded-xl border border-dark-600 p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-gradient-to-r from-brand-500 to-blue-500 p-0.5 shrink-0">
                        <div class="w-full h-full rounded-full bg-dark-800 flex items-center justify-center text-sm font-bold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">{{ $user->name }}</p>
                        <p class="text-gray-500 text-xs">{{ '@' . $user->username }}</p>
                    </div>
                </div>
                <span class="text-white font-bold text-sm bg-dark-700 px-3 py-1 rounded-lg">${{ number_format($user->balance, 2) }}</span>
            </div>

            <div class="grid grid-cols-2 gap-3 text-xs border-t border-dark-600 pt-3">
                <div>
                    <p class="text-gray-500 mb-0.5">Email</p>
                    <p class="text-gray-300 truncate">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-gray-500 mb-0.5">Phone</p>
                    <p class="text-gray-300">{{ $user->phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 mb-0.5">Country</p>
                    <p class="text-gray-300">{{ $user->country ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 mb-0.5">Joined</p>
                    <p class="text-gray-300">{{ $user->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-dark-600">
                <a href="{{ route('admin.users.show', $user) }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-brand-500 hover:bg-brand-400 text-white rounded-lg transition-colors text-sm font-bold shadow-lg shadow-brand-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    View User
                </a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg transition-colors text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="glass-panel rounded-xl border border-dark-600 p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-dark-700 mb-4">
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h3 class="text-lg font-medium text-gray-300 mb-1">No users found</h3>
            <p class="text-gray-500 text-sm">
                @if(request('search'))
                    No users match "{{ request('search') }}".
                @else
                    No users have registered yet.
                @endif
            </p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="glass-panel rounded-xl border border-dark-600 px-4 py-3">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-sm text-gray-400">
                Showing <span class="text-white font-medium">{{ $users->firstItem() }}</span> to <span class="text-white font-medium">{{ $users->lastItem() }}</span> of <span class="text-white font-medium">{{ $users->total() }}</span>
            </p>
            <div class="flex items-center gap-1">
                {{-- Previous --}}
                @if($users->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-600 rounded-lg cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-dark-700 rounded-lg transition-colors">Previous</a>
                @endif

                {{-- Page Numbers --}}
                @foreach($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                    @if($page == $users->currentPage())
                        <span class="px-3.5 py-2 text-sm text-white bg-brand-500 rounded-lg font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3.5 py-2 text-sm text-gray-400 hover:text-white hover:bg-dark-700 rounded-lg transition-colors">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-dark-700 rounded-lg transition-colors">Next</a>
                @else
                    <span class="px-3 py-2 text-sm text-gray-600 rounded-lg cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
