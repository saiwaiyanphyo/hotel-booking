<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];
    
    protected $appends = ['full_name'];
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
