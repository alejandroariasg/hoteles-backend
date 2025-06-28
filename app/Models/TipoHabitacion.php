<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model {
    
    protected $fillable = ['nombre'];

    public function acomodaciones() {
        return $this->belongsToMany(Acomodacion::class, 'tipo_habitacion_acomodacion');
    }
}
