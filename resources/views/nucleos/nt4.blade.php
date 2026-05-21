@extends('layouts.app')

@section('title', 'NT4: Eloquent ORM')

@section('header', 'Modelos y Bases de Datos — Eloquent ORM')

@section('content')

<!-- Bloque 1: Qué es Eloquent + fillable -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>¿Qué es Eloquent ORM?</h3>
        </div>
        <p style="margin-bottom:1rem;">
            Laravel incluye <strong>Eloquent</strong>, un mapeador objeto-relacional (ORM) que permite interactuar con la base de datos de manera intuitiva. Cada tabla tiene un <strong>Modelo</strong> correspondiente que se usa para consultar, insertar, actualizar y eliminar registros sin escribir SQL manual.
        </p>
        <p style="font-size:0.85rem; color:var(--ink-soft); margin-bottom:1.5rem;">
            Por convención, si el modelo se llama <code>Equipo</code>, Eloquent buscará automáticamente la tabla <code>equipos</code> (plural, snake_case).
        </p>

        <h4 style="margin-bottom:0.75rem;">Propiedades del Modelo</h4>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.5rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>$fillable</code> — Lista blanca de columnas para asignación masiva. Protege contra mass assignment.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>$hidden</code> — Columnas excluidas al serializar a JSON (contraseñas, tokens).</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>$casts</code> — Transformaciones de tipo automáticas (string → boolean, etc.).</li>
        </ul>

        <h4 style="margin-bottom:0.75rem;">Migraciones y Seeders</h4>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Migraciones</strong> — Control de versiones de la BD. Crean y modifican tablas desde PHP versionado en Git.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Seeders</strong> — Poblan la BD con datos de prueba de forma reproducible en cualquier entorno.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Factories</strong> — Generan datos falsos masivos con Faker. Se usan junto a Seeders.</li>
        </ul>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">php — app/Models/Equipo.php</div>
            <pre><code class="language-php">class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca', 'modelo', 'diagnostico', 'estado',
    ];

    protected $hidden = [];
}</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — migration: create_equipos_table</div>
            <pre><code class="language-php">Schema::create('equipos', function (Blueprint $table) {
    $table->id();
    $table->string('marca');
    $table->string('modelo');
    $table->string('diagnostico')->nullable();
    $table->string('estado');
    $table->timestamps();
});</code></pre>
        </div>
    </div>
</div>

<hr>

<!-- Bloque 2: Relaciones -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Relaciones Eloquent</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">Eloquent define relaciones entre modelos como métodos. Laravel construye los JOINs automáticamente.</p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>hasOne</code> — Un modelo tiene <strong>un</strong> relacionado. <span style="color:var(--ink-muted);">(Usuario → Perfil)</span></li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>hasMany</code> — Un modelo tiene <strong>muchos</strong> relacionados. <span style="color:var(--ink-muted);">(Laboratorio → Equipos)</span></li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>belongsTo</code> — Inversa de hasOne/hasMany. <span style="color:var(--ink-muted);">(Equipo → Laboratorio)</span></li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>belongsToMany</code> — Muchos a muchos con tabla pivote.</li>
        </ul>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">php — hasMany y belongsTo</div>
            <pre><code class="language-php">// Laboratorio.php
public function equipos()
{
    return $this->hasMany(Equipo::class);
}

// Equipo.php
public function laboratorio()
{
    return $this->belongsTo(Laboratorio::class);
}</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — eager loading en el controlador</div>
            <pre><code class="language-php">// Carga equipos con su laboratorio (evita N+1)
$equipos = Equipo::with('laboratorio')->get();

// Acceso en la vista:
// &#123;&#123; $equipo-&gt;laboratorio-&gt;nombre &#125;&#125;</code></pre>
        </div>
    </div>
</div>

<hr>

<!-- Bloque 3: Factory + Consultas avanzadas -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Factory y Consultas Avanzadas</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">Las <strong>Factories</strong> usan Faker para generar datos de prueba masivos. Las <strong>consultas avanzadas</strong> permiten filtrar, ordenar y limitar resultados con una API fluida sin SQL directo.</p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.4rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.83rem; color:var(--ink-soft);"><code>Equipo::all()</code> — Todos los registros.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.83rem; color:var(--ink-soft);"><code>Equipo::find($id)</code> — Un registro por ID.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.83rem; color:var(--ink-soft);"><code>where('campo', $valor)</code> — Filtra por condición.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.83rem; color:var(--ink-soft);"><code>orderBy('campo', 'asc')</code> — Ordena resultados.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.83rem; color:var(--ink-soft);"><code>latest()</code> — Ordena por <code>created_at</code> descendente.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.83rem; color:var(--ink-soft);"><code>count()</code> — Cuenta registros que cumplen la condición.</li>
        </ul>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">php — database/factories/EquipoFactory.php</div>
            <pre><code class="language-php">public function definition(): array
{
    return [
        'marca'       => $this->faker->randomElement(['Lenovo', 'HP', 'Asus', 'Dell']),
        'modelo'      => $this->faker->bothify('Model-##??'),
        'diagnostico' => $this->faker->sentence(6),
        'estado'      => $this->faker->randomElement(['Operativo', 'En Taller', 'Pendiente']),
    ];
}</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — consultas avanzadas</div>
            <pre><code class="language-php">$equipos   = Equipo::all();
$enTaller  = Equipo::where('estado', 'En Taller')
                   ->orderBy('marca', 'asc')->get();
$equipo    = Equipo::findOrFail(1);
$total     = Equipo::where('estado', 'Operativo')->count();
$recientes = Equipo::latest()->take(5)->get();</code></pre>
        </div>
    </div>
</div>

<hr>

<!-- Bloque 4: Ejemplo práctico -->
<div class="panel-accent" style="margin-bottom:1.5rem;">
    <h4 style="color:var(--accent); margin-bottom:0.5rem;">Ejemplo Práctico Funcional — Persistencia Real</h4>
    <p style="font-size:0.85rem; color:var(--ink-soft);">
        Registros obtenidos en tiempo real desde MySQL mediante <code>Equipo::all()</code> en <code>EloquentControlador@index</code>. El modelo usa <code>$fillable</code> para proteger la asignación masiva.
    </p>
</div>

<div style="background:#fff; border:1px solid var(--rule); border-radius:4px; overflow:hidden;">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Diagnóstico</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipos as $equipo)
            <tr>
                <td class="mono">{{ $equipo->id }}</td>
                <td class="strong">{{ $equipo->marca }}</td>
                <td class="mono">{{ $equipo->modelo }}</td>
                <td style="font-size:0.8rem; color:var(--ink-muted);">{{ $equipo->diagnostico ?? '—' }}</td>
                <td>
                    @if($equipo->estado === 'Operativo')
                        <span class="badge badge-green">{{ $equipo->estado }}</span>
                    @elseif($equipo->estado === 'En Taller')
                        <span class="badge badge-amber">{{ $equipo->estado }}</span>
                    @else
                        <span class="badge badge-red">{{ $equipo->estado }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding:1.5rem; text-align:center; color:var(--ink-muted); font-family:'IBM Plex Mono',monospace; font-size:0.78rem;">
                    Sin registros — ejecutar: php artisan migrate:fresh --seed
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection