<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\Withdrawal;

class DatabaseSeeder extends Seeder {
    public function run() {
        // Ensure roles exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create Admin Account
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($adminRole);

        // Create User Account
        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->roles()->attach($userRole);

        // Create 20+ Random Users with Transactions and Withdrawals
        User::factory(20)->create()->each(function ($user) use ($userRole) {
            $user->roles()->attach($userRole);

            // Create random transactions for the user
            Transaction::factory(rand(1, 5))->create([
                'user_id' => $user->id,
                'amount' => rand(100, 2000),
                'transaction_type' => ['deposit', 'pension'][rand(0, 1)],
                'status' => ['pending', 'completed', 'failed'][rand(0, 2)],
            ]);

            // Create random withdrawals for the user
            Withdrawal::factory(rand(1, 3))->create([
                'user_id' => $user->id,
                'amount' => rand(50, 1000),
                'status' => ['pending', 'approved', 'rejected'][rand(0, 2)],
            ]);
        });
    }
}
