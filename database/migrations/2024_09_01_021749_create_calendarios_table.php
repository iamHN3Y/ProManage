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
        Schema::create('calendarios', function (Blueprint $table) {
            $table->increments('ID_Calendario');
            $table->unsignedInteger('ID_Tarea_FK');
            $table->foreign('ID_Tarea_FK')->references('ID_Tarea')->on('tareas')->onDelete('cascade');
            $table->string('Nombre_Evento', 255);
            $table->date('Fecha_Evento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios');
    }
};
