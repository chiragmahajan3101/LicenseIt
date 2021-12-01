<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class License extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // BOOT METHODS
    public static function boot()
    {
        parent::boot();
        static::created(function (License $license) {
            $oldLicenses = License::where('buyer_id', $license->buyer_id)->where('software_id', $license->software_id)->get();
            foreach ($oldLicenses as $oldLicense) {
                if ($oldLicense->expiry_date < now()) {
                    $oldLicense->update(['active_status' => 1]);
                }
            }
        });
    }

    // MUTATORS
    public function setBuyDateAttribute(DateTime $buy_date)
    {
        $this->attributes['buy_date'] = $buy_date;
        $date = Carbon::createFromFormat("Y.m.d", $buy_date->format('Y.m.d'));
        $this->attributes['expiry_date'] = $date->addDays(365);
    }


    // RELATIONSHIPS

    public function software()
    {
        return $this->belongsTo(Software::class, 'software_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    //SCOPES
    public function scopeSearch($query)
    {
        $email = request('email');
        if ($email) {
            $user = User::where('email', $email)->first();
            $id = $user->id;
            return $query->where("buyer_id", $id);
        }
        return $query;
    }

    //Getters

    public function getExpiryDatesAttribute()
    {
        $date = Carbon::parse($this->expiry_date);
        $date = $date->format('M d Y');
        return $date;
    }

    public function getBuyDatesAttribute()
    {
        $date = Carbon::parse($this->buy_date);
        $date = $date->format('M d Y');
        return $date;
    }
}
