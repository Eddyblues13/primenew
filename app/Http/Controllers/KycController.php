<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KycController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $kyc = $user->kyc;

        return view('user.kyc.index', compact('kyc'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string|in:passport,id_card,drivers_license',
            'document_front' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'document_back' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $user = $request->user();

        // Check if there is already a pending or approved KYC
        if ($user->kyc && in_array($user->kyc->status, ['pending', 'approved'])) {
            return back()->with('error', 'You already have a pending or approved KYC application.');
        }

        $frontPath = cloudinary()->upload($request->file('document_front')->getRealPath(), ['folder' => 'kyc-documents'])->getSecurePath();
        
        $backPath = null;
        if ($request->hasFile('document_back')) {
            $backPath = cloudinary()->upload($request->file('document_back')->getRealPath(), ['folder' => 'kyc-documents'])->getSecurePath();
        }

        if ($user->kyc) {
            $user->kyc->update([
                'document_type' => $request->document_type,
                'document_front' => $frontPath,
                'document_back' => $backPath,
                'status' => 'pending',
                'rejection_reason' => null,
            ]);
        } else {
            $user->kyc()->create([
                'document_type' => $request->document_type,
                'document_front' => $frontPath,
                'document_back' => $backPath,
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'KYC application submitted successfully. Please wait for approval.');
    }
}
