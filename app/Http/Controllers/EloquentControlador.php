<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo; // Es obligatorio importar el modelo aquí

class EloquentControlador extends Controller
{
    public function index()
    {
        // Consulta limpia utilizando Eloquent ORM
        $equipos = Equipo::all();
        
        return view('nucleos.nt4', compact('equipos'));
    }
}