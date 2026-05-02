<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalRequestedMail;

class WithdrawalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return view('user.withdrawals.index', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'method' => 'required|string',
            'destination' => 'required|string',
        ]);

        $user = Auth::user();

        if ($request->amount > $user->balance) {
            return redirect()->back()->with('error', 'Insufficient balance. You do not have enough funds for this withdrawal.');
        }

        // Deduct balance immediately
        $user->balance -= $request->amount;
        $user->save();

        // Create withdrawal
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'method' => $request->method,
            'destination' => $request->destination,
            'status' => 'pending',
        ]);

        // Send Email
        Mail::to($user->email)->send(new WithdrawalRequestedMail($withdrawal, $user));

        return redirect()->route('withdrawals.history')->with('success', 'Withdrawal request submitted successfully.');
    }

    public function history()
    {
        $withdrawals = Withdrawal::where('user_id', Auth::id())
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('user.withdrawals.history', compact('withdrawals'));
    }
}
