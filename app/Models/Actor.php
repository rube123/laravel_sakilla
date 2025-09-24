<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $table = 'actor'; // nombre exacto de la tabla en Sakila

    protected $primaryKey = 'actor_id'; // clave primaria de la tabla

    public $timestamps = false; // Sakila no tiene created_at/updated_at en actor

    protected $fillable = [
        'first_name',
        'last_name'
    ];
}
