@extends('layouts.app')

@section('title', 'NT3: Motor de Plantillas Blade')

@section('header', 'Vistas y Blade Templates')

@section('content')

<!-- Bloque 1: Qué es Blade -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>¿Qué es Blade y cómo funciona?</h3>
        </div>
        <p style="margin-bottom:1rem;">
            Blade es el motor de plantillas que incluye Laravel. A diferencia de otros motores, no impide usar PHP puro en las vistas. Todas las vistas Blade se compilan en PHP puro y se almacenan en caché, por lo que Blade añade <strong>cero sobrecarga</strong> a la aplicación.
        </p>
        <p style="font-size:0.88rem; color:var(--ink-soft); margin-bottom:1.5rem;">
            Los archivos Blade usan la extensión <code>.blade.php</code> y se guardan en <code>resources/views</code>.
        </p>

        <h4 style="margin-bottom:0.75rem;">Directivas principales</h4>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#123;&#123; $var &#125;&#125;</code> — Imprime con escape HTML automático (previene XSS).</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#123;!! $var !!&#125;</code> — Imprime <strong>sin</strong> escapar. Usar con cuidado.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;if / &#64;elseif / &#64;else / &#64;endif</code> — Condicionales.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;foreach / &#64;endforeach</code> — Iteración de colecciones.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;extends</code> — Hereda un layout base.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;section / &#64;endsection</code> — Define un bloque de contenido.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;yield</code> — Reserva el espacio donde se inyecta un <code>&#64;section</code>.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;include</code> — Incluye una subvista parcial.</li>
        </ul>
    </div>

    <div class="panel-dark">
        <div class="code-label">html — sintaxis esencial de Blade</div>
        <pre><code class="language-html">&lt;!-- 1. Mostrar variable con escape HTML --&gt;
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

<hr>

<!-- Bloque 2: Layouts -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Layouts: <code>&#64;extends</code>, <code>&#64;section</code> y <code>&#64;yield</code></h3>
        </div>
        <p style="margin-bottom:0.75rem;">
            El sistema de herencia de Blade permite definir un <strong>layout base</strong> con la estructura HTML común y extenderlo en cada vista hija.
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;yield('nombre')</code> — En el <strong>layout</strong>. Reserva el espacio con ese nombre.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;extends('layouts.app')</code> — En la <strong>vista hija</strong>. Declara de qué layout hereda.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;section('nombre') ... &#64;endsection</code> — Define el contenido que llenará el <code>&#64;yield</code>.</li>
        </ul>
        <div class="panel-note">
            <p style="font-size:0.83rem;"><strong>Ejemplo real de este proyecto:</strong> <code>layouts/app.blade.php</code> define el sidebar y el header con <code>&#64;yield('content')</code>. Cada NT extiende ese layout con <code>&#64;section('content')</code>.</p>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">html — layouts/app.blade.php — layout base</div>
            <pre><code class="language-html">&lt;body&gt;
    &lt;aside&gt;...sidebar...&lt;/aside&gt;
    &lt;main&gt;
        &lt;h2&gt;&#64;yield('header')&lt;/h2&gt;
        &#64;yield('content') &lt;!-- espacio para el NT --&gt;
    &lt;/main&gt;
&lt;/body&gt;</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">html — nucleos/nt3.blade.php — vista hija</div>
            <pre><code class="language-html">&#64;extends('layouts.app')

&#64;section('title', 'NT3: Blade Templates')
&#64;section('header', 'Núcleo Temático 3')

&#64;section('content')
    &lt;h3&gt;Contenido exclusivo del NT3&lt;/h3&gt;
    &lt;p&gt;Llena el &#64;yield('content') del layout.&lt;/p&gt;
&#64;endsection</code></pre>
        </div>
    </div>
</div>

<hr>

<!-- Bloque 3: Paso de variables -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Paso de variables desde el Controlador</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">El controlador es el puente entre los datos y la vista. Existen tres formas equivalentes:</p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>compact('asignaturas')</code> — Crea el array automáticamente. Forma más limpia, usada en este proyecto.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>view('vista', ['clave' => $valor])</code> — Array literal como segundo parámetro.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>view('vista')->with('clave', $valor)</code> — Forma encadenada.</li>
        </ul>
        <div class="panel-note">
            <p style="font-size:0.83rem;">En NT4 estos datos vendrán de la base de datos mediante consultas Eloquent, pero el mecanismo de inyección a la vista es exactamente el mismo.</p>
        </div>
    </div>

    <div class="panel-dark">
        <div class="code-label">php — app/Http/Controllers/BladeControlador.php</div>
        <pre><code class="language-php">public function index()
{
    $asignaturas = [
        ['nombre' => 'Desarrollo Web con Laravel',
         'codigo' => 'INF-711', 'obligatorio' => true,
         'estado' => 'En curso'],
        ['nombre' => 'Ondas y Óptica',
         'codigo' => 'FIS-322', 'obligatorio' => true,
         'estado' => 'En curso'],
        ['nombre' => 'Electromagnetismo',
         'codigo' => 'FIS-311', 'obligatorio' => true,
         'estado' => 'Aprobado'],
        ['nombre' => 'Taller de Videojuegos Avanzado',
         'codigo' => 'INF-824', 'obligatorio' => false,
         'estado' => 'Pendiente'],
    ];

    return view('nucleos.nt3', compact('asignaturas'));
}</code></pre>
    </div>
