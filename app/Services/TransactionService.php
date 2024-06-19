<?php

namespace App\Services;

use App\Jobs\MakeCryptoTransferOfAcceptedWithdrawTransactionJob;
use App\Models\Level;
use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    public function createTransactionForClaimBonus(User $user): Transaction
    {
        return Transaction::create([
            'user_id' => $user->id,
            'amount' => $user->level->daily_return_amount,
            'type' => Transaction::TYPE_DEPOSIT,
            'status' => Transaction::STATUS_PENDING,
            'reference' => Transaction::REFERENCE_DAILY_RETURN,
            'transactionable_id' => $user->level->id,
            'transactionable_type' => Level::class,
        ]);
    }

    public function createTransactionForWithdraw(User $user, int $amount, string $wallet_address): Transaction
    {
        return Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'wallet_address' => $wallet_address,
            'type' => Transaction::TYPE_WITHDRAW,
            'status' => Transaction::STATUS_PENDING,
            'reference' => Transaction::REFERENCE_WITHDRAWAL,
        ]);
    }

    public function acceptWithdrawTransaction(Transaction $transaction)
    {
        if (
            $transaction->status !== Transaction::STATUS_PENDING ||
            $transaction->type !== Transaction::TYPE_WITHDRAW ||
            $transaction->reference !== Transaction::REFERENCE_WITHDRAWAL
        ) {
            $transaction->update([
                'status' => Transaction::STATUS_ERROR,
            ]);

            return;
        }

        if ($transaction->amount > $transaction->user->balance) {
            $transaction->update([
                'status' => Transaction::STATUS_ERROR,
            ]);

            \Log::info('User balance is too low to withdraw. Transaction ID: ' . $transaction->id . ' User ID: ' . $transaction->user->id);

            return;
        }

        $transaction->user->update([
            'balance' => $transaction->user->balance - $transaction->amount,
        ]);

        $transaction->update([
            'status' => Transaction::STATUS_ACCEPTED,
        ]);

        MakeCryptoTransferOfAcceptedWithdrawTransactionJob::dispatch($transaction->fresh());
    }

    public function rejectWithdrawTransaction(Transaction $transaction)
    {
        $transaction->update([
            'status' => Transaction::STATUS_REJECTED,
        ]);
    }
}
