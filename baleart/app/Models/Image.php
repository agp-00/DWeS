<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}