</div>

<hr>

<!-- Bloque 4: CSS y JS -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Integración de CSS y JavaScript</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">
            Laravel gestiona los assets frontend a través de <strong>Vite</strong>, que compila y optimiza los archivos de <code>resources/css/</code> y <code>resources/js/</code>.
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;vite([...])</code> — Inyecta los bundles compilados por Vite en el <code>&lt;head&gt;</code>.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">En desarrollo rápido se puede usar CDN, como hace este proyecto con Tailwind y Highlight.js.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">La carpeta <code>public/</code> aloja assets estáticos accesibles sin compilación.</li>
        </ul>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">html — con Vite (producción recomendada)</div>
            <pre><code class="language-html">&lt;head&gt;
    &#64;vite(['resources/css/app.css', 'resources/js/app.js'])
&lt;/head&gt;</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">html — con CDN (método de este proyecto)</div>
            <pre><code class="language-html">&lt;head&gt;
    &lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;
    &lt;link rel="stylesheet" href="cdnjs.../atom-one-dark.min.css"&gt;
    &lt;script src="cdnjs.../highlight.min.js"&gt;&lt;/script&gt;
    &lt;script&gt;hljs.highlightAll();&lt;/script&gt;
&lt;/head&gt;</code></pre>
        </div>
    </div>
</div>

<hr>

<!-- Bloque 5: Ejemplo práctico -->
<div class="panel-accent" style="margin-bottom:1.5rem;">
    <h4 style="color:var(--accent); margin-bottom:0.5rem;">Ejemplo Práctico Funcional</h4>
    <p style="font-size:0.85rem; color:var(--ink-soft);">
        <code>BladeControlador@index</code> inyecta <code>$asignaturas</code> vía <code>compact()</code>. Blade recorre la colección con <code>&#64;foreach</code>, evalúa condiciones con <code>&#64;if</code> y usa <code>$loop</code> para numerar filas, alternar colores y marcar inicio y fin.
    </p>
</div>

<div style="background:#fff; border:1px solid var(--rule); border-radius:4px; overflow:hidden; margin-bottom:1.5rem;">
    <table class="data-table">
        <thead>
            <tr>
                <th>N° <span style="font-weight:300; opacity:0.6;">$loop</span></th>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Tipo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaturas as $asignatura)
            <tr class="{{ $loop->even ? 'alt' : '' }}">
                <td class="mono">
                    {{ $loop->iteration }}
                    @if($loop->first)
                        <span class="badge badge-start" style="margin-left:0.3rem;">inicio</span>
                    @endif
                    @if($loop->last)
                        <span class="badge badge-end" style="margin-left:0.3rem;">fin</span>
                    @endif
                </td>
                <td class="mono">{{ $asignatura['codigo'] }}</td>
                <td class="strong">{{ $asignatura['nombre'] }}</td>
                <td>
                    @if($asignatura['obligatorio'])
                        <span class="badge badge-red">Malla Obligatoria</span>
                    @else
                        <span class="badge badge-gray">Electivo</span>
                    @endif
                </td>
                <td>
                    @if($asignatura['estado'] === 'Aprobado')
                        <span class="badge badge-green">{{ $asignatura['estado'] }}</span>
                    @elseif($asignatura['estado'] === 'En curso')
                        <span class="badge badge-blue">{{ $asignatura['estado'] }}</span>
                    @else
                        <span class="badge badge-gray">{{ $asignatura['estado'] }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="directive-legend">
    <div class="directive-pill"><code>&#64;foreach</code><span>Itera la colección</span></div>
    <div class="directive-pill"><code>&#64;if / &#64;elseif / &#64;else</code><span>Condicionales anidados</span></div>
    <div class="directive-pill"><code>$loop->iteration</code><span>N° de vuelta actual</span></div>
    <div class="directive-pill"><code>$loop->even / first / last</code><span>Propiedades del loop</span></div>
</div>

@endsection