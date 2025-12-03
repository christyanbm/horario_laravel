<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Materia;

class Historial extends Model
{
    protected $fillable = ['alumno_id', 'materia_id', 'estado', 'creditos_obtenidos'];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
