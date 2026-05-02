<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        return view('admin.settings', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($request->only(['name', 'email']));

        return redirect()->route('admin.settings')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = auth('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $admin->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.settings')->with('success', 'Password updated successfully.');
    }

    public function sendMailForm()
    {
        $users = User::all();
        return view('admin.sendmail', compact('users'));
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'recipients' => 'required|in:all,selected',
            'user_ids' => 'required_if:recipients,selected|array',
            'user_ids.*' => 'exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($request->recipients === 'all') {
            $users = User::all();
        } else {
            $users = User::whereIn('id', $request->user_ids ?? [])->get();
        }

        $sent = 0;
        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(
                    new \App\Mail\AdminCustomMail($request->subject, $request->message, $user)
                );
                $sent++;
            } catch (\Exception $e) {
                continue;
            }
        }

        return redirect()->back()->with('success', "Email sent successfully to {$sent} user(s).");
    }
}
