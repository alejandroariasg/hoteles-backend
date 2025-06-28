<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoHabitacion;

class TipoHabitacionController extends Controller {
    /**
     * Mostrar una lista de tipos de habitación.
     * Esta función devuelve una lista de todos los tipos de habitación disponibles en formato JSON.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $tipos = TipoHabitacion::all(['id', 'nombre']);
        return response()->json($tipos);
    }

    /**
     * Mostrar las acomodaciones de un tipo de habitación específico.
     * Esta función recibe el ID de un tipo de habitación y devuelve una lista de sus acomodaciones
     * en formato JSON.
     * @param int $tipoHabitacionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAcomodaciones($tipoHabitacionId) {
        
        $tipoHabitacion = TipoHabitacion::find($tipoHabitacionId);

        if (!$tipoHabitacion) {
            return response()->json(['error' => 'Tipo de habitación no encontrado'], 404);
        }

        // Asumiendo que tu relación en el modelo TipoHabitacion está definida como:
        // public function acomodaciones() { return $this->belongsToMany(Acomodacion::class, 'tipo_habitacion_acomodacion'); }

        $acomodaciones = $tipoHabitacion->acomodaciones()->get(['acomodacions.id', 'acomodacions.nombre']);

        return response()->json($acomodaciones);
    }
}
