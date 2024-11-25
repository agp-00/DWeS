<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    public function modalitySpaces()
    {
        return $this->hasMany(ModalitySpace::class);
    }
}
