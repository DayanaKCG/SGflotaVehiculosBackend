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
        Schema::create('registros_viajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->nullable()->references('id')->on('vehiculos');
            $table->foreignId('conductor_id')->nullable()->references('id')->on('conductores');
            $table->foreignId('ruta_id')->nullable()->references('id')->on('rutas');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('kilometraje');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_viajes');
    }
};
