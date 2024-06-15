<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    public const HOME_CTA_TEXT = 'HOME_CTA_TEXT';
    public const HOME_CTA_TEXT_WHEN_NO_LEVEL = 'HOME_CTA_TEXT_WHEN_NO_LEVEL';
    public const HOME_CTA_BUTTON_TEXT = 'HOME_CTA_BUTTON_TEXT';
    public const HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL = 'HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL';
    public const HOME_NEW_MEMBERS_TITLE = 'HOME_NEW_MEMBERS_TITLE';
    public const HOME_NEW_MEMBERS_ITEM_TEXT = 'HOME_NEW_MEMBERS_ITEM_TEXT';

    public const LEVELS_PAGE_TITLE = 'LEVELS_PAGE_TITLE';
    public const LEVELS_PAGE_DESCRIPTION = 'LEVELS_PAGE_DESCRIPTION';
    public const LEVELS_PAGE_UPGRADE_BUTTON_TEXT = 'LEVELS_PAGE_UPGRADE_BUTTON_TEXT';
    public const LEVELS_PAGE_UPGRADE_BUTTON_TEXT_WHEN_CURRENT_LEVEL = 'LEVELS_PAGE_UPGRADE_BUTTON_TEXT_WHEN_CURRENT_LEVEL';
    public const LEVELS_PAGE_INVITE_FRIENDS_TEXT = 'LEVELS_PAGE_INVITE_FRIENDS_TEXT';
    public const LEVELS_PAGE_YOU_INVEST = 'LEVELS_PAGE_YOU_INVEST';
    public const LEVELS_PAGE_YOU_GET = 'LEVELS_PAGE_YOU_GET';

    public const GENERAL_PAGE_DEPOSIT_BUTTON_TEXT = 'GENERAL_PAGE_DEPOSIT_BUTTON_TEXT';
    public const GENERAL_PAGE_WITHDRAW_BUTTON_TEXT = 'GENERAL_PAGE_WITHDRAW_BUTTON_TEXT';
    public const GENERAL_PAGE_CLAIM_CARD_TEXT = 'GENERAL_PAGE_CLAIM_CARD_TEXT';
    public const GENERAL_PAGE_CLAIM_TEXT = 'GENERAL_PAGE_CLAIM_TEXT';

    public const TEAM_PAGE_TITLE = 'TEAM_PAGE_TITLE';
    public const TEAM_PAGE_DESCRIPTION = 'TEAM_PAGE_DESCRIPTION';
    public const TEAM_PAGE_YOUR_CODE = 'TEAM_PAGE_YOUR_CODE';
    public const TEAM_PAGE_SHARE_URL_WITH_FRIENDS = 'TEAM_PAGE_SHARE_URL_WITH_FRIENDS';
    public const TEAM_PAGE_REFERRALS_LIST_TITLE = 'TEAM_PAGE_REFERRALS_LIST_TITLE';
    public const TEAM_PAGE_FRIENDS = 'TEAM_PAGE_FRIENDS';

    public const PROFILE_PAGE_TITLE = 'PROFILE_PAGE_TITLE';
    public const PROFILE_PAGE_DESCRIPTION = 'PROFILE_PAGE_DESCRIPTION';

    public const DEPOSIT_PAGE_TITLE = 'DEPOSIT_PAGE_TITLE';
    public const DEPOSIT_PAGE_DESCRIPTION = 'DEPOSIT_PAGE_DESCRIPTION';
    public const DEPOSIT_PAGE_USUALLY_PROCESSED_TEXT = 'DEPOSIT_PAGE_USUALLY_PROCESSED_TEXT';
    public const DEPOSIT_PAGE_HELP_TEXT = 'DEPOSIT_PAGE_HELP_TEXT';

    public const WITHDRAW_PAGE_TITLE = 'WITHDRAW_PAGE_TITLE';
    public const WITHDRAW_PAGE_DESCRIPTION = 'WITHDRAW_PAGE_DESCRIPTION';
    public const WITHDRAW_PAGE_HELP_TEXT = 'WITHDRAW_PAGE_HELP_TEXT';
    public const WITHDRAW_PAGE_SUBMIT_BUTTON_TEXT = 'WITHDRAW_PAGE_SUBMIT_BUTTON_TEXT';

    protected $guarded = [];
    protected $table = 'translations';

    public static function getAllKeys()
    {
        return [
            self::HOME_CTA_TEXT,
            self::HOME_CTA_TEXT_WHEN_NO_LEVEL,
            self::HOME_CTA_BUTTON_TEXT,
            self::HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL,
            self::HOME_NEW_MEMBERS_TITLE,
            self::HOME_NEW_MEMBERS_ITEM_TEXT,
            self::LEVELS_PAGE_TITLE,
            self::LEVELS_PAGE_DESCRIPTION,
            self::LEVELS_PAGE_UPGRADE_BUTTON_TEXT,
            self::LEVELS_PAGE_UPGRADE_BUTTON_TEXT_WHEN_CURRENT_LEVEL,
            self::LEVELS_PAGE_INVITE_FRIENDS_TEXT,
            self::LEVELS_PAGE_YOU_INVEST,
            self::LEVELS_PAGE_YOU_GET,
            self::GENERAL_PAGE_DEPOSIT_BUTTON_TEXT,
            self::GENERAL_PAGE_WITHDRAW_BUTTON_TEXT,
            self::GENERAL_PAGE_CLAIM_CARD_TEXT,
            self::GENERAL_PAGE_CLAIM_TEXT,
            self::TEAM_PAGE_TITLE,
            self::TEAM_PAGE_DESCRIPTION,
            self::TEAM_PAGE_YOUR_CODE,
            self::TEAM_PAGE_SHARE_URL_WITH_FRIENDS,
            self::TEAM_PAGE_REFERRALS_LIST_TITLE,
            self::TEAM_PAGE_FRIENDS,
            self::PROFILE_PAGE_TITLE,
            self::PROFILE_PAGE_DESCRIPTION,
            self::DEPOSIT_PAGE_TITLE,
            self::DEPOSIT_PAGE_DESCRIPTION,
            self::DEPOSIT_PAGE_USUALLY_PROCESSED_TEXT,
            self::DEPOSIT_PAGE_HELP_TEXT,
            self::WITHDRAW_PAGE_TITLE,
            self::WITHDRAW_PAGE_DESCRIPTION,
            self::WITHDRAW_PAGE_HELP_TEXT,
            self::WITHDRAW_PAGE_SUBMIT_BUTTON_TEXT,
        ];
    }

    public static function getDefaultValues()
    {
       return [
                self::HOME_CTA_TEXT => 'Upgrade to a higher level to win more.',
                self::HOME_CTA_TEXT_WHEN_NO_LEVEL => 'Get started by upgrading to a level.',
                self::HOME_CTA_BUTTON_TEXT => 'Manage your level',
                self::HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL => 'See levels',
                self::HOME_NEW_MEMBERS_TITLE => 'New members joining now',
                self::HOME_NEW_MEMBERS_ITEM_TEXT => 'just invested',
                self::LEVELS_PAGE_TITLE => 'Levels',
                self::LEVELS_PAGE_DESCRIPTION => 'Workcation is a property rental website. Etiam ullamcorper massa viverra consequat, consectetur.',
                self::LEVELS_PAGE_UPGRADE_BUTTON_TEXT => 'I want to win',
                self::LEVELS_PAGE_UPGRADE_BUTTON_TEXT_WHEN_CURRENT_LEVEL => 'Current',
                self::LEVELS_PAGE_INVITE_FRIENDS_TEXT => 'You need to invite %s friend(s) to <b>%s</b> to be able to upgrade',
                self::LEVELS_PAGE_YOU_INVEST => 'You invest',
                self::LEVELS_PAGE_YOU_GET => 'You get',
                self::GENERAL_PAGE_DEPOSIT_BUTTON_TEXT => 'Deposit',
                self::GENERAL_PAGE_WITHDRAW_BUTTON_TEXT => 'Withdraw',
                self::GENERAL_PAGE_CLAIM_CARD_TEXT => 'To claim %s please come back in:',
                self::GENERAL_PAGE_CLAIM_TEXT => 'Claim',
                self::TEAM_PAGE_TITLE => 'Referrals',
                self::TEAM_PAGE_DESCRIPTION => 'Workcation is a property rental website. Etiam ullamcorper massa viverra consequat, consectetur.',
                self::TEAM_PAGE_YOUR_CODE => 'Your referral code',
                self::TEAM_PAGE_SHARE_URL_WITH_FRIENDS => 'Share URL with friends',
                self::TEAM_PAGE_REFERRALS_LIST_TITLE => 'Your referrals',
                self::TEAM_PAGE_FRIENDS => 'friends',
                self::PROFILE_PAGE_TITLE => 'Profile',
                self::PROFILE_PAGE_DESCRIPTION => 'Workcation is a property rental website. Etiam ullamcorper massa viverra consequat, consectetur.',
                self::DEPOSIT_PAGE_TITLE => 'Deposit to your account',
                self::DEPOSIT_PAGE_DESCRIPTION => 'Workcation is a property rental website. Etiam ullamcorper massa viverra consequat, consectetur.',
                self::DEPOSIT_PAGE_USUALLY_PROCESSED_TEXT => 'Deposit transaction is usually processed within 1 minute.',
                self::DEPOSIT_PAGE_HELP_TEXT => '',
                self::WITHDRAW_PAGE_TITLE => 'Withdraw to your wallet',
                self::WITHDRAW_PAGE_DESCRIPTION => 'Workcation is a property rental website. Etiam ullamcorper massa viverra consequat, consectetur.',
                self::WITHDRAW_PAGE_HELP_TEXT => '',
                self::WITHDRAW_PAGE_SUBMIT_BUTTON_TEXT => 'Withdraw',
       ];
    }
}
