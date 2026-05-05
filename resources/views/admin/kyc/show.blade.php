@extends('admin.layouts.app')

@section('title', 'Review KYC Application')
@section('header_title', 'Review KYC Application')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-xl font-bold text-white">Review Application: {{ $kyc->user->name }}</h2>
        <p class="text-sm text-gray-400">Submitted on {{ $kyc->created_at->format('M d, Y H:i') }}</p>
    </div>
    <a href="{{ route('admin.kyc.index') }}" class="px-4 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-lg transition-colors text-sm font-medium">
        Back to List
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- User Details & Actions -->
    <div class="lg:col-span-1 space-y-6">
        <div class="glass-panel rounded-xl border border-dark-600 p-6">
            <h3 class="text-lg font-bold text-white mb-4">User Information</h3>
            <div class="space-y-4">
                <div>
                    <div class="text-sm text-gray-400">Name</div>
                    <div class="font-medium text-white">{{ $kyc->user->name }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Email</div>
                    <div class="font-medium text-white">{{ $kyc->user->email }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Document Type</div>
                    <div class="font-medium text-white capitalize">{{ str_replace('_', ' ', $kyc->document_type) }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Current Status</div>
                    <div class="mt-1">
                        @if($kyc->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/20">Pending</span>
                        @elseif($kyc->status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-500 border border-green-500/20">Approved</span>
                        @elseif($kyc->status === 'rejected')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-500 border border-red-500/20">Rejected</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($kyc->status === 'pending')
            <div class="glass-panel rounded-xl border border-dark-600 p-6">
                <h3 class="text-lg font-bold text-white mb-4">Actions</h3>
                
                <form action="{{ route('admin.kyc.approve', $kyc) }}" method="POST" class="mb-4">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-medium py-2 px-4 rounded-lg transition-colors flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Approve Application
                    </button>
                </form>

                <div class="border-t border-dark-600 my-4 pt-4">
                    <form action="{{ route('admin.kyc.reject', $kyc) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm text-gray-400 mb-2">Rejection Reason (Required)</label>
                            <textarea name="rejection_reason" required rows="3" class="w-full bg-dark-800 border border-dark-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-red-500" placeholder="e.g. Image is blurry, Document is expired..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-red-600/20 hover:bg-red-600/30 text-red-500 border border-red-600/50 font-medium py-2 px-4 rounded-lg transition-colors flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Reject Application
                        </button>
                    </form>
                </div>
            </div>
        @elseif($kyc->status === 'rejected')
            <div class="glass-panel rounded-xl border border-red-500/30 bg-red-500/5 p-6">
                <h3 class="text-lg font-bold text-red-400 mb-2">Rejection Reason</h3>
                <p class="text-gray-300 text-sm">{{ $kyc->rejection_reason }}</p>
            </div>
        @endif
    </div>

    <!-- Documents -->
    <div class="lg:col-span-2 space-y-6">
        <div class="glass-panel rounded-xl border border-dark-600 p-6">
            <h3 class="text-lg font-bold text-white mb-4">Document: Front</h3>
            <div class="bg-dark-800 rounded-lg border border-dark-600 overflow-hidden flex justify-center items-center min-h-[300px]">
                <a href="{{ filter_var($kyc->document_front, FILTER_VALIDATE_URL) ? $kyc->document_front : Storage::url($kyc->document_front) }}" target="_blank" class="block">
                    <img src="{{ filter_var($kyc->document_front, FILTER_VALIDATE_URL) ? $kyc->document_front : Storage::url($kyc->document_front) }}" alt="Document Front" class="max-w-full max-h-[600px] object-contain hover:opacity-90 transition-opacity">
                </a>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-center">Click image to open in full size</p>
        </div>

        @if($kyc->document_back)
        <div class="glass-panel rounded-xl border border-dark-600 p-6">
            <h3 class="text-lg font-bold text-white mb-4">Document: Back</h3>
            <div class="bg-dark-800 rounded-lg border border-dark-600 overflow-hidden flex justify-center items-center min-h-[300px]">
                <a href="{{ filter_var($kyc->document_back, FILTER_VALIDATE_URL) ? $kyc->document_back : Storage::url($kyc->document_back) }}" target="_blank" class="block">
                    <img src="{{ filter_var($kyc->document_back, FILTER_VALIDATE_URL) ? $kyc->document_back : Storage::url($kyc->document_back) }}" alt="Document Back" class="max-w-full max-h-[600px] object-contain hover:opacity-90 transition-opacity">
                </a>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-center">Click image to open in full size</p>
        </div>
        @endif
    </div>
</div>
@endsection
