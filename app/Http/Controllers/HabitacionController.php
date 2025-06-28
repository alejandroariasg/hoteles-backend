<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Habitacion;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreHabitacionRequest;

class HabitacionController extends Controller {
    /**
     * Creación de una nueva habitación.
     * Esta función recibe una solicitud para crear una nueva habitación
     * y almacena los datos en la base de datos.
     * Los datos deben ser validados por el StoreHabitacionRequest.
     * @return JsonResponse
     */
    public function store(StoreHabitacionRequest $request): JsonResponse {
        $habitacion = Habitacion::create($request->validated());
        return response()->json([
            'message' => 'Habitación creada exitosamente',
            'data' => $habitacion
        ], 201);
    }
}
