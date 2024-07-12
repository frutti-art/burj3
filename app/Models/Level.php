<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $guarded = [];

    protected function dailyReturnPercentage(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => $this->calculatePercentage($attributes['daily_return_amount'], $attributes['daily_return_amount'] * $attributes['claim_limit']),
        );
    }

    private function calculatePercentage($part, $whole): float|int
    {
        if ($whole === 0) {
            return 0;
        }

        return ($part / $whole) * 100;
    }
}
