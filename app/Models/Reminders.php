<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    use HasFactory;

    protected $table = "reminders";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
        'alarm',
        'datereminder',
        'hourreminder',
        'profileid',
        'priorityid',  // Agregar el campo de prioridad
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con la tabla de prioridades.
     */
    public function priority()
    {
        return $this->belongsTo(Priorities::class, 'priorityid');
    }
}
