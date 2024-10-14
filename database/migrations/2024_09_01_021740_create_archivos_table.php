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
        Schema::create('archivos', function (Blueprint $table) {
            $table->increments('ID_Archivo');
            $table->unsignedInteger('ID_Tarea_FK');
            $table->foreign('ID_Tarea_FK')->references('ID_Tarea')->on('tareas')->onDelete('cascade');
            $table->string('Ruta_Archivo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
