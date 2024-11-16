<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "users";
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'tokenaccessfg',
        'iduserfg',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function profiles()
    {
        return $this->belongsToMany(Profiles::class, 'user_profiles', 'user_id', 'profile_id');
    }

    public function priorities()
    {
        return $this->hasMany(Priorities::class, 'user_id', 'id');
    }

    public function statuses()
    {
        return $this->hasMany(Status::class, 'user_id', 'id');
    }
}
