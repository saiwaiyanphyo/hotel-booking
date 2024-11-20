<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'booking_rooms');
    }
    
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
    
    protected $casts = [
        'check_in_date' => 'datetime',
        'check_out_date' => 'datetime',
    ];
}
