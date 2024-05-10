<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressHasUser extends Model
{
    protected $table = 'progress_has_user';

    protected $fillable = [
        'progress',
        'week',
        'userid'
    ];

    public $timestamps = true;

    /**
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
