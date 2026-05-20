@extends('layouts.app')

@section('title', 'NT3: Motor de Plantillas Blade')

@section('header', 'Núcleo Temático 3: Vistas y Blade Templates')

@section('content')

{{-- ================================================================
     BLOQUE 1: ¿QUÉ ES BLADE?
     ================================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">¿Qué es Blade y cómo funciona?</h3>
        <p class="mb-4">
            Blade es el motor de plantillas que incluye Laravel. A diferencia de otros motores, Blade no impide
            usar PHP puro en las vistas. Todas las vistas Blade se compilan en PHP puro y se almacenan en caché,
            por lo que Blade añade <strong>cero sobrecarga</strong> a la aplicación.
        </p>
        <p class="mb-4">
            Los archivos Blade usan la extensión <code class="bg-gray-100 px-1 rounded">.blade.php</code>
            y se guardan por defecto en <code class="bg-gray-100 px-1 rounded">resources/views</code>.
        </p>

        <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Directivas principales</h3>
        <ul class="list-disc pl-5 space-y-2 text-sm">
            <li><code class="bg-gray-100 px-1 rounded">&#123;&#123; $var &#125;&#125;</code> — Imprime con escape HTML automático (previene XSS).</li>
            <li><code class="bg-gray-100 px-1 rounded">&#123;!! $var !!&#125;</code> — Imprime <strong>sin</strong> escapar (usar con cuidado).</li>
            <li><code class="bg-gray-100 px-1 rounded">&#64;if / &#64;elseif / &#64;else / &#64;endif</code> — Condicionales.</li>
            <li><code class="bg-gray-100 px-1 rounded">&#64;foreach / &#64;endforeach</code> — Iteración de colecciones.</li>
            <li><code class="bg-gray-100 px-1 rounded">&#64;extends</code> — Hereda un layout base.</li>
            <li><code class="bg-gray-100 px-1 rounded">&#64;section / &#64;endsection</code> — Define un bloque de contenido.</li>
            <li><code class="bg-gray-100 px-1 rounded">&#64;yield</code> — Reserva el espacio donde se inyecta un <code class="bg-gray-100 px-1 rounded">&#64;section</code>.</li>
            <li><code class="bg-gray-100 px-1 rounded">&#64;include</code> — Incluye una subvista parcial.</li>
        </ul>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
        <h3 class="text-xl font-bold text-gray-800 mb-3">Sintaxis esencial de Blade</h3>
        <pre><code class="language-html rounded-md">&lt;!-- 1. Mostrar variable con escape HTML --&gt;
&lt;p&gt;Hola, &#123;&#123; $nombre &#125;&#125;&lt;/p&gt;

&lt;!-- 2. Condicional --&gt;
&#64;if($activo)
    &lt;span&gt;Usuario activo&lt;/span&gt;
&#64;else
    &lt;span&gt;Usuario inactivo&lt;/span&gt;
&#64;endif

&lt;!-- 3. Bucle foreach --&gt;
&#64;foreach($items as $item)
    &lt;li&gt;&#123;&#123; $loop-&gt;iteration &#125;&#125;. &#123;&#123; $item &#125;&#125;&lt;/li&gt;
&#64;endforeach

&lt;!-- 4. Incluir subvista --&gt;
&#64;include('partials.alerta', ['msg' =&gt; 'OK'])</code></pre>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- ================================================================
     BLOQUE 2: LAYOUTS — &#64;extends, &#64;section, &#64;yield
     ================================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">
            Layouts: <code class="bg-gray-100 px-1 rounded text-lg">&#64;extends</code>,
            <code class="bg-gray-100 px-1 rounded text-lg">&#64;section</code> y
            <code class="bg-gray-100 px-1 rounded text-lg">&#64;yield</code>
        </h3>
        <p class="mb-4">
            El sistema de herencia de Blade permite definir un <strong>layout base</strong> con la estructura HTML
            común (cabecera, sidebar, pie de página) y luego <em>extenderlo</em> en cada vista hija, inyectando
            únicamente el contenido específico de esa sección.
        </p>
        <ul class="list-disc pl-5 space-y-2 text-sm mb-4">
            <li>
                <code class="bg-gray-100 px-1 rounded">&#64;yield('nombre')</code> —
                Va en el <strong>layout</strong>. Reserva un espacio con ese nombre.
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">&#64;extends('layouts.app')</code> —
                Va en la <strong>vista hija</strong>. Declara de qué layout hereda.
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">&#64;section('nombre') ... &#64;endsection</code> —
                En la vista hija, define el contenido que llenará el <code class="bg-gray-100 px-1 rounded">&#64;yield</code> correspondiente.
            </li>
        </ul>
        <div class="text-sm text-gray-700 bg-blue-50 border-l-4 border-blue-400 p-3 rounded-r">
            <strong>Ejemplo real de este proyecto:</strong> El archivo
            <code class="bg-blue-100 px-1 rounded">layouts/app.blade.php</code> define el sidebar, el header y el
            contenedor principal con <code class="bg-blue-100 px-1 rounded">&#64;yield('content')</code>.
            Cada vista de los NT extiende ese layout e inyecta su propio contenido con
            <code class="bg-blue-100 px-1 rounded">&#64;section('content')</code>.
        </div>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">
                &#128196; resources/views/layouts/app.blade.php &mdash; layout base
            </p>
            <pre><code class="language-html rounded-md">&lt;!DOCTYPE html&gt;
&lt;html lang="es"&gt;
&lt;head&gt;
    &lt;title&gt;&#64;yield('title', 'Guía Laravel')&lt;/title&gt;
    &lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;
&lt;/head&gt;
&lt;body class="flex min-h-screen"&gt;

    &lt;aside&gt;...sidebar con menú de navegación...&lt;/aside&gt;

    &lt;main class="flex-1 p-8"&gt;
        &lt;header&gt;&lt;h2&gt;&#64;yield('header')&lt;/h2&gt;&lt;/header&gt;

        &lt;div&gt;
            &#64;yield('content') &lt;!-- contenido de cada NT --&gt;
        &lt;/div&gt;
    &lt;/main&gt;

&lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">
                &#128196; resources/views/nucleos/nt3.blade.php &mdash; vista hija
            </p>
            <pre><code class="language-html rounded-md">&#64;extends('layouts.app')

&#64;section('title', 'NT3: Blade Templates')
&#64;section('header', 'Núcleo Temático 3')

&#64;section('content')
    &lt;h3&gt;Contenido exclusivo del NT3&lt;/h3&gt;
    &lt;p&gt;Este bloque llena el &#64;yield('content') del layout.&lt;/p&gt;
&#64;endsection</code></pre>
        </div>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- ================================================================
     BLOQUE 3: PASO DE VARIABLES DESDE EL CONTROLADOR
     ================================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Paso de variables desde el Controlador</h3>
        <p class="mb-4">
            El controlador es el puente entre los datos y la vista. Para pasar variables a Blade
            existen tres formas equivalentes:
        </p>
        <ul class="list-disc pl-5 space-y-2 text-sm mb-4">
            <li>
                <code class="bg-gray-100 px-1 rounded">compact('asignaturas')</code> —
                Crea el array <code>['asignaturas' => $asignaturas]</code> automáticamente.
                Es la forma más limpia y usada en este proyecto.
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">view('vista', ['clave' => $valor])</code> —
                Array literal como segundo parámetro.
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">view('vista')-&gt;with('clave', $valor)</code> —
                Forma encadenada, útil para nombrar la clave distinto a la variable.
            </li>
        </ul>
        <p class="text-sm bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded-r text-gray-700">
            En NT4 estos datos pasarán a venir directamente de la base de datos mediante
            consultas Eloquent, pero el mecanismo de inyección a la vista es exactamente el mismo.
        </p>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
        <p class="text-xs font-bold uppercase text-slate-500 mb-2">
            &#128196; app/Http/Controllers/BladeControlador.php
        </p>
        <pre><code class="language-php rounded-md">&lt;?php

namespace App\Http\Controllers;

class BladeControlador extends Controller
{
    public function index()
    {
        // Arreglo de asignaturas enviado a la vista
        // (en NT4 vendrán de la base de datos)
        $asignaturas = [
            [
                'nombre'      =&gt; 'Desarrollo Web con Laravel',
                'codigo'      =&gt; 'INF-711',
                'obligatorio' =&gt; true,
                'estado'      =&gt; 'En curso',
            ],
            [
                'nombre'      =&gt; 'Ondas y Óptica',
                'codigo'      =&gt; 'FIS-322',
                'obligatorio' =&gt; true,
                'estado'      =&gt; 'En curso',
            ],
            [
                'nombre'      =&gt; 'Electromagnetismo',
                'codigo'      =&gt; 'FIS-311',
                'obligatorio' =&gt; true,
                'estado'      =&gt; 'Aprobado',
            ],
            [
                'nombre'      =&gt; 'Taller de Videojuegos Avanzado',
                'codigo'      =&gt; 'INF-824',
                'obligatorio' =&gt; false,
                'estado'      =&gt; 'Pendiente',
            ],
        ];

        // compact() empaqueta $asignaturas y la envía a la vista
        return view('nucleos.nt3', compact('asignaturas'));
    }
}</code></pre>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- ================================================================
     BLOQUE 4: INTEGRACIÓN CSS Y JS
     ================================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Integración de CSS y JavaScript en Laravel</h3>
        <p class="mb-4">
            Laravel gestiona los assets frontend a través de <strong>Vite</strong>, que compila y optimiza
            los archivos de <code class="bg-gray-100 px-1 rounded">resources/css/</code> y
            <code class="bg-gray-100 px-1 rounded">resources/js/</code>.
            En las vistas Blade se usa la directiva <code class="bg-gray-100 px-1 rounded">&#64;vite()</code>
            para inyectarlos.
        </p>
        <ul class="list-disc pl-5 space-y-2 text-sm">
            <li>
                <code class="bg-gray-100 px-1 rounded">&#64;vite([...])</code> —
                Inyecta los bundles compilados por Vite directamente en el <code>&lt;head&gt;</code>.
            </li>
            <li>
                En proyectos de desarrollo rápido también se puede usar un CDN (como hace este proyecto
                con Tailwind CSS y Highlight.js).
            </li>
            <li>
                La carpeta <code class="bg-gray-100 px-1 rounded">public/</code> aloja cualquier asset
                estático accesible sin compilación.
            </li>
        </ul>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">Con Vite — producción recomendada</p>
            <pre><code class="language-html rounded-md">&lt;head&gt;
    &lt;!-- Directiva Blade que inyecta los bundles de Vite --&gt;
    &#64;vite(['resources/css/app.css', 'resources/js/app.js'])
&lt;/head&gt;</code></pre>
        </div>
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">Con CDN — método usado en este proyecto</p>
            <pre><code class="language-html rounded-md">&lt;head&gt;
    &lt;!-- Tailwind CSS vía CDN --&gt;
    &lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;

    &lt;!-- Highlight.js para resaltado de código --&gt;
    &lt;link rel="stylesheet"
        href="cdnjs.../atom-one-dark.min.css"&gt;
    &lt;script src="cdnjs.../highlight.min.js"&gt;&lt;/script&gt;
    &lt;script&gt;hljs.highlightAll();&lt;/script&gt;
&lt;/head&gt;</code></pre>
        </div>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- ================================================================
     BLOQUE 5: EJEMPLO PRÁCTICO FUNCIONAL
     Las únicas directivas Blade REALES del archivo están aquí.
     Todos los &#64;foreach, &#64;if, etc. de arriba son entidades HTML.
     ================================================================ --}}
