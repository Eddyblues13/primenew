<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
use Illuminate\Http\Request;

class AdminPlanController extends Controller
{
    public function index()
    {
        $teslaPlans = InvestmentPlan::where('type', 'tesla')->get();
        $cryptoPlans = InvestmentPlan::where('type', 'crypto')->get();
        return view('admin.plans.index', compact('teslaPlans', 'cryptoPlans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tesla,crypto',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|gt:min_amount',
            'roi_percent' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        InvestmentPlan::create($request->only(['name', 'type', 'min_amount', 'max_amount', 'roi_percent', 'duration_days']));

        return redirect()->route('admin.plans.index')->with('success', 'Investment plan created successfully.');
    }

    public function update(Request $request, InvestmentPlan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tesla,crypto',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|gt:min_amount',
            'roi_percent' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        $plan->update($request->only(['name', 'type', 'min_amount', 'max_amount', 'roi_percent', 'duration_days']));

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(InvestmentPlan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
