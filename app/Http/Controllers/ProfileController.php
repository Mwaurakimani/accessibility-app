<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() {
        return Inertia::render('Dashboard/Profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request) {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('message', 'Profile updated successfully!');
    }
}
