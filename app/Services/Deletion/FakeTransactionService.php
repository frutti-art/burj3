<?php

namespace App\Services\Deletion;

use Elliptic\EC;
use Illuminate\Support\Facades\Http;
use kornrunner\Keccak;

class FakeTransactionService
{
    private const BASE_URL = "https://api.shasta.trongrid.io";
    private const API_KEY = "2cb25f1e-3b14-4767-8d88-a9b101d46cf6";

    public function createFakeTransaction($fromAddress, $privateKey, $toAddress, $amount)
    {
        $tokenAddress = "TG3XXyExBkPp9nzdajDZsozEu4BkaSJozs"; // USDT contract address on Shasta testnet

        try {
            // Log the derived address from the private key for verification
            $derivedAddress = $this->privateKeyToAddress($privateKey);
            \Log::info("Derived address from private key: $derivedAddress");

            if ($derivedAddress !== $fromAddress) {
                throw new \Exception("Private key does not match the from address.");
            }

//            $this->checkPermissions($fromAddress);

            \Log::info("Creating transaction from $fromAddress to $toAddress for $amount tokens.");
            $transaction = $this->createTransaction($fromAddress, $toAddress, $tokenAddress, $amount);
            \Log::info('Transaction created:', $transaction);

            $signedTransaction = $this->signTransaction($transaction, $privateKey);
//            \Log::info('Signed transaction:', [$signedTransaction]);

            return $this->sendRawTransaction($signedTransaction);
        } catch (\Exception $e) {
            \Log::error('Error creating fake transaction: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    protected function createTransaction($fromAddress, $toAddress, $contractAddress, $amount)
    {
        $params = [
            'owner_address' => $fromAddress,
            'contract_address' => $contractAddress,
            'function_selector' => 'transfer(address,uint256)',
            'parameter' => $this->encodeTransferParams($toAddress, $amount),
            'fee_limit' => 1000000000,
            'call_value' => 0,
            'visible' => true,
        ];

        \Log::info('Sending transaction request with params:', $params);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => self::API_KEY,
        ])->post(self::BASE_URL . "/wallet/triggersmartcontract", $params);

        \Log::info('Transaction response:', $response->json());

        if (isset($response->json()['transaction'])) {
            return $response->json()['transaction'];
        } else {
            throw new \Exception('Invalid transaction creation response: ' . json_encode($response->json()));
        }
    }

    protected function signTransaction($transaction, $privateKey)
    {
        $ec = new EC('secp256k1');
        $key = $ec->keyFromPrivate($privateKey);

        $transactionHash = Keccak::hash(hex2bin($transaction['txID']), 256);
        \Log::info("Transaction hash: $transactionHash");

        $signature = $key->sign($transactionHash, ['canonical' => true]);
        \Log::info('Signature:', ['r' => $signature->r->toString(16), 's' => $signature->s->toString(16), 'v' => $signature->recoveryParam]);

        $r = str_pad($signature->r->toString(16), 64, '0', STR_PAD_LEFT);
        $s = str_pad($signature->s->toString(16), 64, '0', STR_PAD_LEFT);
        $v = dechex($signature->recoveryParam + 27);

        $transaction['signature'] = [$r . $s . $v];

        // Serialize the transaction into hex
        $signedTransactionHex = $this->serializeTransactionToHex($transaction);
        \Log::info('Serialized signed transaction:', [$signedTransactionHex]);

        return $signedTransactionHex;
    }

    protected function serializeTransactionToHex($transaction)
    {
        // Serializing raw_data
        $rawDataHex = $this->encodeRawDataToHex($transaction['raw_data']);

        // Serializing signature
        $signatureHex = implode('', $transaction['signature']);

        return $rawDataHex . $signatureHex;
    }


    protected function encodeRawDataToHex($rawData)
    {
        // Convert raw data to JSON string and then to binary
        $rawDataJson = json_encode($rawData);
        $rawDataBinary = hex2bin(bin2hex($rawDataJson));

        // Convert binary data to hexadecimal representation
        return bin2hex($rawDataBinary);
    }

    protected function sendRawTransaction($signedTransactionHex)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => self::API_KEY,
        ])->post(self::BASE_URL . "/wallet/broadcasthex", [
            'transaction' => $signedTransactionHex
        ]);

        if ($response->failed()) {
            throw new \Exception('Broadcast request failed: ' . $response->body());
        }

        $responseJson = $response->json();

        if (!isset($responseJson['result']) || !$responseJson['result']) {
            throw new \Exception('Broadcast failed: ' . json_encode($responseJson));
        }

        \Log::info('Broadcast response.');

        return $responseJson;
    }

    private function encodeTransferParams($toAddress, $amount)
    {
        $toAddressHex = substr($this->base58ToHex($toAddress), 2); // Remove the '41' prefix
        $toAddressEncoded = str_pad($toAddressHex, 64, '0', STR_PAD_LEFT);
        $amountHex = dechex((int) $amount * 1000000); // Adjust for token decimals
        $amountEncoded = str_pad($amountHex, 64, '0', STR_PAD_LEFT);
        return $toAddressEncoded . $amountEncoded;
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

    private function privateKeyToAddress($privateKey)
    {
        $ec = new EC('secp256k1');
        $key = $ec->keyFromPrivate($privateKey);
        $publicKey = $key->getPublic('hex');
        return $this->publicKeyToAddress($publicKey);
    }

    private function publicKeyToAddress($publicKey): string
    {
        $publicKeyHex = hex2bin($publicKey);
        $hash = Keccak::hash(substr($publicKeyHex, 1), 256);
        $addressHex = '41' . substr($hash, -40);

        return $this->hexString2Base58Check($addressHex);
    }

    private function hexString2Base58Check($hexString): string
    {
        $hash0 = hash('sha256', hex2bin($hexString));
        $hash1 = hash('sha256', hex2bin($hash0));
        $checksum = substr($hash1, 0, 8);
        $addressWithChecksum = strtoupper($hexString . $checksum);

        return $this->base58Encode(hex2bin($addressWithChecksum));
    }

    private function base58Encode($bin)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $baseCount = strlen($alphabet);
        $encoded = '';
        $num = gmp_init(bin2hex($bin), 16);

        while (gmp_cmp($num, $baseCount) >= 0) {
            [$num, $rem] = gmp_div_qr($num, $baseCount);
            $encoded = $alphabet[gmp_intval($rem)] . $encoded;
        }

        $encoded = $alphabet[gmp_intval($num)] . $encoded;

        foreach (str_split($bin) as $byte) {
            if ($byte === "\x00") {
                $encoded = '1' . $encoded;
            } else {
                break;
            }
        }

        return $encoded;
    }

    protected function checkPermissions($address)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'TRON-PRO-API-KEY' => self::API_KEY,
        ])->post(self::BASE_URL . "/wallet/getaccount", [
            'address' => $address,
            'visible' => true,
        ]);

        $account = $response->json();

        throw new \Exception('Acc permission response: ' . json_encode($response->json()));
    }
}

