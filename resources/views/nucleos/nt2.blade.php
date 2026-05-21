@extends('layouts.app')

@section('title', 'NT2: Rutas y Controladores')

@section('header', 'Rutas y Controladores')

@section('content')

{{-- BLOQUE 1: Tipos de rutas y parámetros --}}
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Tipos de Rutas HTTP</h3>
        </div>
        <p style="margin-bottom:1rem; font-size:0.88rem;">
            En Laravel las rutas se definen en <code>routes/web.php</code> y se asocian a un método HTTP. Cada método tiene un propósito semántico dentro del patrón REST:
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>GET</code> — Obtener y mostrar recursos. No modifica datos.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>POST</code> — Enviar datos para crear un nuevo recurso.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>PUT / PATCH</code> — Actualizar un recurso existente (total o parcialmente).</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>DELETE</code> — Eliminar un recurso existente.</li>
        </ul>

        <div class="section-heading" style="margin-top:1.75rem;">
            <h3>Parámetros y Parámetros Opcionales</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">
            Las rutas pueden recibir <strong>parámetros dinámicos</strong> en la URL. Se definen con llaves <code>{param}</code>. Si el parámetro puede estar ausente, se declara con signo de interrogación <code>{param?}</code> y se le asigna un valor por defecto en el controlador.
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.45rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>/usuario/{id}</code> — Parámetro <strong>requerido</strong>. Si no se pasa, Laravel retorna 404.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>/usuario/{id?}</code> — Parámetro <strong>opcional</strong>. Si no se pasa, el controlador usa el valor por defecto.</li>
        </ul>
    </div>

    <div class="panel-dark">
        <div class="code-label">php — routes/web.php — tipos de rutas y parámetros</div>
        <pre><code class="language-php">// Rutas por método HTTP
Route::get('/equipos', [EquipoControlador::class, 'index']);
Route::post('/equipos', [EquipoControlador::class, 'store']);
Route::put('/equipos/{id}', [EquipoControlador::class, 'update']);
Route::delete('/equipos/{id}', [EquipoControlador::class, 'destroy']);

// Parámetro REQUERIDO — falla con 404 si no se pasa
Route::get('/usuario/{id}', function ($id) {
    return "Usuario: " . $id;
});

// Parámetro OPCIONAL — usa valor por defecto si no se pasa
Route::get('/categoria/{slug?}', function ($slug = 'general') {
    return "Categoría: " . $slug;
});
// /categoria       → "Categoría: general"
// /categoria/tech  → "Categoría: tech"</code></pre>
    </div>
</div>

<hr>

{{-- BLOQUE 2: Controladores básicos y RESTful --}}
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Controladores y Controladores RESTful</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">
            Un <strong>controlador básico</strong> agrupa métodos relacionados en una clase. Un <strong>controlador RESTful</strong> (o de recursos) sigue la convención de los 7 métodos estándar de Laravel que mapean automáticamente las operaciones CRUD a rutas y métodos HTTP.
        </p>
        <p style="margin-bottom:0.75rem; font-size:0.85rem; color:var(--ink-soft);">
            Se genera con <code>php artisan make:controller NombreControlador --resource</code> y se registra en una sola línea con <code>Route::resource()</code>.
        </p>

        <div style="background:#fff; border:1px solid var(--rule); border-radius:4px; overflow:hidden; margin-top:1rem;">
            <table class="data-table" style="font-size:0.75rem;">
                <thead>
                    <tr>
                        <th>Método</th>
                        <th>URL</th>
                        <th>Acción</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="mono">GET</td><td class="mono">/equipos</td><td>index</td><td class="mono">equipos.index</td></tr>
                    <tr class="alt"><td class="mono">GET</td><td class="mono">/equipos/create</td><td>create</td><td class="mono">equipos.create</td></tr>
                    <tr><td class="mono">POST</td><td class="mono">/equipos</td><td>store</td><td class="mono">equipos.store</td></tr>
                    <tr class="alt"><td class="mono">GET</td><td class="mono">/equipos/{id}</td><td>show</td><td class="mono">equipos.show</td></tr>
                    <tr><td class="mono">GET</td><td class="mono">/equipos/{id}/edit</td><td>edit</td><td class="mono">equipos.edit</td></tr>
                    <tr class="alt"><td class="mono">PUT/PATCH</td><td class="mono">/equipos/{id}</td><td>update</td><td class="mono">equipos.update</td></tr>
                    <tr><td class="mono">DELETE</td><td class="mono">/equipos/{id}</td><td>destroy</td><td class="mono">equipos.destroy</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">bash — generar controlador RESTful</div>
            <pre><code class="language-bash"># Genera los 7 métodos estándar automáticamente
