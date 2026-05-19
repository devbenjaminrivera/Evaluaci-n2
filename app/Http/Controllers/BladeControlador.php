<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BladeControlador extends Controller
{
    public function index()
    {
        // Simulación de datos dinámicos (Colección de asignaturas)
        $asignaturas = [
            [
                'nombre' => 'Desarrollo Web con Laravel',
                'codigo' => 'INF-711',
                'obligatorio' => true,
                'estado' => 'En curso'
            ],
            [
                'nombre' => 'Ondas y Ópticas',
                'codigo' => 'FIS-322',
                'obligatorio' => true,
                'estado' => 'En curso'
            ],
            [
                'nombre' => 'Electromagnetismo',
                'codigo' => 'FIS-311',
                'obligatorio' => true,
                'estado' => 'Aprobado'
            ],
            [
                'nombre' => 'Taller de Videojuegos Avanzado',
                'codigo' => 'INF-824',
                'obligatorio' => false,
                'estado' => 'Pendiente'
            ]
        ];

        // Pasamos la variable a la vista usando el helper compact()
        return view('nucleos.nt3', compact('asignaturas'));
    }
}