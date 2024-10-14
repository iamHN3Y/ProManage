<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Poblar la tabla 'estados' con datos iniciales
        DB::table('estados')->insert([
            ['ID_Estado' => 1, 'Descripcion' => 'Pendiente'],
            ['ID_Estado' => 2, 'Descripcion' => 'En Progreso'],
            ['ID_Estado' => 3, 'Descripcion' => 'Completada'],
            ['ID_Estado' => 4, 'Descripcion' => 'Cancelada'],
            ['ID_Estado' => 5, 'Descripcion' => 'Postergada'],
        ]);
    }
}
