<?php

namespace App\Services\Crypto;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GetWalletTransactionsService
{
    public function handle(string $wallet_address, int $minTimestamp): Collection
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => env('TRON_PRO_API_KEY'),
        ])->get(env('TRON_HOST') . "/v1/accounts/$wallet_address/transactions/trc20", [
            'only_confirmed' => 'true',
            'only_to' => 'true',
            'min_timestamp' => $minTimestamp,
        ]);

        if ($response->failed()) {
            throw new \Exception("Fetching transactions for wallet address $wallet_address failed: " . $response->body());
        }

        $transactions = collect($response->json()['data']);

        $transactions->filter(function ($transaction) {
            return $transaction['token_info']['symbol'] === Transaction::TOKEN_USDT;
        });

        return $transactions;
    }
}
