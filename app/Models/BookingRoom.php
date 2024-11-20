<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    protected $guarded = [];
    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
