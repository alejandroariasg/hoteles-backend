<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
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
            'nombre' => 'required|string|unique:hotels,nombre',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'nit' => 'required|string|unique:hotels,nit',
            'numero_habitaciones' => 'required|integer|min:1',
        ];
    }
}
