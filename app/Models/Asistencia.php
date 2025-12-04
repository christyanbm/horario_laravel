<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'alumno_id',
        'grupo_id',
        'materia_id',
        'maestro_id',
        'fecha',
        'hora',
        'estado',
        'observacion'
    ];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function maestro()
    {
        return $this->belongsTo(User::class, 'maestro_id');
    }
}
