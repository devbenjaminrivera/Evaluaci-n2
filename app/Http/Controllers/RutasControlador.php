<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasControlador extends Controller
{
    // Método para renderizar la página del Núcleo 2
    public function index()
    {
        return view('nucleos.nt2');
    }

    // Método práctico: Simula el cálculo del valor de un pasaje de autobús con descuento de estudiante
    public function calcularPasaje(Request $request)
    {
        // Validar rápidamente que llegue el dato requerido
        $request->validate([
            'tipo_boleto' => 'required|string'
        ]);

        $tipo = $request->input('tipo_boleto');
        $precioBase = 3500; // Tarifa normal Chillán - Concepción, por ejemplo
        $descuento = 0;
        $resultado = "";

        if ($tipo === 'estudiante') {
            $descuento = $precioBase * 0.40; // 40% de descuento TNE
            $total = $precioBase - $descuento;
            $resultado = "Boleto Estudiante (TNE aplicado). Total: $" . number_format($total, 0, ',', '.');
        } else {
            $resultado = "Boleto Adulto General. Total: $" . number_format($precioBase, 0, ',', '.');
        }

        // Devolver a la vista con el resultado de la operación en la sesión
        return redirect()->route('nt2.index')->with('resultado_pasaje', $resultado);
    }
}