php artisan make:controller EquipoControlador --resource</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — routes/web.php — ruta de recurso</div>
            <pre><code class="language-php">// Registra las 7 rutas RESTful en una línea
Route::resource('equipos', EquipoControlador::class);

// Solo algunas rutas
Route::resource('equipos', EquipoControlador::class)
    ->only(['index', 'store', 'destroy']);</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — estructura del controlador RESTful</div>
            <pre><code class="language-php">class EquipoControlador extends Controller
{
    public function index()   { /* lista todos */ }
    public function create()  { /* muestra form crear */ }
    public function store()   { /* guarda nuevo */ }
    public function show($id) { /* muestra uno */ }
    public function edit($id) { /* muestra form editar */ }
    public function update($id) { /* actualiza */ }
    public function destroy($id){ /* elimina */ }
}</code></pre>
        </div>
    </div>
</div>

<hr>

{{-- BLOQUE 3: Middleware --}}
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Middleware</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">
            El Middleware actúa como filtro que intercepta peticiones HTTP <strong>antes</strong> de que lleguen al controlador. Ideal para autenticación, autorización y logging.
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Laravel incluye middlewares integrados: <code>auth</code>, <code>verified</code>, <code>throttle</code>.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Se crean con: <code>php artisan make:middleware NombreMiddleware</code></li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Se aplican a rutas individuales con <code>->middleware('nombre')</code>.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Se aplican a grupos con <code>Route::middleware([...])->group(...)</code>.</li>
        </ul>

        <p style="font-size:0.83rem; margin-bottom:0.75rem;">Ciclo de la petición con Middleware:</p>
        <div class="cycle-flow">
            <span class="cycle-node node-blue">Request</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-amber">Middleware</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-green">Controlador</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-purple">Vista</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-amber">Middleware</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-blue">Response</span>
        </div>

        <div class="panel-note" style="margin-top:1rem;">
            <p style="font-size:0.83rem;"><strong>Ejemplo real:</strong> El middleware <code>auth</code> verifica si el usuario tiene sesión activa. Si no la tiene, redirige automáticamente al login antes de ejecutar el controlador.</p>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">bash — generar middleware</div>
            <pre><code class="language-bash">php artisan make:middleware VerificarAcceso</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — app/Http/Middleware/VerificarAcceso.php</div>
            <pre><code class="language-php">class VerificarAcceso
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->input('clave') !== 'unach2026') {
            return redirect('/')->with('error', 'Acceso denegado.');
        }
        return $next($request);
    }
}</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — aplicar en routes/web.php</div>
            <pre><code class="language-php">// Ruta individual con middleware
Route::get('/panel', [AdminControlador::class, 'index'])
    ->middleware('auth');

// Grupo de rutas protegidas
Route::middleware([VerificarAcceso::class])->group(function () {
    Route::get('/admin', [AdminControlador::class, 'index']);
    Route::get('/reportes', [AdminControlador::class, 'reportes']);
});</code></pre>
        </div>
    </div>
</div>

<hr>

{{-- BLOQUE 4: Ejemplo práctico --}}
<div class="panel-accent" style="margin-bottom:1.5rem;">
    <h4 style="color:var(--accent); margin-bottom:0.5rem;">Ejemplo Práctico Funcional</h4>
    <p style="font-size:0.85rem; color:var(--ink-soft);">
        Simulador de tarifas de transporte. Envía una petición <code>POST</code> al <code>RutasControlador</code>, que procesa el descuento TNE y devuelve el resultado vía sesión flash (<code>with()</code>).
    </p>
</div>

<div style="max-width:420px; background:#fff; border:1px solid var(--rule); border-radius:4px; padding:1.5rem;">
    <form action="{{ route('nt2.calcular') }}" method="POST" style="display:flex; flex-direction:column; gap:1rem;">
        @csrf
        <div>
            <label class="form-label">Tipo de pasajero</label>
            <select name="tipo_boleto" class="form-input">
                <option value="adulto">Adulto General — $3.500</option>
                <option value="estudiante">Estudiante con TNE — 40% descuento</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Enviar petición POST al controlador</button>
    </form>

    @if(session('resultado_pasaje'))
        <div class="panel-success" style="margin-top:1rem;">
            <p style="font-size:0.88rem; font-family:'IBM Plex Mono',monospace; color:#2d5a40;">
                {{ session('resultado_pasaje') }}
            </p>
        </div>
    @endif
</div>

@endsection