<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\TipoHabitacionController;


// Registro de Hoteles
Route::post('/hoteles', [HotelController::class, 'store']);

//Obtener lista de Hoteles
Route::get('/hoteles', [HotelController::class, 'index']);

// Obtener un hotel específico
Route::get('/hoteles/{id}', [HotelController::class, 'show']);

// Registro de Habitaciones
Route::post('/habitaciones', [HabitacionController::class, 'store']);

// Obtener lista de Habitaciones
Route::get('/tipos-habitacion', [TipoHabitacionController::class, 'index']);

// Obtener acomodaciones permitidas para un tipo de habitación
Route::get('/tipo-habitacion/{id}/acomodaciones', [TipoHabitacionController::class, 'getAcomodaciones']);

// Obtener habitaciones de un hotel específico
Route::get('/hotels/{id}/habitaciones', [HotelController::class, 'habitaciones']);
