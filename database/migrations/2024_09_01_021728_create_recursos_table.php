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
        Schema::create('recursos', function (Blueprint $table) {
            $table->increments('ID_Recurso');
            $table->unsignedInteger('ID_Tarea_FK');
            $table->foreign('ID_Tarea_FK')->references('ID_Tarea')->on('tareas')->onDelete('cascade');
            $table->string('Tipo_Recurso', 255);
            $table->text('Descripcion')->nullable();
            $table->boolean('Disponibilidad')->default(true);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};
