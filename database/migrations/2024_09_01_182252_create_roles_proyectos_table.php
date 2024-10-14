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
        Schema::create('roles_proyectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('ID_Proyecto_FK');
            $table->unsignedTinyInteger('ID_Rol_FK');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ID_Proyecto_FK')->references('ID_Proyecto')->on('proyectos')->onDelete('cascade');
            $table->foreign('ID_Rol_FK')->references('ID_Rol')->on('roles')->onDelete('cascade');
        
            $table->unique(['user_id', 'ID_Proyecto_FK', 'ID_Rol_FK']);
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_proyectos');
    }
};
