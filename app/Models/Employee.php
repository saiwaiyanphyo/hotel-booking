<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Authenticatable
{
    protected $guarded = [];
    
    protected $hidden = [
        'password',
    ];
}
