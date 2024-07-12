<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\Crypto\TransferCryptoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeCryptoTransferOfAcceptedWithdrawTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Transaction $transaction
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(TransferCryptoService $transferCryptoService): void
    {
        $main_wallet_private_key = env('TRON_MAIN_WALLET_PRIVATE_KEY');

        $transferCryptoService->handle(
            $main_wallet_private_key,
            $this->transaction->wallet_address,
            (float) $this->transaction->amount,
            Transaction::TOKEN_USDT
        );
    }
}
