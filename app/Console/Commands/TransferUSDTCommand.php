<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class TransferUSDTCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transfer-usdt-command';

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
        $process = new Process(['node', base_path('/node_crypto/transfer_usdt.js')]);
        $process->setEnv([
            'TRON_PRIVATE_KEY' => env('TRON_PRIVATE_KEY'),
            'TRON_WALLET_ADDRESS' => env('TRON_WALLET_ADDRESS'),
            'RECIPIENT_WALLET_ADDRESS' => env('RECIPIENT_WALLET_ADDRESS'),
        ]);

        $process->start();

        $this->info('USDT transfer script started.');

        $process->wait(function ($type, $output) {
            if (Process::ERR === $type) {
                $this->error($output);
            } else {
                $this->info($output);
            }
        });
    }
}
