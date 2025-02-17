<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use Illuminate\Database\Eloquent\Model;


class Space extends Model
{

  protected $primaryKey = 'id';
  protected $keyType = 'int';
  public $timestamps = false;

  protected $fillable = [
      'name',
      'regNumber',
      'observation_CA',
      'observation_ES',
      'observation_EN',
      'phone',
      'email',
      'website',
      'accessType',
      'totalScore',
      'countScore',
      'spaceType_id',
      'address_id',
      'user_id',
  ];

  protected $guarded = [
      'id',
  ];

  protected $hidden = [
      'created_at',
      'updated_at',
  ];

    public function modalities()
    {
        return $this->belongsToMany(modality::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function spaceType()
    {
        return $this->belongsTo(SpaceType::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    
}

