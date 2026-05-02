<?php

namespace App\Http\Controllers;

use App\Models\DepositMethod;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        $methods = DepositMethod::where('is_active', true)->get();
        return view('user.deposits.index', compact('methods'));
    }

    public function show(DepositMethod $method)
    {
        return view('user.deposits.show', compact('method'));
    }

    public function store(Request $request, DepositMethod $method)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB max
        ]);

        $path = $request->file('proof')->store('deposits', 'public');

        Deposit::create([
            'user_id' => auth()->id(),
            'deposit_method_id' => $method->id,
            'amount' => $request->amount,
            'proof_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Deposit submitted successfully. It is currently pending admin approval.');
    }
}
