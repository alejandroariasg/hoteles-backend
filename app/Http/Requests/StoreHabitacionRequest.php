<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Hotel;
use App\Models\TipoHabitacion;
use App\Models\Acomodacion;
use App\Models\TipoHabitacionAcomodacion;
use App\Models\Habitacion;

class StoreHabitacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotel_id' => ['required', 'exists:hotels,id'],
            'tipo_habitacion_id' => ['required', 'exists:tipo_habitacions,id'],
            'acomodacion_id' => ['required', 'exists:acomodacions,id'],
            'cantidad' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hotelId = $this->hotel_id;
            $tipoId = $this->tipo_habitacion_id;
            $acomodacionId = $this->acomodacion_id;
            $cantidad = $this->cantidad;

            // 1. Validar que no exista la misma combinación para el hotel
            $existe = Habitacion::where([
                'hotel_id' => $hotelId,
                'tipo_habitacion_id' => $tipoId,
                'acomodacion_id' => $acomodacionId
            ])->exists();

            if ($existe) {
                $validator->errors()->add('combinación', 'Ya existe esta configuración de habitación para el hotel.');
            }

            // 2. Validar que la combinación tipo+acomodación sea válida
            $permitida = TipoHabitacionAcomodacion::where([
                'tipo_habitacion_id' => $tipoId,
                'acomodacion_id' => $acomodacionId
            ])->exists();

            if (!$permitida) {
                $validator->errors()->add('relación', 'La acomodación no es válida para este tipo de habitación.');
            }

            // 3. Validar que no se exceda el número máximo de habitaciones del hotel
            $hotel = Hotel::find($hotelId);
            $actual = Habitacion::where('hotel_id', $hotelId)->sum('cantidad');

            if (($actual + $cantidad) > $hotel->numero_habitaciones) {
                $validator->errors()->add('cantidad', 'La cantidad supera el límite de habitaciones del hotel.');
            }
        });
    }
}
