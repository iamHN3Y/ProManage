<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $table = 'informes';

    protected $fillable = ['ID_Proyecto_FK', 'Ruta_Informe'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ID_Proyecto_FK');
    }
}
