<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();

        if (!$user->isAdmin) {
            abort(403, 'Unauthorized');
        }

        $users = User::all();

        return Inertia::render('Admin/UserManagement', compact('users', 'user'));
    }
}
