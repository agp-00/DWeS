<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Island;
use App\Models\Space;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'municipality_id',
        'zone_id',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



    public function space()
    {
        return $this->hasOne(Space::class);
    }

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
