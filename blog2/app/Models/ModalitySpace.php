<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalitySpace extends Model
{
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
    
    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
