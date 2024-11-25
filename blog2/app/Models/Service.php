<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function serviceSpaces()
    {
        return $this->hasMany(ServiceSpace::class);
    }
}