<div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
    <h3 class="text-2xl font-bold text-blue-800 mb-1">Ejemplo Práctico Funcional</h3>
    <p class="text-blue-900 mb-6 text-sm">
        <code class="bg-blue-100 px-1 rounded">BladeControlador&#64;index</code> inyecta el arreglo
        <code class="bg-blue-100 px-1 rounded">$asignaturas</code> a esta vista mediante
        <code class="bg-blue-100 px-1 rounded">compact()</code>. Blade lo recorre con
        <code class="bg-blue-100 px-1 rounded">&#64;foreach</code>, evalúa condiciones con
        <code class="bg-blue-100 px-1 rounded">&#64;if / &#64;elseif / &#64;else</code>
        y usa la variable mágica <code class="bg-blue-100 px-1 rounded">$loop</code>
        para numerar filas, alternar colores y marcar inicio y fin de la tabla.
    </p>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-800 text-white uppercase text-xs">
                    <th class="p-3 rounded-tl-md">
                        N° <span class="font-normal normal-case text-slate-400">($loop)</span>
                    </th>
                    <th class="p-3">Código</th>
                    <th class="p-3">Asignatura</th>
                    <th class="p-3">Tipo</th>
                    <th class="p-3 rounded-tr-md">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

                @foreach($asignaturas as $asignatura)
                <tr class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }} hover:bg-blue-50 transition duration-150">

                    {{-- N° de fila + etiquetas Inicio / Fin --}}
                    <td class="p-3 font-mono font-semibold text-gray-500">
                        {{ $loop->iteration }}
                        @if($loop->first)
                            <span class="ml-1 text-xs bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded">Inicio</span>
                        @endif
                        @if($loop->last)
                            <span class="ml-1 text-xs bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded">Fin</span>
                        @endif
                    </td>

                    {{-- Código --}}
                    <td class="p-3 font-mono text-gray-500">{{ $asignatura['codigo'] }}</td>

                    {{-- Nombre --}}
                    <td class="p-3 font-medium text-gray-900">{{ $asignatura['nombre'] }}</td>

                    {{-- Tipo: obligatorio o electivo --}}
                    <td class="p-3">
                        @if($asignatura['obligatorio'])
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Malla Obligatoria
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                Electivo
                            </span>
                        @endif
                    </td>

                    {{-- Estado con color según valor --}}
                    <td class="p-3">
                        @if($asignatura['estado'] === 'Aprobado')
                            <span class="text-emerald-600 font-semibold">&#10003; {{ $asignatura['estado'] }}</span>
                        @elseif($asignatura['estado'] === 'En curso')
                            <span class="text-blue-600 font-semibold animate-pulse">&#9679; {{ $asignatura['estado'] }}</span>
                        @else
                            <span class="text-gray-400">&#9675; {{ $asignatura['estado'] }}</span>
                        @endif
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    {{-- Leyenda de directivas reales usadas en la tabla --}}
    <div class="mt-5 grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
        <div class="bg-white border border-blue-200 rounded p-3 text-center">
            <code class="text-blue-700 font-bold block mb-1">&#64;foreach</code>
            <span class="text-gray-500">Itera la colección</span>
        </div>
        <div class="bg-white border border-blue-200 rounded p-3 text-center">
            <code class="text-blue-700 font-bold block mb-1">&#64;if / &#64;elseif / &#64;else</code>
            <span class="text-gray-500">Condicionales anidados</span>
        </div>
        <div class="bg-white border border-blue-200 rounded p-3 text-center">
            <code class="text-blue-700 font-bold block mb-1">$loop->iteration</code>
            <span class="text-gray-500">N° de vuelta actual</span>
        </div>
        <div class="bg-white border border-blue-200 rounded p-3 text-center">
            <code class="text-blue-700 font-bold block mb-1">$loop->even / first / last</code>
            <span class="text-gray-500">Propiedades del loop</span>
        </div>
    </div>
</div>

@endsection