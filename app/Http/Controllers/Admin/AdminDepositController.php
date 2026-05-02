<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->paginate(20);
        return view('admin.deposits.index', compact('deposits'));
    }
}
