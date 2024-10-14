<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('ID_Tarea');
            $table->unsignedInteger('ID_Proyecto_FK');
            $table->foreign('ID_Proyecto_FK')->references('ID_Proyecto')->on('proyectos')->onDelete('cascade');
            $table->string('Nombre_Tarea', 255);
            $table->text('Descripcion')->nullable();
            $table->date('Fecha_Inicio')->nullable();
            $table->date('Fecha_Termino')->nullable();
            $table->unsignedTinyInteger('ID_Estado_FK');
            $table->foreign('ID_Estado_FK')->references('ID_Estado')->on('estados');
            $table->unsignedInteger('ID_Departamento_FK')->nullable();
            $table->foreign('ID_Departamento_FK')->references('ID_Departamento')->on('departamentos');
            $table->unsignedInteger('ID_TareaPadre_FK')->nullable(); // Permitir nulo
            $table->foreign('ID_TareaPadre_FK')->references('ID_Tarea')->on('tareas')->onDelete('set null'); // Manejo de eliminación
            $table->boolean('Nivel')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
