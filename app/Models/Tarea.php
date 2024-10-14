<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'ID_Tarea';

    protected $fillable = [
        'ID_Proyecto_FK',
        'Nombre_Tarea',
        'Descripcion',
        'Fecha_Inicio',
        'Fecha_Termino',
        'ID_Estado_FK',
        'ID_Departamento_FK',
        'ID_TareaPadre_FK',
        'Nivel'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ID_Proyecto_FK');
    }

    // Relación con el modelo Estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'ID_Estado_FK', 'ID_Estado');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'ID_Departamento_FK');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'Usuarios_Tareas', 'ID_Tarea_FK', 'ID_Usuarios_FK');
    }

    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'ID_Tarea_FK');
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class, 'ID_Tarea_FK');
    }

    public function calendarios()
    {
        return $this->hasMany(Calendario::class, 'ID_Tarea_FK');
    }

    public function tareaPadre()
    {
        return $this->belongsTo(Tarea::class, 'ID_TareaPadre_FK');
    }
}
