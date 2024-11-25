<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSpace extends Model
{
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
