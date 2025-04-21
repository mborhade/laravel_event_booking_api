<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendee extends Model
{
    protected $fillable = ['name', 'email'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
