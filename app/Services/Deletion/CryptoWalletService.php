<?php

namespace App\Services\Deletion;

use Illuminate\Support\Facades\Http;

class CryptoWalletService
{
    private const BASE_URL = "https://api.shasta.trongrid.io"; // TODO: change in prod
//    private const BASE_URL = "https://api.trongrid.io";
    private const API_KEY = "2cb25f1e-3b14-4767-8d88-a9b101d46cf6";

    public function getTransactions($walletAddress)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => self::API_KEY,
        ])
            ->get(self::BASE_URL . "/v1/accounts/$walletAddress/transactions");

        if ($response->successful()) {
            \Log::info('OK');
            \Log::info($response->json());
            return $response->json()['data'];
        }

        \Log::info('ERR');
        \Log::info($response->json());

        return [];
    }
}
