<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'clave',
        'creditos',
        'semestre',
        'creditos_requeridos', // Créditos necesarios para cursar esta materia
    ];

    // Relación con Grupo
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    // Relación con Historial
    public function historiales()
    {
        return $this->hasMany(Historial::class);
    }
}
