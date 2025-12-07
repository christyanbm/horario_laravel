<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialAcademico extends Model
{
    protected $fillable = [
        'alumno_id',
        'maestro_id',
        'materia_id',
        'calificacion',
        'creditos_otorgados'
    ];

    public function alumno() {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function maestro() {
        return $this->belongsTo(User::class, 'maestro_id');
    }

    public function materia() {
        return $this->belongsTo(Materia::class);
    }
}