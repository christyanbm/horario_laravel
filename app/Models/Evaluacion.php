<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones'; // <- nombre real de tu tabla

    protected $fillable = [
        'alumno_id',
        'maestro_id',
        'puntualidad',
        'claridad',
        'paciencia',
        'dominio',
        'conocimiento',
        'dinamica',
        'comentario',
    ];
}
