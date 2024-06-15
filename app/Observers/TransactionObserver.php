<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionObserver
{
    public function creating(Transaction $transaction): void
    {
        $transaction->ulid = Str::ulid()->toBase32();
    }
}
