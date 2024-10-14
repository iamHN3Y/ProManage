<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'ID_Estado';

    protected $fillable = ['Descripcion'];

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'ID_Estado_FK');
    }
}
