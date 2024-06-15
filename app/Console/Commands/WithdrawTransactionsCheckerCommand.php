<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class WithdrawTransactionsCheckerCommand extends Command
{
    public const SUB_MINUTES = 30;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:withdraw-transactions-checker-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(TransactionService $transactionService)
    {
        $timeRangeToCheck = Carbon::now()->subMinutes(self::SUB_MINUTES);

        $autoWithdrawalUpToAmount = (float) Setting::where('key', Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)->first()->value;

        $transactions = Transaction::where('status', Transaction::STATUS_PENDING)
            ->where('type', Transaction::TYPE_WITHDRAW)
            ->where('reference', Transaction::REFERENCE_WITHDRAWAL)
            ->where('amount', '<=', $autoWithdrawalUpToAmount)
            ->where('created_at', '>=', $timeRangeToCheck)
            ->whereNull('tx_id')
            ->get();

        foreach ($transactions as $transaction) {
            $transactionService->acceptWithdrawTransaction($transaction);
        }
    }
}
