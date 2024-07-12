<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotEligibleToUpgradeException;
use App\Http\Requests\ChangePasswordActionRequest;
use App\Models\Level;
use App\Models\Message;
use App\Models\Setting;
use App\Services\UserReferralsService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Random\RandomException;

class MainController extends Controller
{
    public function __construct(
        private readonly UserReferralsService $userReferralsService,
        private readonly UserService          $userService,
    )
    {

    }

    public function home()
    {
        $levels = Level::all();
        $user = auth()->user();
        $newMembers = $this->generateNewMembers(500);

        return view('tailwindui.home.home', compact('levels', 'user', 'newMembers'));
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

        return view('tailwindui.levels.levels', compact('levels', 'user'));
    }

    public function team()
    {
        $levelReferralsInfo = $this->userReferralsService->getCountOfReferralsForEachLevelForUser(auth()->user());
        $user = auth()->user();
        $referralBonusPercentage = (float)Setting::where('key', Setting::REFERRAL_BONUS_PERCENTAGE)->first()->value;
        $autoWithdrawalUpToAmount = (float)Setting::where('key', Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)->first()->value;

        return view('tailwindui.team.team', compact('user', 'levelReferralsInfo', 'referralBonusPercentage', 'autoWithdrawalUpToAmount'));
    }

    public function general()
    {
        $user = auth()->user();

        return view('tailwindui.general.general', compact('user'));
    }

    public function profile()
    {
        $user = auth()->user();

        return view('tailwindui.profile.profile', compact('user'));
    }

    public function levelsCalculator()
    {
        $levels = Level::all();

        return view('pages.levels-calculator', compact('levels'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactAction(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|string',
            'message' => 'required|string',
        ]);

        Message::create([
            'first_name' => $request->get('first_name'),
            'last_name' =>  $request->get('last_name'),
            'email'     =>  $request->get('email'),
            'content'     =>  $request->get('message'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!'
        ]);
    }

    public function faq()
    {
        $faqs = \App\Models\Faq::all();

        return view('pages.faq', compact('faqs'));
    }

    public function changePassword()
    {
        $user = auth()->user();

        return view('tailwindui.change-password.change-password', compact('user'));
    }

    public function changePasswordAction(ChangePasswordActionRequest $request)
    {
        $user = auth()->user();

        $this->userService->changePassword($user, $request->input('new_password'));

        return redirect()->route('user.change-password')->with('success', 'Password changed successfully');
    }

    private function generateRandomEmail(): string
    {
        $vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
        $alphabet = range('a', 'z');
        $providers = [
            'gmail.com',
            'yahoo.com',
            'hotmail.com',
            'outlook.com',
            'aol.com',
            'protonmail.com',
            'zoho.com',
            'icloud.com',
            'yandex.com',
            'mail.com',
            'gmx.com',
        ];

        $firstLetter = $alphabet[array_rand($alphabet)];
        $secondLetter = $vowels[array_rand($vowels)];
        $thirdLetter = $alphabet[array_rand($alphabet)];
        $localPartLength = random_int(4, 9);
        $localPart = str_repeat('*', $localPartLength);
        $domain = $providers[array_rand($providers)];

        return $firstLetter . $secondLetter . $thirdLetter . $localPart . '@' . $domain;
    }

    private function generateNewMembers(int $count): array
    {
        $newMembers = [];
        $levels = Level::all()->toArray();

        for ($i = 0; $i < $count; $i++) {
            if (random_int(0, 1)) {
                $newMembers[] = $this->generateRandomEmail() . " just invested " . $levels[array_rand($levels)]['upgrade_cost'] . " <b>USDT</b>";
            } else {
                $newMembers[] = $this->generateRandomEmail() . " just claimed " . $levels[array_rand($levels)]['daily_return_amount'] . " <b>USDT</b>";
            }
        }

        return $newMembers;
    }
}
