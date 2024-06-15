<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotEligibleToUpgradeException;
use App\Models\Level;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly UserService $userService,
    )
    {
    }

    public function upgrade(Request $request, Level $level)
    {
        $user = auth()->user();

        try {
            $this->userService->userIsEligibleToUpgradeToLevel($user, $level);
        } catch (UserNotEligibleToUpgradeException $exception) {
            return redirect()->route('user.deposit')->with('error', $exception->getMessage());
        }

        if ($this->userService->userIsEligibleToClaimBonus($user)) {
            $this->transactionService->createTransactionForClaimBonus(auth()->user());
        }

        $this->userService->upgradeUserToLevel($user, $level);

        return redirect()->route('user.home')->with('success', 'Upgrade successful!');
    }

    public function claimBonusAction(Request $request)
    {
        $userIsEligibleToClaimBonus = $this->userService->userIsEligibleToClaimBonus(auth()->user());

        if (! $userIsEligibleToClaimBonus) {
            return redirect()->route('user.home')->with('error', 'You are not eligible to claim bonus');
        }

        $transaction = $this->transactionService->createTransactionForClaimBonus(auth()->user());

        return redirect()->route('user.home')->with('success', 'Bonus claimed successfully');
    }
}
