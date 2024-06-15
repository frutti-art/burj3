<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Crypto\ActivateWalletAccountInTronService;
use App\Services\Crypto\TronWalletGenerator;

class UserObserver
{
    public function creating(User $user): void
    {
        $tronWalletGenerator = app()->make(TronWalletGenerator::class);
        $res = $tronWalletGenerator->handle();

        $user->referral_code = random_int(100000, 999999);

        $user->wallet_address = $res['wallet_address'];
        $user->wallet_private_key = $res['wallet_private_key'];

        $user->email_verified_at = now();
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $activateWalletAccountInTronService = app()->make(ActivateWalletAccountInTronService::class);
        $activateWalletAccountInTronService->handle($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
