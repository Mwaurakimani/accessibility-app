<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HelpController extends Controller
{
    public function index() {
        $user = Auth::user();

        $tickets = $user->isAdmin ? SupportTicket::all() : SupportTicket::where('user_id', $user->id)->get();

        return Inertia::render('Dashboard/Help', compact('tickets', 'user'));
    }
}
