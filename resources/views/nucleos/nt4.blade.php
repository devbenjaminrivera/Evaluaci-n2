@extends('layouts.app')

@section('title', 'NT4: Eloquent ORM')

@section('header', 'Núcleo Temático 4: Modelos y Bases de Datos (Eloquent ORM)')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">¿Qué es Eloquent ORM?</h3>
            <p class="mb-4">
                Laravel incluye <strong>Eloquent</strong>, un mapeador objeto-relacional (ORM) que permite interactuar con la base de datos de manera intuitiva. Cada tabla de la base de datos tiene un "Modelo" correspondiente que se utiliza para interactuar con dicha tabla sin necesidad de escribir complejas consultas SQL manuales.
            </p>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Migraciones y Seeders</h3>
            <ul class="list-disc pl-5 mb-4 space-y-2">
                <li><strong>Migraciones:</strong> Actúan como un control de versiones para la base de datos, permitiendo a tu equipo modificar y compartir la estructura del esquema de forma ágil.</li>
                <li><strong>Seeders:</strong> Clases utilizadas para poblar las tablas de la base de datos con información de prueba inicial mediante código.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Consulta ORM en el Controlador</h3>
            <pre><code class="language-php rounded-md shadow-sm">
namespace App\Http\Controllers;
use App\Models\Equipo;

class EloquentControlador extends Controller {
    public function index() {
        // Retorna todos los registros de la tabla 'equipos'
        $equipos = Equipo::all();
        return view('nucleos.nt4', compact('equipos'));
    }
}
            </code></pre>
        </div>
    </div>

    <hr class="my-10 border-gray-300">

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
        <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional (Persistencia)</h3>
        <p class="text-blue-900 mb-4">
            Los siguientes registros son obtenidos en tiempo real desde la base de datos MySQL mediante la consulta <code>Equipo::all()</code>.
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
                                    <span class="px-2 py-1 rounded bg-emerald-100 text-emerald-800 text-xs font-semibold">✓ {{ $equipo->estado }}</span>
                                @elseif($equipo->estado === 'En Taller')
                                    <span class="px-2 py-1 rounded bg-amber-100 text-amber-800 text-xs font-semibold">⚙ {{ $equipo->estado }}</span>
                                @else
                                    <span class="px-2 py-1 rounded bg-red-100 text-red-800 text-xs font-semibold">⚠ {{ $equipo->estado }}</span>
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