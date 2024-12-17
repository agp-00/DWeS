<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
      'remember_token',
  ];

    public function users()
    {
      return $this->hasMany(User::class);
    }
}
