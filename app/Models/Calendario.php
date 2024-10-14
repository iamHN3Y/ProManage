<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';

    protected $fillable = ['ID_Tarea_FK', 'Nombre_Evento', 'Fecha_Evento'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'ID_Tarea_FK');
    }
}
