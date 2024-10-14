<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';

    protected $fillable = ['ID_Tarea_FK', 'Ruta_Archivo'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'ID_Tarea_FK');
    }
}
