<?php

namespace App\Services\Deletion;

use Elliptic\EC;
use Illuminate\Support\Facades\Http;
use kornrunner\Keccak;

class AccountPermissionService
{
    private const BASE_URL = "https://api.shasta.trongrid.io";
    private const API_KEY = "YOUR_API_KEY";

    public function updateAccountPermissions($ownerAddress, $privateKey)
    {
        try {
            \Log::info("Updating permissions for owner address: $ownerAddress");

            $permissions = $this->definePermissions($ownerAddress);
            $transaction = $this->createPermissionUpdateTransaction($ownerAddress, $permissions);
            $signedTransaction = $this->signTransaction($transaction, $privateKey);

            return $this->broadcastTransaction($signedTransaction);
        } catch (\Exception $e) {
            \Log::error('Error updating account permissions: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    private function definePermissions($ownerAddress)
    {
//        $ownerAddressHex = $this->customEncode($ownerAddress);
//        $keyAddress = 'TGf2tsFNzpNTbVJjwL6s4vgWbYFsJ16Fks';
//
//        \Log::info("Owner Address Hex: $ownerAddressHex");
//        \Log::info("Key Address: $keyAddress");

//        if (strlen($ownerAddressHex) !== 42) {
//            throw new \Exception("Invalid owner address length: $ownerAddressHex");
//        }

        return [
            'owner' => [
                'type' => 0,
                'permission_name' => 'owner',
                'threshold' => 1,
                'keys' => [
                    ['address' => $ownerAddress, 'weight' => 1],
                ],
            ],
            'actives' => [
                [
                    'type' => 2,
                    'permission_name' => 'active0',
                    'threshold' => 1,
                    'operations' => '7fff1fc0037e0000000000000000000000000000000000000000000000000000',
                    'keys' => [
                        ['address' => $ownerAddress, 'weight' => 1],
                    ],
                ],
            ],
        ];
    }

    private function createPermissionUpdateTransaction($ownerAddress, $permissions)
    {
//        $ownerAddressHex = $this->customEncode($ownerAddress);
//        $ownerAddressHex = 'TGf2tsFNzpNTbVJjwL6s4vgWbYFsJ16Fks';
//
//        \Log::info("Creating permission update transaction for owner address: $ownerAddressHex");

        $params = [
            'owner_address' => $ownerAddress,
            'owner' => $permissions['owner'],
            'actives' => $permissions['actives'],
            'visible' => true,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => self::API_KEY,
        ])->post(self::BASE_URL . "/wallet/accountpermissionupdate", $params);

        \Log::info('Permission update response:', $response->json());

        if (isset($response->json()['transaction'])) {
            return $response->json()['transaction'];
        } else {
            throw new \Exception('Invalid permission update response: ' . json_encode($response->json()));
        }
    }

    private function signTransaction($transaction, $privateKey)
    {
        $ec = new EC('secp256k1');
        $key = $ec->keyFromPrivate($privateKey);
        $transactionHash = Keccak::hash(hex2bin($transaction['txID']), 256);
        $signature = $key->sign($transactionHash, ['canonical' => true]);

        $r = str_pad($signature->r->toString(16), 64, '0', STR_PAD_LEFT);
        $s = str_pad($signature->s->toString(16), 64, '0', STR_PAD_LEFT);
        $v = dechex($signature->recoveryParam + 27);

        $transaction['signature'] = [$r . $s . $v];
        return $transaction;
    }

    private function broadcastTransaction($signedTransaction)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => self::API_KEY,
        ])->post(self::BASE_URL . "/wallet/broadcasttransaction", $signedTransaction);

        \Log::info('Broadcast response:', $response->json());

        return $response->json();
    }

    private function base58ToHex($address)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $base = strlen($alphabet);
        $num = gmp_init(0, 10);

        for ($i = 0; $i < strlen($address); $i++) {
            $char = $address[$i];
            $pos = strpos($alphabet, $char);
            if ($pos === false) {
                throw new \Exception('Invalid base58 character found: ' . $char);
            }
            $num = gmp_add(gmp_mul($num, $base), $pos);
        }

        $hex = gmp_strval($num, 16);
        if (strlen($hex) % 2 !== 0) {
            $hex = '0' . $hex;
        }

        while (substr($address, 0, 1) === '1') {
            $hex = '00' . $hex;
            $address = substr($address, 1);
        }

        \Log::info("Converted Base58 address to Hex: $hex");

        return $hex;
    }

    private function customEncode(string $address)
    {
        $toAddress = substr($address, 2); // Remove '41' prefix
        $toAddressEncoded = str_pad($toAddress, 64, '0', STR_PAD_LEFT);

        return $toAddressEncoded;
    }
}






