<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    // Permitir la asignación masiva para estas columnas específicas
    protected $fillable = [
        'marca',
        'modelo',
        'diagnostico',
        'estado'
    ];
}