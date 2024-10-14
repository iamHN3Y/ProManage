<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'Apellido1',
        'Apellido2',
        'Alias',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Definir relación many-to-many con Tarea
     */
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'Usuarios_Tareas', 'ID_Usuarios_FK', 'ID_Tarea_FK');
    }

    /**
     * Definir relación many-to-many con Proyecto
     */
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'roles_proyectos', 'user_id', 'ID_Proyecto_FK')
            ->withPivot('ID_Rol_FK')
            ->withTimestamps();
    }

    /**
     * Definir relación many-to-many con Rol (si se necesita acceder a los roles directamente)
     */
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'roles_proyectos', 'user_id', 'ID_Rol_FK')
            ->withTimestamps();
    }

    // Relación con proyectos donde el usuario es administrador
    public function proyectosAdministrados()
    {
        return $this->belongsToMany(Proyecto::class, 'roles_proyectos', 'user_id', 'ID_Proyecto_FK')
            ->wherePivot('ID_Rol_FK', 1);
    }

    public function proyectosMiembro()
    {
        return $this->belongsToMany(Proyecto::class, 'roles_proyectos', 'user_id', 'ID_Proyecto_FK')
            ->wherePivot('ID_Rol_FK', '!=', 1);
    }
    
}
