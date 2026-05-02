<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function tesla()
    {
        $plans = InvestmentPlan::where('type', 'tesla')->get();
        return view('user.investments.tesla', compact('plans'));
    }

    public function crypto()
    {
        $plans = InvestmentPlan::where('type', 'crypto')->get();
        return view('user.investments.crypto', compact('plans'));
    }

    public function history()
    {
        $investments = auth()->user()->investments()->with('plan')->orderBy('created_at', 'desc')->get();
        return view('user.investments.history', compact('investments'));
    }

    public function store(Request $request, InvestmentPlan $plan)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:' . $plan->min_amount, 'max:' . $plan->max_amount],
        ]);

        $user = auth()->user();

        if ($user->balance < $request->amount) {
            return redirect()->route('deposits.index')->with('error', 'Insufficient balance. Please deposit funds first.');
        }

        // Deduct balance
        $user->balance -= $request->amount;
        $user->save();

        // Create investment
        $investment = Investment::create([
            'user_id' => $user->id,
            'investment_plan_id' => $plan->id,
            'amount' => $request->amount,
            'status' => 'active',
        ]);

        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\InvestmentSuccessMail($investment));

        return back()->with('success', 'Successfully invested $' . number_format($request->amount, 2) . ' in ' . $plan->name);
    }
}
