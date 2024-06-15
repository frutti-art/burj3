<?php

namespace App\Services\Deletion;

use Illuminate\Support\Facades\Http;

class CreateTronAccountService
{
    private const BASE_URL = "https://api.shasta.trongrid.io";
    private const API_KEY = "YOUR_API_KEY";

    public function handle(string $ownerAddress, string $wallet_address) {
        $url = self::BASE_URL . '/wallet/createaccount';
        $response = Http::withHeaders([
            'TRON-PRO-API-KEY' => self::API_KEY,
            'Content-Type' => 'application/json'
        ])->post($url, [
            'owner_address' => $ownerAddress,
            'account_address' => $wallet_address,
            'visible' => true,
        ]);

        if ($response->failed()) {
            throw new \Exception('Request failed: ' . $response->body());
        }

        \Log::info('Res: ' . $response->body());

        return $response->json();
    }
}
