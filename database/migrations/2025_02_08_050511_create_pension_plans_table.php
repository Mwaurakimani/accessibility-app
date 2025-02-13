<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pension_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('monthly_contribution', 10, 2);
            $table->decimal('payout_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pension_plans');
    }
};
