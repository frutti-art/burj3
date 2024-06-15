<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    public const TYPE_DEPOSIT = 'deposit';
    public const TYPE_WITHDRAW = 'withdraw';

    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_ERROR = 'error';

    public const REFERENCE_LEVEL_UP = 'level_up';
    public const REFERENCE_REFERRAL_BONUS = 'referral_bonus';
    public const REFERENCE_DAILY_RETURN = 'daily_return';
    public const REFERENCE_WITHDRAWAL = 'withdrawal';
    public const REFERENCE_DEPOSIT = 'deposit';

    public const TOKEN_USDT = 'USDT';
    public const TOKEN_TRX = 'TRX';

    protected $guarded = [];

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTokensAvailable()
    {
        return [
            self::TOKEN_USDT,
            self::TOKEN_TRX
        ];
    }
}
