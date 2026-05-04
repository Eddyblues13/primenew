<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepositMethod;
use Illuminate\Http\Request;

class AdminDepositMethodController extends Controller
{
    public function index()
    {
        $methods = DepositMethod::latest()->get();

        return view('admin.deposit-methods.index', compact('methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency_code' => 'required|string|max:20',
            'type' => 'required|in:crypto,fiat',
            'wallet_address' => 'nullable|string|max:500',
            'bank_details' => 'nullable|string|max:1000',
            'qr_code_url' => 'nullable|string|max:500',
            'is_active' => 'sometimes|boolean',
        ]);

        DepositMethod::create([
            ...$request->only(['name', 'currency_code', 'type', 'wallet_address', 'bank_details', 'qr_code_url']),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.deposit-methods.index')->with('success', 'Deposit method created successfully.');
    }

    public function update(Request $request, DepositMethod $depositMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency_code' => 'required|string|max:20',
            'type' => 'required|in:crypto,fiat',
            'wallet_address' => 'nullable|string|max:500',
            'bank_details' => 'nullable|string|max:1000',
            'qr_code_url' => 'nullable|string|max:500',
            'is_active' => 'sometimes|boolean',
        ]);

        $depositMethod->update([
            ...$request->only(['name', 'currency_code', 'type', 'wallet_address', 'bank_details', 'qr_code_url']),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.deposit-methods.index')->with('success', 'Deposit method updated successfully.');
    }

    public function destroy(DepositMethod $depositMethod)
    {
        $depositMethod->delete();

        return redirect()->route('admin.deposit-methods.index')->with('success', 'Deposit method deleted successfully.');
    }
}
