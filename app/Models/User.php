<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    public const ADMIN_EMAIL = 'admin@admin.com';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function referredUsers()
    {
        return $this->hasMany(__CLASS__, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(__CLASS__, 'referred_by');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // we return true because we have a special middleware that checks if the user is admin
        return true;
//        return $this->email === self::ADMIN_EMAIL;
//        return $this->is_admin;
    }
}
