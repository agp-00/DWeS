<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function Spaces()
    {
        return $this->hasMany(Space::class);
    }
}
