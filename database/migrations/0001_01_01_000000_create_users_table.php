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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('level_id')->nullable()->references('id')->on('levels');
            $table->boolean('is_admin')->default(false);
            $table->string('email')->unique();
            $table->string('password');
            $table->decimal('balance')->default(0);
            $table->boolean('can_finish_task')->default(true);
            $table->boolean('can_withdraw')->default(true);
            $table->string('wallet_address');
            $table->string('wallet_private_key');
            $table->string('referral_code');
            $table->foreignId('referred_by')->nullable()->references('id')->on('users');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('level_upgraded_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
