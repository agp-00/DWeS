<?php

namespace App\Models;

use App\Models\Island;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'island_id',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
