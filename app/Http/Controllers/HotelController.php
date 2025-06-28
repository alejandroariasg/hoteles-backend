<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreHotelRequest;

//use Illuminate\Http\Request;

class HotelController extends Controller {
    /**
     * Mostrar una lista de hoteles.
     * Esta función devuelve una lista de todos los hoteles disponibles en formato JSON.
     * @return JsonResponse
     */
    public function index(){
        $hoteles = Hotel::all();
        return response()->json($hoteles);
    }

    /**
     * Crear un nuevo hotel.
     * Esta función recibe una solicitud para crear un nuevo hotel
     * y almacena los datos en la base de datos.
     * Los datos deben ser validados por el StoreHotelRequest.
     * @param StoreHotelRequest $request
     * @return JsonResponse
     */
    public function store(StoreHotelRequest $request) {
        $hotel = Hotel::create($request->validated());

        return response()->json([
            'message' => 'Hotel creado exitosamente',
            'data' => $hotel
        ], 201);
    }

    /**
     * Mostrar las habitaciones de un hotel específico.
     * Esta función recibe el ID de un hotel y devuelve una lista de sus habitaciones
     * en formato JSON, incluyendo el nombre del tipo de habitación y la acomodación.
     * @param int $id
     * @return JsonResponse
     */
    public function habitaciones($id) {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        $habitaciones = $hotel->habitaciones()->with(['tipoHabitacion', 'acomodacion'])->get();

        // Transformar la respuesta para frontend
        $resultado = $habitaciones->map(function($h){
            return [
                'id' => $h->id,
                'tipo_habitacion_nombre' => $h->tipoHabitacion->nombre,
                'acomodacion_nombre' => $h->acomodacion->nombre,
                'cantidad' => $h->cantidad,
            ];
        });

        return response()->json($resultado);
    }
    /**
     * Mostrar un hotel específico.
     * Esta función recibe el ID de un hotel y devuelve sus detalles en formato JSON.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id) {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        return response()->json($hotel);
    }
}
