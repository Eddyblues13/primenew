<?php

namespace App\Http\Controllers;

use App\Mail\WithdrawalRequestedMail;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        ]);

        $user = Auth::user();

        if ($request->amount > $user->balance) {
            return redirect()->back()->with('error', 'Insufficient balance. You do not have enough funds for this withdrawal.');
        }

        if ($request->method === 'bank_transfer') {
            $request->validate([
                'bank_name' => 'required|string|max:255',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'routing_number' => 'required|string|max:255',
                'bank_address' => 'nullable|string|max:500',
            ]);

            $destination = json_encode([
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'routing_number' => $request->routing_number,
                'bank_address' => $request->bank_address,
            ]);
        } else {
            $request->validate([
                'destination' => 'required|string|max:255',
            ]);
            $destination = $request->destination;
        }

        // Deduct balance immediately
        $user->balance -= $request->amount;
        $user->save();

        // Create withdrawal
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'method' => $request->method,
            'destination' => $destination,
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
