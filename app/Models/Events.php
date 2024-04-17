<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'link',
        'dateevent',
        'isrepetitive',
        'dayweek',
        'hourstart',
        'hourfinish',
        'userid',
        'created_at',
        'updated_at',
    ];

}
