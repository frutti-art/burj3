<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class TransactionsValidatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transactions-validator-command';

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
        try {
            $this->info('Checking transactions...');

            $transactionsToCheck = Transaction::where('status', Transaction::STATUS_PENDING)
                ->where('type', Transaction::TYPE_DEPOSIT)
                ->where('created_at', '>=', now()->subMinutes(30))
                ->get();

            \Log::info('Transactions to check ' . $transactionsToCheck->count());

            foreach ($transactionsToCheck as $transaction) {
                try {
                    match ($transaction->reference) {
                        Transaction::REFERENCE_DAILY_RETURN => $this->handleTransactionForClaimBonus($transaction),
                        Transaction::REFERENCE_REFERRAL_BONUS => $this->handleTransactionForReferralBonus($transaction),
                    };
                } catch (\Exception $e) {
                    $this->error('An error occurred with transaction id ' . $transaction->id . ' - ' . $e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->error('An error occurred');
        } finally {
            $this->info('Transactions checked');
        }
    }

    private function handleTransactionForClaimBonus(Transaction $transaction): void
    {
        $user = $transaction->user;
        $user->update(['balance' => $user->balance + $transaction->amount]);

        $transaction->update(['status' => Transaction::STATUS_COMPLETED]);
    }

    private function handleTransactionForReferralBonus(Transaction $transaction): void
    {
        $user = $transaction->user;
        $user->update(['balance' => $user->balance + $transaction->amount]);

        $transaction->update([
            'status' => Transaction::STATUS_COMPLETED,
        ]);
    }
}
