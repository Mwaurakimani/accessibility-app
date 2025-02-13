<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WithdrawalController extends Controller
{
    public function index() {
        $user = Auth::user();

        // Admins see all withdrawals, users see only their own
        $withdrawals = $user->isAdmin
            ? Withdrawal::with('user')->latest()->paginate(10)
            : Withdrawal::where('user_id', $user->id)->latest()->paginate(10);

        return Inertia::render('Dashboard/Withdraw', [
            'withdrawals' => $withdrawals,
            'user' => $user,
        ]);
    }

    public function store(Request $request) {
        $user = Auth::user();

        // Users request a withdrawal (default status: pending)
        $request->validate([
            'amount' => 'required|numeric|min:10',
        ]);

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return back()->with('message', 'Withdrawal request submitted successfully.');
    }

    public function update(Request $request, $id) {
        $user = Auth::user();

        if (!$user->isAdmin) {
            return back()->withErrors(['error' => 'Unauthorized action']);
        }

        // Validate input
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Find withdrawal request
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->update([
            'amount' => $request->amount,
            'status' => $request->status,
        ]);

        return back()->with('message', 'Withdrawal updated successfully.');
    }
}
