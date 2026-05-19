@extends('layouts.app')

@section('title', 'NT3: Motor de Plantillas Blade')

@section('header', 'Núcleo Temático 3: Motor de Plantillas Blade')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">¿Qué es Blade y cómo funciona?</h3>
            <p class="mb-4">
                Blade es el motor de plantillas simple pero potente que incluye Laravel. A diferencia de otros motores de plantillas de PHP, Blade no te impide usar código PHP puro en tus vistas. De hecho, todas las vistas de Blade se compilan en código PHP puro y se almacenan en caché hasta que se modifican, lo que significa que Blade añade cero sobrecarga a tu aplicación.
            </p>
            <p class="mb-4">
                Los archivos de vista de Blade utilizan la extensión de archivo <code>.blade.php</code> y se almacenan de forma predeterminada en el directorio <code>resources/views</code>.
            </p>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Directivas y Estructuras de Control</h3>
            <p class="mb-4">
                Blade proporciona atajos convenientes para las estructuras de control comunes de PHP, como declaraciones condicionales y bucles:
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2">
                <li><code>&#123;&#123; $variable &#125;&#125;</code>: Muestra el contenido de una variable aplicando automáticamente filtros de escape HTML para prevenir ataques XSS.</li>
                <li><code>@if / @else / @endif</code>: Permite ejecutar condicionales directamente en la estructura visual.</li>
                <li><code>@foreach / @endforeach</code>: Ideal para iterar colecciones o arreglos de datos enviados desde el controlador.</li>
                <li><strong>La variable <code>$loop</code>:</strong> Dentro de un bucle <code>@foreach</code>, Laravel crea automáticamente esta variable mágica, permitiéndote acceder a propiedades útiles como <code>$loop->first</code>, <code>$loop->last</code>, <code>$loop->iteration</code> o <code>$loop->even</code>.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Uso de Directivas en la Vista</h3>
            <pre><code class="language-html rounded-md shadow-sm">
&lt;!-- Iteración de datos con Blade --&gt;
@foreach($asignaturas as $asignatura)
    <tr class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }} hover:bg-blue-50 transition duration-150">
        <td class="p-3 font-mono font-semibold text-gray-500">
            {{ $loop->iteration }}
        </td>
        <td class="p-3 font-mono text-gray-600">{{ $asignatura['codigo'] }}</td>
        <td class="p-3 font-medium text-gray-900">{{ $asignatura['nombre'] }}</td>
        <td class="p-3">
            @if($asignatura['obligatorio'])
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Malla Obligatoria
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    Electivo
                </span>
            @endif
        </td>
        <td class="p-3">
            <span class="text-blue-600 font-semibold">● {{ $asignatura['estado'] }}</span>
        </td>
    </tr>
@endforeach
            </code></pre>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-4">Inyección desde el Controlador</h3>
            <pre><code class="language-php rounded-md shadow-sm">
public function index() {
    $asignaturas = [
        ['nombre' => 'Laravel', 'obligatorio' => true],
        ['nombre' => 'Optativa I', 'obligatorio' => false],
    ];
    
    return view('nucleos.nt3', compact('asignaturas'));
}
            </code></pre>
        </div>
    </div>

   <hr class="my-10 border-gray-300">

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
        <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional</h3>
        <p class="text-blue-900 mb-4">
            Renderizado dinámico de una colección de datos mediante directivas Blade. Se utiliza <code>@foreach</code> para el listado, condicionales <code>@if</code> para evaluar el tipo de asignatura y propiedades de <code>$loop</code> para pintar filas alternadas y destacar los límites de la tabla.
        </p>
        
        <div id="practica-nt3" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800 text-white text-sm uppercase">
                        <th class="p-3 rounded-l">N° (#loop)</th>
                        <th class="p-3">Código</th>
                        <th class="p-3">Asignatura</th>
                        <th class="p-3">Tipo</th>
                        <th class="p-3 rounded-r">Estado actual</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-200">
                    @foreach($asignaturas as $asignatura)
                        <tr class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }} hover:bg-blue-50 transition duration-150">
                            <td class="p-3 font-mono font-semibold text-gray-500">
                                {{ $loop->iteration }} 
                                @if($loop->first)
                                    <span class="ml-1 text-xs bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded">Inicio</span>
                                @endif
                                @if($loop->last)
                                    <span class="ml-1 text-xs bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded">Fin</span>
                                @endif
                            </td>
                            <td class="p-3 font-mono text-gray-600">{{ $asignatura['codigo'] }}</td>
                            <td class="p-3 font-medium text-gray-900">{{ $asignatura['nombre'] }}</td>
                            <td class="p-3">
                                @if($asignatura['obligatorio'])
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Malla Obligatoria
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Electivo
                                    </span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if($asignatura['estado'] === 'Aprobado')
                                    <span class="text-emerald-600 font-semibold">✓ {{ $asignatura['estado'] }}</span>
                                @elseif($asignatura['estado'] === 'En curso')
                                    <span class="text-blue-600 font-semibold animate-pulse">● {{ $asignatura['estado'] }}</span>
                                @else
                                    <span class="text-gray-400">{{ $asignatura['estado'] }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection