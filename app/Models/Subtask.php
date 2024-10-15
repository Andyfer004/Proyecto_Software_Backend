<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;


    protected $table ="subtasks";

    protected $primaryKey="id";


    protected $fillable = [
        'id',
        'name',
        'description',
        'priorityid',
        'duedate',
        'timeestimatehours',
        'taskid',
        'statusid',
        'created_at',
        'updated_at',
    ];
}
