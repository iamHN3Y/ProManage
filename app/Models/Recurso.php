<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recursos';

    protected $fillable = ['ID_Tarea_FK', 'Tipo_Recurso', 'Descripcion', 'Disponibilidad'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'ID_Tarea_FK');
    }
}
