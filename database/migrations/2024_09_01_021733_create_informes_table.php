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
        Schema::create('informes', function (Blueprint $table) {
            $table->increments('ID_Informe');
            $table->unsignedInteger('ID_Proyecto_FK');
            $table->foreign('ID_Proyecto_FK')->references('ID_Proyecto')->on('proyectos')->onDelete('cascade');
            $table->string('Ruta_Informe', 255);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
