@extends('layouts.app')

@section('title', 'NT2: Rutas y Controladores')

@section('header', 'Núcleo Temático 2: Rutas y Controladores')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Sistema de Enrutamiento</h3>
            <p class="mb-4">
                En Laravel, las rutas son las encargadas de registrar las URLs de la aplicación y asociarlas a una acción específica. Se definen principalmente en el archivo <code>routes/web.php</code> para interfaces web tradicionales.
            </p>
            <p class="mb-4">
                Soportan múltiples métodos HTTP (<code>GET</code>, <code>POST</code>, <code>PUT</code>, <code>DELETE</code>) y permiten definir parámetros dinámicos directos en la URL utilizando llaves (ej: <code>/usuario/{id}</code>).
            </p>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">¿Qué es un Controlador?</h3>
            <p class="mb-4">
                Los controladores pertenecen a la capa intermedia del patrón MVC. En lugar de procesar toda la lógica de negocio directamente en los archivos de rutas mediante funciones anónimas, delegamos esa responsabilidad a métodos dentro de clases Controlador.
            </p>
            <p class="mb-4">
                Esto mantiene el código limpio, escalable, organizado y facilita la reutilización de métodos y la inyección de dependencias (como el objeto <code>Request</code>).
            </p>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Definición en routes/web.php</h3>
            <pre><code class="language-php rounded-md shadow-sm">
use App\Http\Controllers\RutasControlador;

// Ruta GET para mostrar el formulario
Route::get('/rutas-y-controladores', [RutasControlador::class, 'index'])
    ->name('nt2.index');

// Ruta POST para procesar el formulario
Route::post('/rutas-y-controladores/calcular', [RutasControlador::class, 'calcularPasaje'])
    ->name('nt2.calcular');
            </code></pre>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-4">Método en el Controlador</h3>
            <pre><code class="language-php rounded-md shadow-sm">
public function calcularPasaje(Request $request) {
    $tipo = $request->input('tipo_boleto');
    $precioBase = 3500;
    
    if ($tipo === 'estudiante') {
        $total = $precioBase - ($precioBase * 0.40);
    } else {
        $total = $precioBase;
    }
    
    return redirect()->route('nt2.index')
        ->with('resultado_pasaje', "Total: $" . $total);
}
            </code></pre>
        </div>
    </div>

    <hr class="my-10 border-gray-300">

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
        <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional</h3>
        <p class="text-blue-900 mb-4">
            Simulador interactivo de tarifas de transporte: Envía una petición <code>POST</code> mediante un formulario hacia el método del controlador, procesa la respuesta y vuelve con los datos usando sesiones flash (<code>with()</code>).
        </p>
        
        <div id="practica-nt2" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 max-w-md">
            <form action="{{ route('nt2.calcular') }}" method="POST" class="space-y-4">
                @csrf <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Selecciona el tipo de Pasajero:</label>
                    <select name="tipo_boleto" class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="adulto">Adulto General ($3.500)</option>
                        <option value="estudiante">Estudiante con TNE (40% Desc.)</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Enviar Petición POST al Controlador
                </button>
            </form>

            @if(session('resultado_pasaje'))
                <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-r text-green-800 font-medium">
                    {{ session('resultado_pasaje') }}
                </div>
            @endif
        </div>
    </div>
@endsection