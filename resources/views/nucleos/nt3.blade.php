@extends('layouts.app')

@section('title', 'NT3: Motor de Plantillas Blade')

@section('header', 'Núcleo Temático 3: Vistas y Blade Templates')

@section('content')

{{-- ============================================================
     BLOQUE 1: ¿QUÉ ES BLADE?
     ============================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">¿Qué es Blade y cómo funciona?</h3>
            <p class="mb-4">
                Blade es el motor de plantillas simple pero potente que incluye Laravel. A diferencia de otros motores de plantillas de PHP, Blade no te impide usar código PHP puro en tus vistas. De hecho, todas las vistas de Blade se compilan en código PHP puro y se almacenan en caché hasta que se modifican, lo que significa que Blade añade <strong>cero sobrecarga</strong> a tu aplicación.
            </p>
            <p class="mb-4">
                Los archivos de vista de Blade utilizan la extensión <code>.blade.php</code> y se almacenan de forma predeterminada en el directorio <code>resources/views</code>.
            </p>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Directivas principales</h3>
            <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
                <li><code>&#123;&#123; $variable &#125;&#125;</code> — Muestra una variable con escape HTML automático (previene XSS).</li>
                <li><code>&#123;!! $variable !!&#125;</code> — Muestra una variable <strong>sin</strong> escapar (usar con cuidado).</li>
                <li><code>@if / @elseif / @else / @endif</code> — Condicionales.</li>
                <li><code>@foreach / @endforeach</code> — Iteración de colecciones.</li>
                <li><code>@extends</code> — Hereda un layout base.</li>
                <li><code>@section / @endsection</code> — Define un bloque de contenido.</li>
                <li><code>@yield</code> — Marca el lugar donde se inyectará un <code>@section</code>.</li>
                <li><code>@include</code> — Incluye una subvista parcial.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <h3 class="text-xl font-bold text-gray-800 mb-3">Sintaxis esencial de Blade</h3>
            <pre><code class="language-html">
&lt;!-- 1. Mostrar variable con escape --&gt;
&lt;p&gt;Hola, &#123;&#123; $nombre &#125;&#125;&lt;/p&gt;

&lt;!-- 2. Condicional --&gt;
&#64;if($activo)
    &lt;span&gt;Usuario activo&lt;/span&gt;
&#64;else
    &lt;span&gt;Usuario inactivo&lt;/span&gt;
&#64;endif

&lt;!-- 3. Bucle con variable $loop --&gt;
&#64;foreach($items as $item)
    &lt;li&gt;{{ $loop-&gt;iteration }}. &#123;&#123; $item &#125;&#125;&lt;/li&gt;
&#64;endforeach

&lt;!-- 4. Incluir una subvista --&gt;
&#64;include('partials.alerta', ['mensaje' =&gt; 'Éxito'])
            </code></pre>
        </div>
    </div>

    <hr class="my-8 border-gray-300">

{{-- ============================================================
     BLOQUE 2: LAYOUTS — @extends, @section, @yield
     ============================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Layouts: <code>@extends</code>, <code>@section</code> y <code>@yield</code></h3>
            <p class="mb-4">
                El sistema de herencia de plantillas de Blade permite definir un <strong>layout base</strong> con la estructura HTML común (cabecera, menú, pie) y luego <em>extenderlo</em> en cada vista hija, inyectando únicamente el contenido específico de esa página.
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
                <li><code>@yield('nombre')</code> — Se coloca en el layout. Reserva un espacio con ese nombre.</li>
                <li><code>@extends('layouts.app')</code> — Se coloca en la vista hija. Indica de qué layout hereda.</li>
                <li><code>@section('nombre') ... @endsection</code> — En la vista hija, define el contenido que irá en el <code>@yield</code> correspondiente.</li>
            </ul>
            <p class="text-sm text-gray-600 bg-blue-50 border-l-4 border-blue-400 p-3 rounded-r">
                <strong>Ejemplo real de este proyecto:</strong> El archivo <code>layouts/app.blade.php</code> define la estructura completa (sidebar, header, main). Cada vista de los NT extiende ese layout con <code>@extends('layouts.app')</code> e inyecta su contenido mediante <code>@section('content')</code>.
            </p>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-4">
            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-1">📄 resources/views/layouts/app.blade.php (layout base)</p>
                <pre><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;html lang="es"&gt;
&lt;head&gt;
    &lt;title&gt;&#64;yield('title', 'Mi App')&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;nav&gt;...menú de navegación...&lt;/nav&gt;

    &lt;main&gt;
        &#64;yield('content')  {{-- aquí entra el contenido de cada NT --}}
    &lt;/main&gt;
&lt;/body&gt;
&lt;/html&gt;
                </code></pre>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-1">📄 resources/views/nucleos/nt3.blade.php (vista hija)</p>
                <pre><code class="language-html">
&#64;extends('layouts.app')

&#64;section('title', 'NT3: Blade Templates')

&#64;section('content')
    &lt;h1&gt;Contenido exclusivo del NT3&lt;/h1&gt;
    &lt;p&gt;Este bloque se inyecta en el &#64;yield('content') del layout.&lt;/p&gt;
&#64;endsection
                </code></pre>
            </div>
        </div>
    </div>

    <hr class="my-8 border-gray-300">

{{-- ============================================================
     BLOQUE 3: PASO DE VARIABLES DESDE EL CONTROLADOR
     ============================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Paso de variables desde el Controlador</h3>
            <p class="mb-4">
                El controlador actúa como puente entre los datos y la vista. Para enviar variables a Blade se utiliza el helper <code>compact()</code> o el método <code>with()</code>:
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
                <li><code>compact('asignaturas')</code> — Crea un array asociativo con la variable y su nombre como clave. Es la forma más limpia.</li>
                <li><code>view('vista')->with('clave', $valor)</code> — Forma encadenada, útil cuando el nombre de la clave debe ser distinto a la variable.</li>
                <li><code>view('vista', ['clave' => $valor])</code> — Array literal directamente en el segundo parámetro.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <p class="text-xs font-bold uppercase text-slate-500 mb-1">📄 app/Http/Controllers/BladeControlador.php</p>
            <pre><code class="language-php">
public function index()
{
    // Colección de datos simulados (en NT4 vendrán de la BD)
    $asignaturas = [
        [
            'nombre'      => 'Desarrollo Web con Laravel',
            'codigo'      => 'INF-711',
            'obligatorio' => true,
            'estado'      => 'En curso',
        ],
        [
            'nombre'      => 'Ondas y Óptica',
            'codigo'      => 'FIS-322',
            'obligatorio' => true,
            'estado'      => 'En curso',
        ],
        [
            'nombre'      => 'Electromagnetismo',
            'codigo'      => 'FIS-311',
            'obligatorio' => true,
            'estado'      => 'Aprobado',
        ],
        [
            'nombre'      => 'Taller de Videojuegos Avanzado',
            'codigo'      => 'INF-824',
            'obligatorio' => false,
            'estado'      => 'Pendiente',
        ],
    ];

    // compact() empaqueta la variable y la envía a la vista
    return view('nucleos.nt3', compact('asignaturas'));
}
            </code></pre>
        </div>
    </div>

    <hr class="my-8 border-gray-300">

{{-- ============================================================
     BLOQUE 4: INTEGRACIÓN CSS Y JS EN LARAVEL
     ============================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Integración de CSS y JavaScript en Laravel</h3>
            <p class="mb-4">
                Laravel gestiona los assets de frontend (CSS, JS) a través de <strong>Vite</strong>, que compila y optimiza los archivos de <code>resources/css/</code> y <code>resources/js/</code>. En las vistas Blade se usan directivas especiales para enlazarlos:
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
                <li><code>&#64;vite(['resources/css/app.css', 'resources/js/app.js'])</code> — Inyecta los bundles compilados por Vite en el <code>&lt;head&gt;</code>.</li>
                <li>Para proyectos de desarrollo rápido también se puede referenciar directamente CSS externo vía CDN (como se hace en este proyecto con Tailwind).</li>
                <li>La carpeta <code>public/</code> aloja cualquier asset estático accesible directamente sin compilación.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-4">
            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-1">Con Vite (producción recomendada)</p>
                <pre><code class="language-html">
&lt;head&gt;
    &lt;!-- Directiva Blade que inyecta los bundles de Vite --&gt;
    &#64;vite(['resources/css/app.css', 'resources/js/app.js'])
&lt;/head&gt;
                </code></pre>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-500 mb-1">Con CDN (desarrollo rápido — método de este proyecto)</p>
                <pre><code class="language-html">
&lt;head&gt;
    &lt;!-- Tailwind CSS vía CDN --&gt;
    &lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;

    &lt;!-- Highlight.js para resaltado de sintaxis --&gt;
    &lt;link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/.../atom-one-dark.min.css"&gt;
    &lt;script src="https://cdnjs.cloudflare.com/.../highlight.min.js"&gt;&lt;/script&gt;
    &lt;script&gt;hljs.highlightAll();&lt;/script&gt;
&lt;/head&gt;
                </code></pre>
            </div>
        </div>
    </div>

    <hr class="my-8 border-gray-300">

{{-- ============================================================
     BLOQUE 5: EJEMPLO PRÁCTICO FUNCIONAL
     ============================================================ --}}
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
        <h3 class="text-2xl font-bold text-blue-800 mb-1">Ejemplo Práctico Funcional</h3>
        <p class="text-blue-900 mb-6 text-sm">
            El controlador <code>BladeControlador@index</code> inyecta un arreglo de asignaturas hacia esta vista. Blade recorre la colección con <code>@foreach</code>, evalúa condiciones con <code>@if / @elseif / @else</code> y utiliza la variable mágica <code>$loop</code> para numerar filas, pintar filas alternadas y marcar el primer y último elemento.
        </p>

        <div id="practica-nt3" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white uppercase text-xs">
                        <th class="p-3 rounded-tl-md">N° <span class="font-normal normal-case text-slate-400">($loop)</span></th>
                        <th class="p-3">Código</th>
                        <th class="p-3">Asignatura</th>
                        <th class="p-3">Tipo</th>
                        <th class="p-3 rounded-tr-md">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($asignaturas as $asignatura)
                        <tr class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }} hover:bg-blue-50 transition duration-150">

                            {{-- Número de iteración + etiquetas de inicio/fin --}}
                            <td class="p-3 font-mono font-semibold text-gray-500">
                                {{ $loop->iteration }}
                                @if($loop->first)
                                    <span class="ml-1 text-xs bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded">Inicio</span>
                                @endif
                                @if($loop->last)
                                    <span class="ml-1 text-xs bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded">Fin</span>
                                @endif
                            </td>

                            {{-- Código de asignatura --}}
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

                            {{-- Estado con colores distintos según valor --}}
                            <td class="p-3">
                                @if($asignatura['estado'] === 'Aprobado')
                                    <span class="text-emerald-600 font-semibold">✓ {{ $asignatura['estado'] }}</span>
                                @elseif($asignatura['estado'] === 'En curso')
                                    <span class="text-blue-600 font-semibold animate-pulse">● {{ $asignatura['estado'] }}</span>
                                @else
                                    <span class="text-gray-400">○ {{ $asignatura['estado'] }}</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Leyenda de directivas usadas --}}
        <div class="mt-5 grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
            <div class="bg-white border border-blue-200 rounded p-2 text-center">
                <code class="text-blue-700 font-bold">@foreach</code>
                <p class="text-gray-500 mt-1">Itera la colección</p>
            </div>
            <div class="bg-white border border-blue-200 rounded p-2 text-center">
                <code class="text-blue-700 font-bold">@if / @elseif / @else</code>
                <p class="text-gray-500 mt-1">Condicionales anidados</p>
            </div>
            <div class="bg-white border border-blue-200 rounded p-2 text-center">
                <code class="text-blue-700 font-bold">$loop->iteration</code>
                <p class="text-gray-500 mt-1">N° de vuelta actual</p>
            </div>
            <div class="bg-white border border-blue-200 rounded p-2 text-center">
                <code class="text-blue-700 font-bold">$loop->even</code>
                <p class="text-gray-500 mt-1">Filas alternas</p>
            </div>
        </div>
    </div>

@endsection