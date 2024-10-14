<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = ['Descripcion'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'roles_proyectos', 'ID_Rol_FK', 'user_id');
    }
}
