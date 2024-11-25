<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
