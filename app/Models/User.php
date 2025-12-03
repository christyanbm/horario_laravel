<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // Campos asignables
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Campos ocultos
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts automáticos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Devuelve la ruta del dashboard según el rol del usuario
     */
    public function dashboardRoute(): string
    {
        $rol = $this->getRoleNames()->first();

        return match ($rol) {
            'admin' => '/admin/dashboard',
            'alumno' => '/alumno/dashboard',
            'coordinador' => '/coordinador/dashboard',
            'jefe' => '/jefe/dashboard',
            'maestro' => '/maestro/dashboard',
            default => '/home',
        };
    }

    /**
     * Relación con el historial de materias (aprobadas/reprobadas)
     */
    public function historiales()
    {
        return $this->hasMany(Historial::class, 'alumno_id');
    }

    /**
     * Relación con los grupos en los que el alumno está inscrito
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_user', 'user_id', 'grupo_id')
                    ->withTimestamps();
    }

    /**
     * Créditos totales aprobados (opcional)
     */
    public function creditosAprobados(): int
    {
        return $this->historiales()
                    ->where('estado', 'aprobada')
                    ->sum('creditos_obtenidos');
    }

    /**
     * Materias aprobadas
     */
    public function materiasAprobadas()
    {
        return $this->historiales()
                    ->where('estado', 'aprobada')
                    ->with('materia');
    }

    /**
     * Materias reprobadas
     */
    public function materiasReprobadas()
    {
        return $this->historiales()
                    ->where('estado', 'reprobada')
                    ->with('materia');
    }
}
