@extends('layouts.app')

@section('title', 'NT4: Eloquent ORM')

@section('header', 'Núcleo Temático 4: Modelos y Bases de Datos (Eloquent ORM)')

@section('content')

{{-- BLOQUE 1: QUÉ ES ELOQUENT + MIGRACIÓN --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">¿Qué es Eloquent ORM?</h3>
        <p class="mb-4">
            Laravel incluye <strong>Eloquent</strong>, un mapeador objeto-relacional (ORM) que permite interactuar con la base de datos de manera intuitiva. Cada tabla tiene un <strong>Modelo</strong> correspondiente que se usa para consultar, insertar, actualizar y eliminar registros sin escribir SQL manual.
        </p>
        <p class="mb-3 text-sm">
            Por convención, si el modelo se llama <code class="bg-gray-100 px-1 rounded">Equipo</code>, Eloquent buscará automáticamente la tabla <code class="bg-gray-100 px-1 rounded">equipos</code> (plural, snake_case).
        </p>

        <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Propiedades del Modelo: <code>$fillable</code> y <code>$hidden</code></h3>
        <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
            <li>
                <code class="bg-gray-100 px-1 rounded">$fillable</code> — Lista blanca de columnas que pueden recibir asignación masiva (mass assignment). Protege contra la inserción de campos no autorizados.
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">$hidden</code> — Columnas excluidas cuando el modelo se serializa a JSON o array (útil para contraseñas, tokens).
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">$casts</code> — Define transformaciones de tipo automáticas (ej: campo de BD como string → convertido a boolean en PHP).
            </li>
        </ul>

        <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Migraciones y Seeders</h3>
        <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
            <li><strong>Migraciones:</strong> Control de versiones de la BD. Permiten crear, modificar y eliminar tablas desde código PHP versionado en Git.</li>
            <li><strong>Seeders:</strong> Poblan la BD con datos de prueba iniciales usando código, de forma reproducible en cualquier entorno.</li>
            <li><strong>Factories:</strong> Generan datos falsos masivos usando la librería Faker. Se usan junto a los Seeders para pruebas y desarrollo.</li>
        </ul>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; app/Models/Equipo.php</p>
            <pre><code class="language-php rounded-md shadow-sm">
&lt;?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipo extends Model
{
    use HasFactory;

    // Columnas permitidas para asignación masiva
    protected $fillable = [
        'marca',
        'modelo',
        'diagnostico',
        'estado',
    ];

    // Columnas excluidas de la serialización JSON
    protected $hidden = [];
}
            </code></pre>
        </div>

        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; database/migrations/xxxx_create_equipos_table.php</p>
            <pre><code class="language-php rounded-md shadow-sm">
Schema::create('equipos', function (Blueprint $table) {
    $table-&gt;id();
    $table-&gt;string('marca');
    $table-&gt;string('modelo');
    $table-&gt;string('diagnostico')-&gt;nullable();
    $table-&gt;string('estado');
    $table-&gt;timestamps(); // created_at y updated_at
});
            </code></pre>
        </div>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- BLOQUE 2: RELACIONES ELOQUENT --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Relaciones Eloquent</h3>
        <p class="mb-4 text-sm">
            Eloquent permite definir relaciones entre modelos directamente como métodos. Laravel se encarga de construir los JOINs automáticamente.
        </p>
        <ul class="list-disc pl-5 space-y-2 text-sm">
            <li>
                <code class="bg-gray-100 px-1 rounded">hasOne</code> — Un modelo tiene <strong>un</strong> modelo relacionado.
                <span class="text-gray-500">(ej: Usuario tiene un Perfil)</span>
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">hasMany</code> — Un modelo tiene <strong>muchos</strong> modelos relacionados.
                <span class="text-gray-500">(ej: Laboratorio tiene muchos Equipos)</span>
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">belongsTo</code> — Inversa de hasOne/hasMany. El modelo pertenece a otro.
                <span class="text-gray-500">(ej: Equipo pertenece a un Laboratorio)</span>
            </li>
            <li>
                <code class="bg-gray-100 px-1 rounded">belongsToMany</code> — Relación muchos a muchos a través de tabla pivote.
                <span class="text-gray-500">(ej: Técnico tiene muchos Equipos y viceversa)</span>
            </li>
        </ul>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Ejemplo: hasMany y belongsTo</p>
            <pre><code class="language-php rounded-md shadow-sm">
// Modelo: app/Models/Laboratorio.php
class Laboratorio extends Model
{
    // Un laboratorio tiene muchos equipos
    public function equipos()
    {
        return $this-&gt;hasMany(Equipo::class);
    }
}

// Modelo: app/Models/Equipo.php
class Equipo extends Model
{
    protected $fillable = ['marca', 'modelo', 'estado', 'laboratorio_id'];

    // Un equipo pertenece a un laboratorio
    public function laboratorio()
    {
        return $this-&gt;belongsTo(Laboratorio::class);
    }
}
            </code></pre>
        </div>

        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Usar la relación en el controlador</p>
            <pre><code class="language-php rounded-md shadow-sm">
// Cargar equipos con su laboratorio asociado (Eager Loading)
$equipos = Equipo::with('laboratorio')-&gt;get();

// Acceder a la relación en la vista
// {{ $equipo-&gt;laboratorio-&gt;nombre }}
            </code></pre>
        </div>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- BLOQUE 3: FACTORY + CONSULTAS AVANZADAS --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Factory y Consultas Avanzadas</h3>
        <p class="mb-3 text-sm">
            Las <strong>Factories</strong> usan la librería <strong>Faker</strong> para generar datos de prueba realistas de forma masiva, sin tener que escribir cada registro manualmente.
        </p>
        <p class="mb-4 text-sm">
            Las <strong>consultas avanzadas</strong> de Eloquent permiten filtrar, ordenar y limitar resultados usando una API fluida orientada a objetos, sin necesidad de SQL directo.
        </p>
        <ul class="list-disc pl-5 space-y-2 text-sm">
            <li><code class="bg-gray-100 px-1 rounded">Equipo::all()</code> — Todos los registros.</li>
            <li><code class="bg-gray-100 px-1 rounded">Equipo::find($id)</code> — Un registro por su ID.</li>
            <li><code class="bg-gray-100 px-1 rounded">where('campo', $valor)</code> — Filtra por condición.</li>
            <li><code class="bg-gray-100 px-1 rounded">orderBy('campo', 'asc')</code> — Ordena resultados.</li>
            <li><code class="bg-gray-100 px-1 rounded">latest()</code> — Ordena por <code>created_at</code> descendente.</li>
            <li><code class="bg-gray-100 px-1 rounded">count()</code> — Cuenta registros que cumplen la condición.</li>
        </ul>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; database/factories/EquipoFactory.php</p>
            <pre><code class="language-php rounded-md shadow-sm">
&lt;?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'marca'       =&gt; $this-&gt;faker-&gt;randomElement(['Lenovo', 'HP', 'Asus', 'Dell']),
            'modelo'      =&gt; $this-&gt;faker-&gt;bothify('Model-##??'),
            'diagnostico' =&gt; $this-&gt;faker-&gt;sentence(6),
            'estado'      =&gt; $this-&gt;faker-&gt;randomElement(['Operativo', 'En Taller', 'Pendiente']),
        ];
    }
}
            </code></pre>
        </div>

        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Consultas avanzadas Eloquent</p>
            <pre><code class="language-php rounded-md shadow-sm">
