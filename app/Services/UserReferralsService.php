<?php

namespace App\Services;

use App\Models\Level;
use App\Models\User;

class UserReferralsService
{
    public function userHasEnoughReferralsToUpgradeToLevel(User $user, Level $level): bool
    {
        $previousLevel = $this->getPreviousLevelOfLevel($level);

        if (!$previousLevel) {
            // first level
            return true;
        }

        $numberOfUserReferralsCurrentlyInLevelHigherThan = $this->getNumberOfUserReferralsCurrentlyInOrHigherThanLevel($user, $previousLevel);

        return $numberOfUserReferralsCurrentlyInLevelHigherThan >= $level->required_referrals_count;
    }

    public function getNumberOfUserReferralsCurrentlyInOrHigherThanLevel(User $user, Level $level): int
    {
        return $user->referredUsers()
            ->whereHas('level', function ($query) use ($level) {
                $query->where('rank', '>=', $level->rank);
            })
            ->count();
    }

    public function getNumberOfUserReferralsCurrentlyInLevel(User $user, Level $level): int
    {
        return $user->referredUsers()
            ->whereHas('level', function ($query) use ($level) {
                $query->where('id', '=', $level->id);
            })
            ->count();
    }

    public function getNumberOfUserReferralsWithoutLevel(User $user): int
    {
        return $user->referredUsers()
            ->whereNull('level_id')
            ->count();
    }

    public function getCountOfReferralsForEachLevelForUser(User $user): array
    {
        $levels = Level::all();

        $data = [];

        $data['None'] = $this->getNumberOfUserReferralsWithoutLevel($user);

        foreach ($levels as $level) {
            $data[$level->name] = $this->getNumberOfUserReferralsCurrentlyInLevel($user, $level);
        }

        return $data;
    }

    private function getPreviousLevelOfLevel(Level $level): ?Level
    {
        return Level::where('rank', '<', $level->rank)
            ->orderBy('rank', 'asc')
            ->first();
    }
}
