<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';

    protected $fillable = ['Nombre_Departamento'];

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'ID_Departamento_FK');
    }
}
