@extends('user.layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Identity Verification (KYC)</h1>
        <p class="text-gray-400">Complete your KYC to access all features.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-500 bg-opacity-10 border border-green-500 text-green-400 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 bg-opacity-10 border border-red-500 text-red-400 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 bg-opacity-10 border border-red-500 text-red-400 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel p-6 max-w-3xl">
        @if (!$kyc || $kyc->status === 'rejected')
            @if ($kyc && $kyc->status === 'rejected')
                <div class="bg-red-500 bg-opacity-10 border border-red-500 text-red-400 px-4 py-3 rounded mb-6">
                    <h3 class="font-bold text-white mb-1">Your previous application was rejected.</h3>
                    <p>Reason: {{ $kyc->rejection_reason ?? 'No specific reason provided.' }}</p>
                    <p class="mt-2 text-sm text-gray-300">Please submit your documents again ensuring they meet the requirements.</p>
                </div>
            @endif

            <form action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Document Type</label>
                    <select name="document_type" required class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary-500">
                        <option value="id_card">National ID Card</option>
                        <option value="passport">Passport</option>
                        <option value="drivers_license">Driver's License</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Front of Document</label>
                        <div class="border-2 border-dashed border-dark-600 rounded-lg p-6 text-center hover:border-primary-500 transition-colors relative cursor-pointer" onclick="document.getElementById('document_front').click()">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-400">Click to upload image</span>
                            <input type="file" id="document_front" name="document_front" class="hidden" accept="image/jpeg,image/png,image/jpg" required onchange="updateFileName(this, 'front-name')">
                            <p id="front-name" class="text-xs text-primary-400 mt-2 truncate"></p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Back of Document (Optional for Passports)</label>
                        <div class="border-2 border-dashed border-dark-600 rounded-lg p-6 text-center hover:border-primary-500 transition-colors relative cursor-pointer" onclick="document.getElementById('document_back').click()">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-400">Click to upload image</span>
                            <input type="file" id="document_back" name="document_back" class="hidden" accept="image/jpeg,image/png,image/jpg" onchange="updateFileName(this, 'back-name')">
                            <p id="back-name" class="text-xs text-primary-400 mt-2 truncate"></p>
                        </div>
                    </div>
                </div>

                <div class="mb-6 text-sm text-gray-400">
                    <p>Requirements:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        <li>Image must be clear and readable.</li>
                        <li>All four corners of the document must be visible.</li>
                        <li>Format: JPG, JPEG, or PNG. Max size: 5MB.</li>
                    </ul>
                </div>

                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-500 text-white font-medium py-2.5 px-4 rounded-lg transition-colors">
                    Submit Application
                </button>
            </form>
        @else
            <div class="text-center py-8">
                @if ($kyc->status === 'pending')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-500 bg-opacity-20 text-yellow-500 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">Application Pending</h2>
                    <p class="text-gray-400">Your KYC application is currently being reviewed by our team. This process usually takes 24-48 hours. We will notify you once the review is complete.</p>
                @elseif ($kyc->status === 'approved')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-500 bg-opacity-20 text-green-500 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">Identity Verified</h2>
                    <p class="text-gray-400">Your identity has been successfully verified. You have full access to all features on the platform.</p>
                @endif
            </div>
        @endif
    </div>

    <script>
        function updateFileName(input, elementId) {
            if (input.files && input.files[0]) {
                document.getElementById(elementId).textContent = input.files[0].name;
            }
        }
    </script>
@endsection
