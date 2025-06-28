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
        Schema::create('habitacions', function (Blueprint $table) {
             $table->id();

            // Relaciones
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('tipo_habitacion_id')->constrained('tipo_habitacions')->onDelete('cascade');
            $table->foreignId('acomodacion_id')->constrained('acomodacions')->onDelete('cascade');

            // Cantidad de habitaciones para esta combinación
            $table->unsignedInteger('cantidad');

            // Restricción: no repetir combinación hotel + tipo + acomodación
            $table->unique(['hotel_id', 'tipo_habitacion_id', 'acomodacion_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacions');
    }
};
