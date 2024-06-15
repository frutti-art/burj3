<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26);
            $table->bigInteger('transactionable_id')->nullable();
            $table->string('transactionable_type')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->decimal('amount')->nullable();
            $table->string('type'); // deposit, withdrawal
            $table->string('status'); // pending, completed, failed
            $table->string('reference'); // withdrawal, level_up, referral_bonus, daily_return
            $table->string('wallet_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
