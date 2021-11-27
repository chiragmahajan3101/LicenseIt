<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    // RELATIONSHIPS

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
