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
        Schema::create('tipo_habitacion_acomodacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_habitacion_id')->constrained('tipo_habitacions')->onDelete('cascade');
            $table->foreignId('acomodacion_id')->constrained('acomodacions')->onDelete('cascade');
            $table->unique(['tipo_habitacion_id', 'acomodacion_id']);
            $table->timestamps();
        });

        // Obtener IDs por nombre (para insert seguro)
        $tipos = DB::table('tipo_habitacions')->pluck('id', 'nombre');
        $acomodaciones = DB::table('acomodacions')->pluck('id', 'nombre');

        // Valores default iniciales
        DB::table('tipo_habitacion_acomodacion')->insert([
            // Estándar → Sencilla, Doble
            ['tipo_habitacion_id' => $tipos['Estándar'], 'acomodacion_id' => $acomodaciones['Sencilla']],
            ['tipo_habitacion_id' => $tipos['Estándar'], 'acomodacion_id' => $acomodaciones['Doble']],

            // Junior → Triple, Cuádruple
            ['tipo_habitacion_id' => $tipos['Junior'], 'acomodacion_id' => $acomodaciones['Triple']],
            ['tipo_habitacion_id' => $tipos['Junior'], 'acomodacion_id' => $acomodaciones['Cuádruple']],

            // Suite → Sencilla, Doble, Triple
            ['tipo_habitacion_id' => $tipos['Suite'], 'acomodacion_id' => $acomodaciones['Sencilla']],
            ['tipo_habitacion_id' => $tipos['Suite'], 'acomodacion_id' => $acomodaciones['Doble']],
            ['tipo_habitacion_id' => $tipos['Suite'], 'acomodacion_id' => $acomodaciones['Triple']],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_habitacion_acomodacion');
    }
};