// Todos los equipos
$equipos = Equipo::all();

// Solo equipos en taller, ordenados por marca
$enTaller = Equipo::where('estado', 'En Taller')
                  -&gt;orderBy('marca', 'asc')
                  -&gt;get();

// Buscar por ID (lanza 404 si no existe)
$equipo = Equipo::findOrFail(1);

// Contar equipos operativos
$total = Equipo::where('estado', 'Operativo')-&gt;count();

// Los 5 registros más recientes
$recientes = Equipo::latest()-&gt;take(5)-&gt;get();
            </code></pre>
        </div>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- BLOQUE 4: EJEMPLO PRÁCTICO FUNCIONAL --}}
<div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
    <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional (Persistencia Real)</h3>
    <p class="text-blue-900 mb-4">
        Los siguientes registros son obtenidos en tiempo real desde la base de datos MySQL mediante <code>Equipo::all()</code> en <code>EloquentControlador@index</code>. El modelo usa <code>$fillable</code> para proteger la asignación masiva.
    </p>
    
    <div id="practica-nt4" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-800 text-white text-sm uppercase">
                    <th class="p-3 rounded-l">ID</th>
                    <th class="p-3">Marca y Modelo</th>
                    <th class="p-3">Diagnóstico Técnico</th>
                    <th class="p-3 rounded-r">Estado</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($equipos as $equipo)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="p-3 font-mono font-bold text-slate-500">{{ $equipo->id }}</td>
                        <td class="p-3 font-medium text-slate-900">
                            {{ $equipo->marca }} <br>
                            <span class="text-xs text-slate-500 font-normal">{{ $equipo->modelo }}</span>
                        </td>
                        <td class="p-3 text-slate-600 text-xs">{{ $equipo->diagnostico ?? 'Sin observaciones' }}</td>
                        <td class="p-3">
                            @if($equipo->estado === 'Operativo')
                                <span class="px-2 py-1 rounded bg-emerald-100 text-emerald-800 text-xs font-semibold">&#10003; {{ $equipo->estado }}</span>
                            @elseif($equipo->estado === 'En Taller')
                                <span class="px-2 py-1 rounded bg-amber-100 text-amber-800 text-xs font-semibold">&#9881; {{ $equipo->estado }}</span>
                            @else
                                <span class="px-2 py-1 rounded bg-red-100 text-red-800 text-xs font-semibold">&#9888; {{ $equipo->estado }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500 italic">
                            No hay registros cargados. Ejecuta: php artisan migrate:fresh --seed
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
