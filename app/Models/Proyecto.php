<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    // Especifica la clave primaria personalizada
    protected $primaryKey = 'ID_Proyecto';

    protected $fillable = [
        'Nombre_Proyecto',
        'Descripcion',
        'Fecha_Inicio',
        'Fecha_Termino',
    ];

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'ID_Proyecto_FK');
    }

    public function informes()
    {
        return $this->hasMany(Informe::class, 'ID_Proyecto_FK');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'roles_proyectos', 'ID_Proyecto_FK', 'user_id')
            ->withPivot('ID_Rol_FK')
            ->withTimestamps();
    }
}
