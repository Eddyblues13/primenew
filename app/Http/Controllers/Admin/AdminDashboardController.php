<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Investment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        
        $stats = [
            'total_users' => User::count(),
            'total_deposits' => Deposit::sum('amount'),
            'pending_withdrawals' => Withdrawal::where('status', 'pending')->count(),
            'active_investments' => Investment::where('status', 'active')->count(),
        ];

        return view('admin.dashboard', compact('admin', 'stats'));
    }
}
