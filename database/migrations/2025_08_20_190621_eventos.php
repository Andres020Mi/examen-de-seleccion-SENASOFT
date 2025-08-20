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
      Schema::create('eventos', function (Blueprint $table) {
    $table->id();

   

    // Campos del evento
    $table->date('fecha');            // fecha del evento
    $table->string('nombre');         // título/nombre del evento
    $table->text('descripcion');      // detalle del evento

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
