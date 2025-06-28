<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacionAcomodacion extends Model {
    protected $table = 'tipo_habitacion_acomodacion'; // 
    protected $fillable = ['tipo_habitacion_id', 'acomodacion_id'];
}
