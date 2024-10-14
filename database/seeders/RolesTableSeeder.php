<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['ID_Rol' => 1, 'Descripcion' => 'Administrador'],
            ['ID_Rol' => 2, 'Descripcion' => 'Miembro'],
            // Otros roles si los necesitas
        ]);
    }
}
