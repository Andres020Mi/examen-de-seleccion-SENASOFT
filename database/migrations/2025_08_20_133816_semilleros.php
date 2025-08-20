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
        // Semilleros de investigacion de aca salen los proyectos
        Schema::create('semilleros', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });


        // Proyectos de semilleros de investigacion
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer("fase");
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // lider del proyecto
            $table->foreignId('semillero_id')->constrained('semilleros')->cascadeOnDelete();
            $table->timestamps();
        });


        // Integrandes de los proyectos
        Schema::create('integrantes', function (Blueprint $table) {
            $table->id();

            // el integrante (usuario)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // el proyecto al que pertenece
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnDelete();

            $table->timestamps();
        });



        // trabajos realizados en un proyecto
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();

            // usuario que hizo el trabajo (usuario)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnDelete();
            // descripcion del trabajo
            $table->string("descripcion");

            $table->timestamps();
        });


  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
