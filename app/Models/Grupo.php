<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Materia;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cupo_max',
        'carrera',
        'semestre',
        'hora_inicio',
        'hora_fin',
        'maestro_id',
        'materia_id',
    ];

    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
    ];

    // Relación con el maestro
    public function maestro()
    {
        return $this->belongsTo(User::class, 'maestro_id');
    }

    // Relación con la materia
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // Relación con los alumnos inscritos
    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'grupo_user', 'grupo_id', 'user_id')->withTimestamps();
    }

    // Cupo disponible
    public function getCupoDisponibleAttribute()
    {
        return $this->cupo_max - $this->alumnos()->count();
    }
    // Accesor para mostrar solo el horario
public function getHorarioAttribute()
{
    $inicio = $this->hora_inicio ? $this->hora_inicio->format('H:i') : '';
    $fin = $this->hora_fin ? $this->hora_fin->format('H:i') : '';
    return $inicio . ' - ' . $fin;
}

}
