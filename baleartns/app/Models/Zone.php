<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
