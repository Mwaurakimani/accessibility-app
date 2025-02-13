<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;

class TransactionFactory extends Factory {
    protected $model = Transaction::class;

    public function definition() {
        return [
            'user_id' => null, // Will be set dynamically in seeder
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'transaction_type' => $this->faker->randomElement(['deposit', 'pension']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}
