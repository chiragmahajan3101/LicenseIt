<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const USER_ADMIN = 1;
    const USER_BUYER = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // HELPER FUNCTIONS
    public function isAdmin()
    {
        return $this->role === self::USER_ADMIN;
    }

    public function isBuyer()
    {
        return $this->role === self::USER_BUYER;
    }

    // RELATIONSHIPS
    public function licenses()
    {
        return $this->hasMany(License::class, 'buyer_id');
    }
}
