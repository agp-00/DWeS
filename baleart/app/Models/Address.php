<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
