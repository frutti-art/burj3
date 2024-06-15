<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => User::ADMIN_EMAIL,
            'password' => Hash::make('admin'),
            'is_admin' => true,
            'wallet_address' => '0x',
            'referral_code' => '912491248',
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'is_admin' => false,
            'wallet_address' => '0x123123',
            'referral_code' => '82359172895412',
            'email_verified_at' => now(),
            'can_finish_task'   => true,
            'can_withdraw'  => true,
        ]);

        Level::factory()->create([
            'name' => 'Level 1',
            'rank' => 1,
            'upgrade_cost' => '100',
            'daily_return_amount' => '30',
            'claim_limit' => '4',
            'required_referrals_count' => 3,
        ]);

        Level::factory()->create([
            'name' => 'Level 2',
            'rank' => 2,
            'upgrade_cost' => '300',
            'daily_return_amount' => '100',
            'claim_limit' => '4',
            'required_referrals_count' => 3,
        ]);

        Setting::create([
            'key' => Setting::REFERRAL_BONUS_PERCENTAGE,
            'value' => '10',
        ]);

        Setting::create([
            'key' => Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT,
            'value' => '50',
        ]);

        Setting::create([
            'key' => Setting::CLIENT_APP_IS_LIVE,
            'value' => true,
        ]);
    }
}
