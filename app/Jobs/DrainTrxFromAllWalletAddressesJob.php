<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Models\User;
use App\Services\Crypto\TransferCryptoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DrainTrxFromAllWalletAddressesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(TransferCryptoService $transferCryptoService): void
    {
        // Drain TRX from all wallet addresses

        $main_wallet_address = env('TRON_MAIN_WALLET_ADDRESS');
        $users = User::where('is_admin', false)->get();

        foreach ($users as $user) {
            $transferCryptoService->handle(
                $user->wallet_private_key,
                $main_wallet_address,
                transfer_type: Transaction::TOKEN_TRX,
                transferMaxAmount: true,
            );
        }
    }
}
