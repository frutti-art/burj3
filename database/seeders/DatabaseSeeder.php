<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => User::ADMIN_EMAIL,
            'password' => Hash::make('admin'),
            'is_admin' => true,
            'wallet_address' => '0x',
            'email_verified_at' => now(),
        ]);

        $this->createSettings();
        Artisan::call('app:translations-sync-command');

        if (app()->environment('production')) {
            return;
        }

        $this->createLevels();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'is_admin' => false,
            'wallet_address' => '0x123123',
            'email_verified_at' => now(),
            'can_finish_task'   => true,
            'can_withdraw'  => true,
        ]);
    }

    private function createLevels()
    {
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
    }

    private function createSettings()
    {
        Setting::create([
            'key' => Setting::REFERRAL_BONUS_PERCENTAGE,
            'value' => 10,
        ]);

        Setting::create([
            'key' => Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT,
            'value' => 50,
        ]);

        Setting::create([
            'key' => Setting::CLIENT_APP_IS_LIVE,
            'value' => true,
        ]);

        Setting::create([
            'key' => Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS,
            'value' => 3,
        ]);
    }
}
