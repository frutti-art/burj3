<?php

namespace App\Services;

use App\Exceptions\UserNotEligibleToUpgradeException;
use App\Exceptions\UserNotEligibleToWithdrawException;
use App\Models\Level;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;

class UserService
{
    public function __construct(
        private readonly UserReferralsService $userReferralsService
    )
    {

    }

    public function userIsEligibleToClaimBonus(User $user): bool
    {
        if (!$user->level()->exists()) {
            return false;
        }

        if (!$user->can_finish_task) {
            return false;
        }

        $claimLimit = $user->level->claim_limit;
        $transactions = $user->transactions()
            ->where('reference', Transaction::REFERENCE_DAILY_RETURN)
            ->whereIn('status', [
                Transaction::STATUS_COMPLETED,
                Transaction::STATUS_PENDING,
            ])
            ->where('transactionable_type', Level::class)
            ->where('transactionable_id', $user->level->id)
            ->get();

        $claimsCount = $transactions->count();

        // TODO: check for possible bug here
        if ($claimsCount >= $claimLimit) {
            return false;
        }

        $mostRecentTransaction = $transactions->sortByDesc('created_at')->first();

        if ($mostRecentTransaction) {
            $createdAt = Carbon::parse($mostRecentTransaction->created_at);
            $startOfBonusPeriod = Carbon::now()->hour < 8 ? Carbon::today()->hour(8)->subDay() : Carbon::today()->hour(8);

            if ($createdAt->gte($startOfBonusPeriod)) {
                return false;
            }
        }

        if (
            !$mostRecentTransaction &&
            Carbon::parse($user->level_upgraded_at)->diffInDays(Carbon::now()) < 1
        ) {
            return false;
        }

        return true;
    }

    public function userIsEligibleToUpgradeToLevel(User $user, Level $level): bool
    {
        if ($user->level && ($user->level->rank >= $level->rank)) {
            throw new UserNotEligibleToUpgradeException('You cannot downgrade to a lower level');
        }

        if (
            $level->required_referrals_count > 0 &&
            false === $this->userReferralsService->userHasEnoughReferralsToUpgradeToLevel($user, $level)
        ) {
            throw new UserNotEligibleToUpgradeException('You do not have enough referrals to upgrade to this level');
        }

        if ($user->balance < $level->upgrade_cost) {
            throw new UserNotEligibleToUpgradeException('Balance is too low to upgrade to this level');
        }

        if ($user->level_id === null) {
            return true;
        }

        if ($user->level_id === $level->id) {
            throw new UserNotEligibleToUpgradeException('You are already on this level');
        }

        return true;
    }

    public function checkUserEligibilityToWithdraw(User $user, float $amount = null): bool
    {
        $newUsersCannotWithdrawForXDays = (int) (Setting::where('key', Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS)->first()?->value ?? 3);

        if ($user->created_at->diffInDays(Carbon::now()) < $newUsersCannotWithdrawForXDays) {
            throw new UserNotEligibleToWithdrawException('You cannot withdraw within the first 3 days of registration');
        }

        if (!$user->can_withdraw) {
            throw new UserNotEligibleToWithdrawException('You are not eligible to withdraw');
        }

        if ($amount && $user->balance < $amount) {
            throw new UserNotEligibleToWithdrawException('Balance is too low to withdraw!');
        }

        $last24HoursWithdrawTransactionsExist = $user->transactions()
            ->where('type', Transaction::TYPE_WITHDRAW)
            ->where('reference', Transaction::REFERENCE_WITHDRAWAL)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->exists();

        if ($last24HoursWithdrawTransactionsExist) {
            throw new UserNotEligibleToWithdrawException('You can only withdraw once per 24 hours');
        }

        return $user->balance >= 50;
    }

    public function userIsEligibleToDeposit(User $user): bool
    {
        return true;
    }

    public function upgradeUserToLevel(User $user, Level $level): void
    {
        $userIsUpgradingForFirstTime = $user->level_id === null;

        $user->update([
            'level_id' => $level->id,
            'balance' => $user->balance - $level->upgrade_cost,
            'level_upgraded_at' => Carbon::now(),
        ]);

        $user->transactions()->create([
            'amount' => $level->upgrade_cost,
            'status' => Transaction::STATUS_COMPLETED,
            'type' => Transaction::TYPE_WITHDRAW,
            'reference' => Transaction::REFERENCE_LEVEL_UP,
        ]);

        if ($userIsUpgradingForFirstTime && $user->referrer !== null) {
            $user->referrer->transactions()->create([
                'amount' => $this->calculateAmountForReferralBonus($level),
                'status' => Transaction::STATUS_PENDING,
                'type' => Transaction::TYPE_DEPOSIT,
                'reference' => Transaction::REFERENCE_REFERRAL_BONUS,
            ]);
        }

    }

    private function calculateAmountForReferralBonus(Level $level): float
    {
        $referralBonusPercentage = (float) Setting::where('key', Setting::REFERRAL_BONUS_PERCENTAGE)->first()->value;

        return $level->upgrade_cost * ($referralBonusPercentage / 100);
    }
}
