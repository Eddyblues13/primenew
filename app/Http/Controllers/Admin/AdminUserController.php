<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminCustomMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['deposits', 'withdrawals', 'investments']);

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function updateBalance(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:add,subtract',
        ]);

        if ($request->type === 'add') {
            $user->balance += $request->amount;
            $message = 'Successfully added $'.number_format($request->amount, 2)." to user's balance.";
        } else {
            if ($user->balance < $request->amount) {
                return redirect()->back()->with('error', 'Cannot subtract more than the user\'s current balance.');
            }
            $user->balance -= $request->amount;
            $message = 'Successfully subtracted $'.number_format($request->amount, 2)." from user's balance.";
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    public function updateProfit(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:add,subtract',
        ]);

        $user->profits()->create([
            'amount' => $request->amount,
            'type' => $request->type,
        ]);

        if ($request->type === 'add') {
            $user->balance += $request->amount;
            $message = 'Successfully added $'.number_format($request->amount, 2).' profit to user.';
        } else {
            if ($user->balance < $request->amount) {
                return redirect()->back()->with('error', 'Cannot subtract more than the user\'s current balance.');
            }
            $user->balance -= $request->amount;
            $message = 'Successfully subtracted $'.number_format($request->amount, 2).' profit from user.';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    public function loginAs(User $user)
    {
        auth()->guard('web')->login($user);

        return redirect()->route('dashboard')->with('success', 'You are now logged in as '.$user->name);
    }

    public function sendMail(Request $request, User $user)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::to($user->email)->send(
                new AdminCustomMail($request->subject, $request->message, $user)
            );

            return redirect()->back()->with('success', 'Email sent successfully to '.$user->email);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send email: '.$e->getMessage());
        }
    }

    public function updateBonus(Request $request, User $user)
    {
        $request->validate([
            'signup_bonus' => 'required|numeric|min:0',
            'affiliate_bonus' => 'required|numeric|min:0',
        ]);

        $user->signup_bonus = $request->signup_bonus;
        $user->affiliate_bonus = $request->affiliate_bonus;
        $user->save();

        return redirect()->back()->with('success', 'Bonuses updated successfully.');
    }
}
