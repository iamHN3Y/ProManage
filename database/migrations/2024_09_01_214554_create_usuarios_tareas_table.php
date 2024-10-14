<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Usuarios_Tareas', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Usuarios_FK'); // Para coincidir con usuarios.id (bigint unsigned)
            $table->unsignedInteger('ID_Tarea_FK'); // Para coincidir con tareas.ID_Tarea (int unsigned)

            // Definir claves foráneas
            $table->foreign('ID_Usuarios_FK')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ID_Tarea_FK')->references('ID_Tarea')->on('tareas')->onDelete('cascade');

            // Evitar duplicados
            $table->primary(['ID_Usuarios_FK', 'ID_Tarea_FK']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuarios_Tareas');
    }
};
