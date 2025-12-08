<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
 use App\Models\HistorialAcademico;
 use App\Models\Asistencia;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'matricula',
        'creditos'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔥 MATRÍCULA AUTOMÁTICA
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            if (!$user->matricula) {

                // Prefijos válidos
                $prefijos = ['19', '20', '21'];

                // Prefijo aleatorio
                $prefijo = $prefijos[array_rand($prefijos)];

                // 6 dígitos aleatorios
                $numero = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

                // Matrícula final
                $user->matricula = $prefijo . $numero;
            }
        });
    }

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

    public function historiales()
    {
        return $this->hasMany(Historial::class, 'alumno_id');
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_user', 'user_id', 'grupo_id')
                    ->withTimestamps();
                 
    }
public function gruposMaestro()
{
    return $this->hasMany(Grupo::class, 'maestro_id');
}

    public function creditosAprobados(): int
    {
        return $this->historiales()
                    ->where('estado', 'aprobada')
                    ->sum('creditos_obtenidos');
    }

    public function materiasAprobadas()
    {
        return $this->historiales()
                    ->where('estado', 'aprobada')
                    ->with('materia');
    }

    public function materiasReprobadas()
    {
        return $this->historiales()
                    ->where('estado', 'reprobada')
                    ->with('materia');
    }
      public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'alumno_id');
    }
     public function calificaciones()
    {
        return $this->hasMany(HistorialAcademico::class, 'alumno_id');
    }
public function evaluaciones()
{
    return $this->hasMany(\App\Models\Evaluacion::class, 'maestro_id');
}
}
