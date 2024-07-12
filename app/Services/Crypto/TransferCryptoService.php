<?php

namespace App\Services\Crypto;

use App\Exceptions\TransferCryptoException;
use App\Models\Transaction;
use Symfony\Component\Process\Process;

class TransferCryptoService
{
    public function handle(string $wallet_private_key, string $to_wallet_address, float $transfer_amount = null, string $transfer_type = Transaction::TOKEN_USDT, bool $transferMaxAmount = false): void
    {
        $process = new Process(['node', base_path('/node_crypto/transfer_usdt.js')]);

        if (!$transfer_amount && !$transferMaxAmount) {
            throw new \Exception('Transfer amount is required.');
        }

        if ($transfer_amount && $transfer_amount <= 0) {
            throw new \Exception('Invalid transfer amount.');
        }

        if (!in_array(strtoupper($transfer_type), Transaction::getTokensAvailable())) {
            throw new \Exception('Invalid transfer type.');
        }

        $process->setEnv([
            'TRON_PRIVATE_KEY' => $wallet_private_key,
            'RECIPIENT_WALLET_ADDRESS' => $to_wallet_address,
            'TRANSFER_AMOUNT' => $transfer_amount,
            'TRANSFER_TYPE' => strtoupper($transfer_type),
            'TRON_PRO_API_KEY' => env('TRON_PRO_API_KEY'),
            'TRON_HOST' => env('TRON_HOST'),
            'USDT_CONTRACT_ADDRESS' => env('USDT_CONTRACT_ADDRESS'),
            'TRANSFER_MAX_AMOUNT' => $transferMaxAmount ? 'true' : 'false',
        ]);

        $process->start();

        $process->wait(function ($type, $output) use($transfer_amount, $transfer_type, $to_wallet_address) {
            if (Process::ERR === $type) {
                \Log::info($transfer_amount . ' ' . $transfer_type . ' transfer failed. To: ' . $to_wallet_address);
                throw new TransferCryptoException($output);
            }

            \Log::info($transfer_amount . ' ' . $transfer_type . ' transfer successfully done. To: ' . $to_wallet_address);
        });
    }
}
