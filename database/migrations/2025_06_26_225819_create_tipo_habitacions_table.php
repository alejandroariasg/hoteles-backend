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
        Schema::create('tipo_habitacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Estándar, Junior, Suite
            $table->timestamps();
        });

        // Valores default iniciales
        DB::table('tipo_habitacions')->insert([
            ['nombre' => 'Estándar'],
            ['nombre' => 'Junior'],
            ['nombre' => 'Suite'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_habitacions');
    }
};
