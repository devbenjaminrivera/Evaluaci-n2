<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo; // Importamos el modelo

class RegistroEquipoControlador extends Controller
{
    // Renderiza la vista del NT5
    public function index()
    {
        return view('nucleos.nt5');
    }

    // Procesa el formulario, valida y guarda en la base de datos
    public function store(Request $request)
    {
        // 1. Validaciones estrictas de Laravel
        $request->validate([
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:100',
            'diagnostico' => 'nullable|string|max:255',
            'estado' => 'required|in:Operativo,En Taller,Pendiente'
        ], [
            // Mensajes personalizados en español
            'marca.required' => 'Debes ingresar la marca del equipo.',
            'modelo.required' => 'El modelo es obligatorio para el registro.',
            'estado.in' => 'El estado seleccionado no es válido.'
        ]);

        // 2. Persistencia en la Base de Datos
        $equipo = new Equipo();
        $equipo->marca = $request->marca;
        $equipo->modelo = $request->modelo;
        $equipo->diagnostico = $request->diagnostico;
        $equipo->estado = $request->estado;
        $equipo->save();

        // 3. Redirección con mensaje de éxito (Sesión Flash)
        return redirect()->route('nt5.index')->with('exito', '¡Equipo registrado y guardado en la base de datos correctamente!');
    }
}