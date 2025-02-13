<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index() {
        $user = Auth::user();

        if (!$user->isAdmin) {
            abort(403, 'Unauthorized');
        }

        return Inertia::render('Admin/Dashboard', compact('user'));
    }
}
