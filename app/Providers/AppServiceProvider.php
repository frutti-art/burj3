<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\Translation;
use App\Models\User;
use App\Observers\TransactionObserver;
use App\Observers\UserObserver;
use App\Services\UserService;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Transaction::observe(TransactionObserver::class);

        Facades\View::composer(['pages.*', 'tailwindui.*'], function (View $view) {
            if (auth()->check()) {
                $userService = app(UserService::class);
                $userIsEligibleToClaimBonus = $userService->userIsEligibleToClaimBonus(auth()->user());

                [$gainedBonus, $durationToNextClaim] = $this->calculateBonusUntilNow();

                $view->with('userIsEligibleToClaimBonus', $userIsEligibleToClaimBonus);
                $view->with('gainedBonus', $gainedBonus);
                $view->with('durationToNextClaim', $durationToNextClaim);
                $view->with('countUpValues', $this->getValuesForCountUp());

                $translations = Translation::all()->pluck('value', 'key')->toArray();

                $view->with('t', $translations);
            }
        });
    }

    private function calculateBonusUntilNow(): array
    {
        $currentTime = Carbon::now();

        $startTime = $currentTime->copy()->hour(8)->minute(0)->second(0);

        if ($currentTime->lt($startTime)) {
            $startTime->subDay();
        }

        $lastClaimTransaction = auth()->user()->transactions()
            ->where('reference', Transaction::REFERENCE_DAILY_RETURN)
            ->orderByDesc('created_at')
            ->first();

        if ($lastClaimTransaction) {
            $transactionTime = Carbon::parse($lastClaimTransaction->created_at);

            if ($transactionTime->gt($startTime)) {
                $startTime = $transactionTime->copy();
            }
        }

        $levelUpgradedAt = Carbon::parse(auth()->user()->level_upgraded_at);

        // TODO: test this
        if ($levelUpgradedAt && $levelUpgradedAt->gt($startTime)) {
            $startTime = $levelUpgradedAt->copy();
        }

        $totalDuration = 24 * 60 * 60;

        $elapsedDuration = abs($currentTime->diffInSeconds($startTime));

        $totalMoney = auth()->user()->level?->daily_return_amount ?? 0;

        if ($totalMoney === 0) {
            return [0, 0];
        }

        $endTime = $startTime->copy()->addDay();

        return [
            ($totalMoney / $totalDuration) * $elapsedDuration,
            abs($currentTime->diffInSeconds($endTime) * 7)
        ];
    }

    private function getValuesForCountUp()
    {
        $now = Carbon::now();
        $todayEightAm = Carbon::today()->setHour(8);

        if ($now->greaterThan($todayEightAm)) {
            $nextEightAm = $todayEightAm->addDay();
        } else {
            $nextEightAm = $todayEightAm;
        }

        $hours = $now->diffInHours($nextEightAm);
        $minutes = $now->copy()->addHours($hours)->diffInMinutes($nextEightAm);
        $seconds = $now->copy()->addHours($hours)->addMinutes($minutes)->diffInSeconds($nextEightAm);

        return [$hours, $minutes, $seconds];
    }
}
