<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    public function Spaces()
    {
        return $this->hasMany(Space::class);
    }
}
