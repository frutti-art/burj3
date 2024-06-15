<?php

namespace App\Services\Crypto;

use Elliptic\EC;
use kornrunner\Keccak;

class TronWalletGenerator
{
    protected EC $ec;

    public function __construct()
    {
        $this->ec = new EC('secp256k1');
    }

    public function handle(): array
    {
        $keyPair = $this->ec->genKeyPair();
        $privateKey = $keyPair->getPrivate('hex');
        $publicKey = $keyPair->getPublic('hex');
        $address = $this->publicKeyToAddress($publicKey);

        return [
            'wallet_address' => $address,
            'wallet_private_key' => $privateKey
        ];
    }

    protected function publicKeyToAddress($publicKey): string
    {
        $publicKeyHex = hex2bin($publicKey);
        $hash = Keccak::hash(substr($publicKeyHex, 1), 256);
        $addressHex = '41' . substr($hash, -40);

        return $this->hexString2Base58Check($addressHex);
    }

    protected function hexString2Base58Check($hexString): string
    {
        $hash0 = hash('sha256', hex2bin($hexString));
        $hash1 = hash('sha256', hex2bin($hash0));
        $checksum = substr($hash1, 0, 8);
        $addressWithChecksum = strtoupper($hexString . $checksum);

        return $this->base58Encode(hex2bin($addressWithChecksum));
    }

    protected function base58Encode($bin)
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
}
