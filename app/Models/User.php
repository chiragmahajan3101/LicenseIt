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

    // Boot Methods
    public static function boot()
    {
        parent::boot();
        static::created(function (User $user) {
            if ($user->role == User::USER_ADMIN) {
                $user->update([
                    'company_id' => ""
                ]);
            } else {
                $lastUser = User::orderBy('id', 'DESC')->skip(1)->first();
                if (strcmp($lastUser->company_id, "") == 0) {
                    $user->update([
                        'company_id' => "ML_1"
                    ]);
                } else {
                    $lastId = $lastUser->company_id;
                    $arr = explode("_", $lastId);
                    $newId = (int)$arr[1] + 1;
                    $user->update([
                        'company_id' => "ML_" . (string)$newId
                    ]);
                }
            }
        });
    }

    // HELPER FUNCTIONS
    public function isAdmin()
    {
        return $this->role === self::USER_ADMIN;
    }

    public function isBuyer()
    {
        return $this->role === self::USER_BUYER;
    }

    //SCOPES
    public function scopeSearch($query)
    {
        $email = request('email');
        if ($email) {
            $user = User::where('email', $email)->first();
            $id = $user->id;
            return $query->where("id", $id);
        }
        return $query;
    }

    // Getters
    public function getActionButtonsAttribute()
    {
        return ("<a href='/users/$this->id/edit' class='btn btn-sm btn-info' title='Edit User'>Edit <i class='fa fa-edit fa-lg'></i></a>");
    }

    // RELATIONSHIPS
    public function licenses()
    {
        return $this->hasMany(License::class, 'buyer_id');
    }
}
