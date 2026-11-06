<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Display profile page
    public function index()
    {
        return view('profile');
    }

    // Display password change form
    public function editPassword()
    {
        return view('profile.password');
    }

    // Update user password
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return redirect()->route('profile.password')
            ->with('success', 'Password changed successfully!');
    }
}
