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

class TransferTrxToAllWalletAddressesJob implements ShouldQueue
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
        \Log::info('Started TransferTrxToAllWalletAddressesJob');

        $main_wallet_private_key = env('TRON_MAIN_WALLET_PRIVATE_KEY');
        $users = User::where('is_admin', false)->get();

        foreach ($users as $user) {
            

            $transferCryptoService->handle(
                $main_wallet_private_key,
                $user->wallet_address,
                30,
                Transaction::TOKEN_TRX
            );
        }

        $envPauseDuration = (int) (env('DRAIN_WALLETS_COMMAND_PAUSE_MINS') ?? 15);
        $delayMinutes = app()->isLocal() ? 1 : $envPauseDuration;

        DrainUsdtFromAllWalletAddressesJob::dispatch()->onQueue('default')
            ->delay(now()->addMinutes($delayMinutes));

        \Log::info('Finished TransferTrxToAllWalletAddressesJob');
    }
}
