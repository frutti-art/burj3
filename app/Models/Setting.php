<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'settings';

    public const REFERRAL_BONUS_PERCENTAGE = 'referral_bonus_percentage';
    public const AUTO_WITHDRAWAL_UP_TO_AMOUNT = 'automatic_withdrawal_up_to_amount';
    public const CLIENT_APP_IS_LIVE = 'client_app_is_live';
    public const NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS = 'new_users_cannot_withdraw_for_x_days';
}
