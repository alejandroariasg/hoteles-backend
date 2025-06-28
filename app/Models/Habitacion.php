<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model {
    protected $fillable = [
        'hotel_id',
        'tipo_habitacion_id',
        'acomodacion_id',
        'cantidad'
    ];

    // Define las relaciones con los modelos Hotel, TipoHabitacion y Acomodacion
    public function tipoHabitacion() {
        return $this->belongsTo(TipoHabitacion::class);
    }

    public function acomodacion() {
        return $this->belongsTo(Acomodacion::class);
    }
}
