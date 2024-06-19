<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Crypto\GetWalletTransactionsService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DepositTransactionsCheckerCommand extends Command
{
    public const SUB_MINUTES = 480;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deposit-transactions-checker-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(GetWalletTransactionsService $getWalletTransactionsService)
    {
        $timeRangeToCheck = Carbon::now()->subMinutes(self::SUB_MINUTES);
        $users = User::with('transactions')
            ->where('last_possible_deposit', '>', $timeRangeToCheck)
            ->where('is_admin', false)
            ->get();

        $minTimestamp = $timeRangeToCheck->timestamp * 1000; // in milliseconds

        foreach ($users as $user) {
            $transactions = $getWalletTransactionsService->handle($user->wallet_address, $minTimestamp);
            foreach ($transactions as $transaction) {
                if ($user->transactions()->where('tx_id', $transaction['transaction_id'])->doesntExist()) {
                    $amount = (float) $transaction['value'] / 1000000;

                    $createdTransaction = $user->transactions()->create([
                        'tx_id' => $transaction['transaction_id'],
                        'amount' => $amount,
                        'reference' => Transaction::REFERENCE_DEPOSIT,
                        'type' => Transaction::TYPE_DEPOSIT,
                        'status' => Transaction::STATUS_COMPLETED,
                        'wallet_address' => $user->wallet_address,
                    ]);

                    if ($user->referrer !== null) {
                        $user->referrer->transactions()->create([
                            'amount' => $this->calculateAmountForReferralBonus($amount),
                            'status' => Transaction::STATUS_PENDING,
                            'type' => Transaction::TYPE_DEPOSIT,
                            'reference' => Transaction::REFERENCE_REFERRAL_BONUS,
                        ]);
                    }

                    $user->update([
                        'balance' => $user->balance + $createdTransaction->amount,
                    ]);
                }
            }
        }
    }

    private function calculateAmountForReferralBonus(float $amount): float
    {
        $referralBonusPercentage = (float) Setting::where('key', Setting::REFERRAL_BONUS_PERCENTAGE)->first()->value;

        return $amount * ($referralBonusPercentage / 100);
    }
}
