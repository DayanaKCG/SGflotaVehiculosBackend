<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\conductoresController;
use App\Http\Controllers\api\rutasController;
use App\Http\Controllers\api\vehiculosController;
use App\Http\Controllers\api\mantenimientosController;
use App\Http\Controllers\api\registros_viajesController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/conductores', [conductoresController::class,'index'])->name('conductores');
Route::post('/conductores', [conductoresController::class,'store'])->name('conductores.store');
Route::delete('/conductores/{conductor}', [conductoresController::class,'destroy'])->name('conductores.destroy');
Route::get('/conductores/{conductor}', [conductoresController::class,'show'])->name('conductores.show');
Route::put('/conductores/{conductor}', [conductoresController::class,'update'])->name('conductores.update');

Route::get('/rutas', [rutasController::class,'index'])->name('rutas');
Route::post('/rutas', [rutasController::class,'store'])->name('rutas.store');
Route::delete('/rutas/{ruta}', [rutasController::class,'destroy'])->name('rutas.destroy');
Route::get('/rutas/{ruta}', [rutasController::class,'show'])->name('rutas.show');
Route::put('/rutas/{ruta}', [rutasController::class,'update'])->name('rutas.update');

Route::get('/vehiculos', [vehiculosController::class,'index'])->name('vehiculos');
Route::post('/vehiculos', [vehiculosController::class,'store'])->name('vehiculos.store');
Route::delete('/vehiculos/{vehiculo}', [vehiculosController::class,'destroy'])->name('vehiculos.destroy');
Route::get('/vehiculos/{vehiculo}', [vehiculosController::class,'show'])->name('vehiculos.show');
Route::put('/vehiculos/{vehiculo}', [vehiculosController::class,'update'])->name('vehiculos.update');

Route::get('/mantenimientos', [mantenimientosController::class,'index'])->name('mantenimientos');
Route::post('/mantenimientos', [mantenimientosController::class,'store'])->name('mantenimientos.store');
Route::delete('/mantenimientos/{mantenimiento}', [mantenimientosController::class,'destroy'])->name('mantenimientos.destroy');
Route::get('/mantenimientos/{mantenimiento}', [mantenimientosController::class,'show'])->name('mantenimientos.show');
Route::put('/mantenimientos/{mantenimiento}', [mantenimientosController::class,'update'])->name('mantenimientos.update');


Route::get('/registros_viajes', [registros_viajesController::class,'index'])->name('registros_viajes');
Route::post('/registros_viajes', [registros_viajesController::class,'store'])->name('registros_viajes.store');
Route::delete('/registros_viajes/{registros_viaje}', [registros_viajesController::class,'destroy'])->name('registros_viajes.destroy');
Route::get('/registros_viajes/{registros_viaje}', [registros_viajesController::class,'show'])->name('registros_viajes.show');
Route::put('/registros_viajes/{registros_viaje}', [registros_viajesController::class,'update'])->name('registros_viajes.update');
