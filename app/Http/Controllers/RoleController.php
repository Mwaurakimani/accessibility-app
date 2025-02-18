<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {
    public function index() {
        return response()->json(Role::all());
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|unique:roles']);
        Role::create(['name' => $request->name]);
        return response()->json(['message' => 'Role created successfully']);
    }
}
