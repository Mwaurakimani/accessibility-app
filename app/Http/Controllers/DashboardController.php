<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        // Get total balance (sum of deposits - sum of withdrawals)
        $totalDeposits = Transaction::where('user_id', $user->id)->where('transaction_type', 'deposit')->sum('amount');
        $totalWithdrawals = Withdrawal::where('user_id', $user->id)->sum('amount');
        $balance = $totalDeposits - $totalWithdrawals;

        // Get the last transaction
        $lastTransaction = Transaction::where('user_id', $user->id)->latest()->first();

        // Get the next payout (latest deposit)
        $nextPayout = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'deposit')
            ->latest()
            ->value('amount');

        return Inertia::render('Dashboard/Overview', [
            'user' => $user,
            'balance' => $balance,
            'lastTransaction' => $lastTransaction ? $lastTransaction->amount : 0,
            'nextPayout' => $nextPayout ?? 0
        ]);
    }
}
