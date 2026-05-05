@extends('admin.layouts.app')

@section('title', 'KYC Applications')
@section('header_title', 'KYC Applications')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-xl font-bold text-white">KYC Applications</h2>
        <p class="text-sm text-gray-400">Manage user identity verification requests</p>
    </div>
</div>

<div class="glass-panel rounded-xl border border-dark-600 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark-800 border-b border-dark-600 text-xs uppercase tracking-wider text-gray-400">
                    <th class="px-6 py-4 font-medium">User</th>
                    <th class="px-6 py-4 font-medium">Document Type</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium">Submitted</th>
                    <th class="px-6 py-4 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-600">
                @forelse($kycs as $kyc)
                <tr class="hover:bg-dark-800/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-500/20 text-primary-500 flex items-center justify-center font-bold text-sm">
                                {{ substr($kyc->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-white font-medium">{{ $kyc->user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $kyc->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-gray-300 capitalize">{{ str_replace('_', ' ', $kyc->document_type) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($kyc->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/20">
                                Pending
                            </span>
                        @elseif($kyc->status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-500 border border-green-500/20">
                                Approved
                            </span>
                        @elseif($kyc->status === 'rejected')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-500 border border-red-500/20">
                                Rejected
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-400">
                        {{ $kyc->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.kyc.show', $kyc) }}" class="text-primary-400 hover:text-primary-300 font-medium text-sm transition-colors">
                            Review
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                        No KYC applications found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($kycs->hasPages())
    <div class="px-6 py-4 border-t border-dark-600 bg-dark-800/50">
        {{ $kycs->links() }}
    </div>
    @endif
</div>
@endsection
