<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();

        // Admins see all transactions, users see only their own transactions
        $transactions = $user->isAdmin
            ? Transaction::with('user')->latest()->paginate(10)
            : Transaction::where('user_id', $user->id)->latest()->paginate(10);

        return Inertia::render('Dashboard/Transactions', [
            'transactions' => $transactions,
            'user' => $user,
        ]);
    }

    public function store(Request $request) {
        $user = Auth::user();

        // If user is not an admin, store the transaction request as pending
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'transaction_type' => 'required|in:deposit,pension',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type,
            'status' => 'pending',
        ]);

        return back()->with('message', 'Transaction request submitted successfully.');
    }

    public function update(Request $request, $id) {
        $user = Auth::user();

        if (!$user->isAdmin) {
            return back()->withErrors(['error' => 'Unauthorized action']);
        }

        // Validate input
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'transaction_type' => 'required|in:deposit,pension',
            'status' => 'required|in:pending,completed,rejected',
        ]);

        // Find transaction
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type,
            'status' => $request->status,
        ]);

        return back()->with('message', 'Transaction updated successfully.');
    }
}
