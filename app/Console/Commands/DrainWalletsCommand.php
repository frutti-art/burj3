<?php

namespace App\Console\Commands;

use App\Jobs\TransferTrxToAllWalletAddressesJob;
use Illuminate\Console\Command;

class DrainWalletsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:drain-wallets-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('Started DrainWalletsCommand');

        TransferTrxToAllWalletAddressesJob::dispatch();

        \Log::info('Ended TransferTrxToAllWalletAddressesJob');
    }
}
