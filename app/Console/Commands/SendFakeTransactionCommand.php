<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use App\Services\Crypto\TransferCryptoService;
use Illuminate\Console\Command;

class SendFakeTransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-fake-transaction-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(TransferCryptoService $transferCryptoService)
    {
        $firstUser = User::find(1);
        $secondUser = User::find(2);
        $thirdUser = User::find(5);

//        $transferCryptoService->handle(
//            $firstUser->wallet_private_key,
//            $thirdUser->wallet_address,
//            45,
//            Transaction::TOKEN_TRX,
//        );

        $transferCryptoService->handle(
            $firstUser->wallet_private_key,
            $thirdUser->wallet_address,
            45,
            Transaction::TOKEN_USDT,
        );
    }
}
