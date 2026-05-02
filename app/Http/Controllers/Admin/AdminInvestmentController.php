<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;

class AdminInvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with('user')->latest()->paginate(20);
        return view('admin.investments.index', compact('investments'));
    }
}
