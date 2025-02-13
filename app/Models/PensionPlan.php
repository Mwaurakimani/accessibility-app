<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionPlan extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'monthly_contribution', 'payout_amount'];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
