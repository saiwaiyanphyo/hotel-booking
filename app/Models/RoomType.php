<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $guarded = [];
    
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
