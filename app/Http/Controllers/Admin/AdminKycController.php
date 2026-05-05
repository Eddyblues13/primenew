<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use Illuminate\Http\Request;

class AdminKycController extends Controller
{
    public function index()
    {
        $kycs = Kyc::with('user')->latest()->paginate(20);
        return view('admin.kyc.index', compact('kycs'));
    }

    public function show(Kyc $kyc)
    {
        $kyc->load('user');
        return view('admin.kyc.show', compact('kyc'));
    }

    public function approve(Kyc $kyc)
    {
        $kyc->update([
            'status' => 'approved',
            'rejection_reason' => null
        ]);

        return back()->with('success', 'KYC application approved successfully.');
    }

    public function reject(Request $request, Kyc $kyc)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $kyc->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'KYC application rejected.');
    }
}
