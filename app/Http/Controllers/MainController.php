<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotEligibleToUpgradeException;
use App\Models\Level;
use App\Models\Setting;
use App\Services\UserReferralsService;
use App\Services\UserService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(
        private readonly UserReferralsService $userReferralsService,
        private readonly UserService $userService,
    )
    {

    }

    public function home()
    {
        $levels = Level::all();
        $user = auth()->user();

        return view('tailwindui.home', compact('levels', 'user'));
    }

    public function levels()
    {
        $levels = Level::orderBy('rank', 'ASC')->get();
        $user = auth()->user();

        foreach ($levels as $level) {
            try {
                if ($this->userService->userIsEligibleToUpgradeToLevel($user, $level)) {
                    $level->is_eligible_to_upgrade = true;
                }
            } catch (UserNotEligibleToUpgradeException $exception) {
                \Log::info($exception->getMessage());
                $level->is_eligible_to_upgrade = false;
            }
        }

        return view('tailwindui.levels', compact('levels', 'user'));
    }

    public function team()
    {
        $levelReferralsInfo = $this->userReferralsService->getCountOfReferralsForEachLevelForUser(auth()->user());
        $user = auth()->user();
        $referralBonusPercentage = (float) Setting::where('key', Setting::REFERRAL_BONUS_PERCENTAGE)->first()->value;
        $autoWithdrawalUpToAmount = (float) Setting::where('key', Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)->first()->value;

        return view('tailwindui.team', compact('user', 'levelReferralsInfo', 'referralBonusPercentage', 'autoWithdrawalUpToAmount'));
    }

    public function general()
    {
        $user = auth()->user();

        return view('tailwindui.general', compact('user'));
    }

    public function profile()
    {
        $user = auth()->user();

        return view('tailwindui.profile', compact('user'));
    }

    public function levelsCalculator()
    {
        $levels = Level::all();

        return view('pages.levels-calculator', compact('levels'));
    }
}
