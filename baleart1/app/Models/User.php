<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /* @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /*
     
The attributes that are mass assignable.*
@var array<int, string>*/
protected $fillable = ['name','email','password',];

    /*   
The attributes that should be hidden for serialization.*
@var array<int, string>*/
protected $hidden = ['password','remember_token',];

    /*
     
Get the attributes that should be cast.*
@return array<string, string>*/
protected function casts(): array{
    return ['email_verified_at' => 'datetime','password' => 'hashed',];}

    public function comments()
    {
        return $this->hasMany(Comment::class);  // 1:N
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function spaces(){
        return $this->hasMany(Space::class);
    }
}