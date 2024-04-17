<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles_has_user extends Model
{
    use HasFactory;

    protected $table = "profiles_has_user";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'userid',
        'porfileid',
        'created_at',
        'updated_at',
    ];
}

