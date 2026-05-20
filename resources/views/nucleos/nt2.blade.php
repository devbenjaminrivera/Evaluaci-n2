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

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Middleware</h3>
            <p class="mb-4">
                El Middleware actúa como un filtro o capa intermedia que intercepta las peticiones HTTP <strong>antes</strong> de que lleguen al controlador (o las respuestas antes de que salgan). Es ideal para tareas transversales como autenticación, autorización, logging o verificación de roles.
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
                <li>Laravel incluye middlewares integrados como <code>auth</code> (verifica sesión activa) y <code>verified</code> (verifica email).</li>
                <li>Se puede crear middleware personalizado con: <code>php artisan make:middleware NombreMiddleware</code></li>
                <li>Se aplica directamente en la definición de la ruta con el método <code>->middleware('nombre')</code>.</li>
                <li>También se puede aplicar a grupos de rutas enteros con <code>Route::middleware([...])->group(...)</code>.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Definición en routes/web.php</h3>
                <pre><code class="language-php rounded-md shadow-sm">
use App\Http\Controllers\RutasControlador;

// Ruta GET para mostrar el formulario
Route::get('/rutas-y-controladores', [RutasControlador::class, 'index'])
    -&gt;name('nt2.index');

// Ruta POST para procesar el formulario
Route::post('/rutas-y-controladores/calcular', [RutasControlador::class, 'calcularPasaje'])
    -&gt;name('nt2.calcular');

// Ruta protegida por Middleware de autenticación
Route::get('/panel', [RutasControlador::class, 'panel'])
    -&gt;middleware('auth')
    -&gt;name('panel');
                </code></pre>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Método en el Controlador</h3>
                <pre><code class="language-php rounded-md shadow-sm">
public function calcularPasaje(Request $request) {
    $tipo = $request-&gt;input('tipo_boleto');
    $precioBase = 3500;
    
    if ($tipo === 'estudiante') {
        $total = $precioBase - ($precioBase * 0.40);
    } else {
        $total = $precioBase;
    }
    
    return redirect()-&gt;route('nt2.index')
        -&gt;with('resultado_pasaje', "Total: $" . $total);
}
                </code></pre>
            </div>
        </div>
    </div>

    <hr class="my-8 border-gray-300">

    {{-- SECCIÓN MIDDLEWARE --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Middleware: Concepto y Aplicación</h3>
            <p class="mb-4">
                Cuando una petición llega al servidor, el ciclo en Laravel es:
            </p>
            <div class="flex items-center gap-2 text-sm font-mono bg-slate-100 p-3 rounded mb-4 flex-wrap">
                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">Request</span>
                <span class="text-gray-400">→</span>
                <span class="bg-amber-200 text-amber-800 px-2 py-1 rounded">Middleware</span>
                <span class="text-gray-400">→</span>
                <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Controlador</span>
                <span class="text-gray-400">→</span>
                <span class="bg-purple-200 text-purple-800 px-2 py-1 rounded">Vista</span>
                <span class="text-gray-400">→</span>
                <span class="bg-amber-200 text-amber-800 px-2 py-1 rounded">Middleware</span>
                <span class="text-gray-400">→</span>
                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">Response</span>
            </div>
            <p class="mb-3 text-sm">
                El middleware puede <strong>dejar pasar</strong> la petición (llamando a <code>$next($request)</code>),
                <strong>redirigir</strong> a otra ruta, o <strong>abortar</strong> con un error HTTP.
            </p>
            <p class="text-sm bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded-r text-gray-700">
                <strong>Ejemplo real:</strong> El middleware <code>auth</code> de Laravel verifica si el usuario tiene una sesión activa. Si no la tiene, redirige automáticamente al login en lugar de ejecutar el controlador.
            </p>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Crear Middleware personalizado con Artisan</p>
                <pre><code class="language-bash rounded-md">
# Genera el archivo en app/Http/Middleware/
php artisan make:middleware VerificarAcceso
                </code></pre>
            </div>

            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; app/Http/Middleware/VerificarAcceso.php</p>
                <pre><code class="language-php rounded-md">
&lt;?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarAcceso
{
    public function handle(Request $request, Closure $next)
    {
        // Condición: si el parámetro 'clave' no es correcto, redirige
        if ($request-&gt;input('clave') !== 'unach2026') {
            return redirect('/')->with('error', 'Acceso denegado.');
        }

        // Si pasa la verificación, continúa hacia el controlador
        return $next($request);
    }
}
                </code></pre>
            </div>

            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Aplicar en routes/web.php</p>
                <pre><code class="language-php rounded-md">
// Aplicar a una ruta individual
Route::get('/zona-restringida', function () {
    return view('restringida');
})-&gt;middleware(VerificarAcceso::class);

// Aplicar a un grupo de rutas
Route::middleware([VerificarAcceso::class])-&gt;group(function () {
    Route::get('/admin', [AdminControlador::class, 'index']);
    Route::get('/reportes', [AdminControlador::class, 'reportes']);
});
                </code></pre>
            </div>
        </div>
    </div>

    <hr class="my-8 border-gray-300">

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
        <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional</h3>
        <p class="text-blue-900 mb-4">
            Simulador interactivo de tarifas de transporte: Envía una petición <code>POST</code> mediante un formulario hacia el método del controlador, procesa la respuesta y vuelve con los datos usando sesiones flash (<code>with()</code>).
        </p>
        
        <div id="practica-nt2" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 max-w-md">
            <form action="{{ route('nt2.calcular') }}" method="POST" class="space-y-4">
                @csrf
                <div>
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
