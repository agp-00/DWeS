<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description_CA',
        'description_ES',
        'description_EN',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function spaces()
    {
        return $this->belongsToMany(Space::class);
    }
}
