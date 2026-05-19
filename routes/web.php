<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutasControlador;
use App\Http\Controllers\BladeControlador;

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

Route::get('/eloquent-orm', function () {
    return view('nucleos.nt4');
})->name('nt4.index');

Route::get('/formularios-validaciones', function () {
    return view('nucleos.nt5');
})->name('nt5.index');