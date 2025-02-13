<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Withdrawal;

class WithdrawalFactory extends Factory {
    protected $model = Withdrawal::class;

    public function definition() {
        return [
            'user_id' => null, // Will be set dynamically in seeder
            'amount' => $this->faker->randomFloat(2, 50, 3000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
