<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutasControlador;
use App\Http\Controllers\BladeControlador;
use App\Http\Controllers\EloquentControlador;
use App\Http\Controllers\RegistroEquipoControlador;

// Redirigir la raíz del sitio al Núcleo 1 por defecto
Route::get('/', function () {
    return redirect()->route('nt1.index');
});

Route::get('/introduccion', function () {
    return view('nucleos.nt1');
})->name('nt1.index');

Route::get('/rutas-y-controladores', [RutasControlador::class, 'index'])
    ->name('nt2.index');

// Ruta POST para procesar el formulario interactivo del simulador de pasajes
Route::post('/rutas-y-controladores/calcular', [RutasControlador::class, 'calcularPasaje'])
    ->name('nt2.calcular');

Route::get('/vistas-blade', [BladeControlador::class, 'index'])
    ->name('nt3.index');

Route::get('/eloquent-orm', [EloquentControlador::class, 'index'])
    ->name('nt4.index');

Route::get('/formularios-validaciones', [RegistroEquipoControlador::class, 'index'])->name('nt5.index');
Route::post('/formularios-validaciones/guardar', [RegistroEquipoControlador::class, 'store'])->name('nt5.guardar');