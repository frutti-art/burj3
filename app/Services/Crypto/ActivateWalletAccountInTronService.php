<?php

namespace App\Services\Crypto;

use App\Exceptions\TransferCryptoException;
use App\Models\Transaction;
use App\Models\User;

class ActivateWalletAccountInTronService
{
    public function __construct(
        private readonly TransferCryptoService $transferCryptoService,
    )
    {

    }
    public function handle(User $user): void
    {
        $main_wallet_private_key = env('TRON_MAIN_WALLET_PRIVATE_KEY');

        try {
            $this->transferCryptoService->handle($main_wallet_private_key, $user->wallet_address, 1, Transaction::TOKEN_TRX);

            $user->update([
                'wallet_activated' => true
            ]);
        } catch (TransferCryptoException $e) {
            \Log::info($e->getMessage());
            \Log::info('Failed to activate wallet account in Tron. User_id: ' . $user->id);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            \Log::info('Error while activating wallet for user id ' . $user->id);
        }
    }
}
