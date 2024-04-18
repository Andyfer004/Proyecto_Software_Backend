<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_subtask extends Model
{
    use HasFactory;
    protected $table ="assignment_subtask";

    protected $primaryKey="id";

    protected $fillable = [
        'id',
        'userid',
        'subtaskid',
        'created_at',
        'updated_at',
    ];
}
