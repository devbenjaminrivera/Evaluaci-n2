@extends('layouts.app')

@section('title', 'NT5: Formularios y Validaciones')

@section('header', 'Núcleo Temático 5: Formularios y Validaciones')

@section('content')

{{-- BLOQUE 1: FORMULARIOS Y CSRF --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
    
    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Manejo de Formularios y Protección CSRF</h3>
        <p class="mb-4">
            Laravel facilita enormemente la captura y validación de datos enviados por los usuarios. Una de sus características de seguridad más importantes es la protección contra ataques de falsificación de peticiones en sitios cruzados (CSRF). 
        </p>
        <p class="mb-4">
            Cualquier formulario HTML que apunte a una ruta <code class="bg-gray-100 px-1 rounded">POST</code>, <code class="bg-gray-100 px-1 rounded">PUT</code>, <code class="bg-gray-100 px-1 rounded">PATCH</code> o <code class="bg-gray-100 px-1 rounded">DELETE</code> debe incluir la directiva <code class="bg-gray-100 px-1 rounded">&#64;csrf</code> para generar un token oculto que el framework verificará automáticamente.
        </p>

        <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Validación inline con <code>validate()</code></h3>
        <ul class="list-disc pl-5 mb-4 space-y-2 text-sm">
            <li><strong><code>validate()</code>:</strong> Método del objeto <code>Request</code> que define reglas. Si falla, Laravel redirige automáticamente al usuario de vuelta con los errores.</li>
            <li><strong><code>&#64;error('campo')</code>:</strong> Directiva Blade que muestra el mensaje de error de un campo específico.</li>
            <li><strong><code>old('campo')</code>:</strong> Repuebla el input con lo que el usuario había escrito si la validación falló.</li>
        </ul>

        <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Reglas de validación comunes</h3>
        <div class="grid grid-cols-2 gap-2 text-xs">
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">required</code> — Campo obligatorio</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">email</code> — Formato de correo válido</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">min:N / max:N</code> — Longitud mínima/máxima</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">unique:tabla</code> — No repetido en BD</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">confirmed</code> — Coincide con campo _confirmation</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">in:val1,val2</code> — Valor en lista permitida</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">nullable</code> — Permite valor nulo</div>
            <div class="bg-gray-50 border rounded p-2"><code class="text-blue-700">string / integer</code> — Tipo de dato</div>
        </div>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
        <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Validación en el Controlador (método directo)</p>
        <pre><code class="language-php rounded-md shadow-sm">
public function store(Request $request)
{
    // Validación con mensajes personalizados en español
    $request-&gt;validate([
        'marca'       =&gt; 'required|string|max:50',
        'modelo'      =&gt; 'required|string|max:100',
        'diagnostico' =&gt; 'nullable|string|max:255',
        'estado'      =&gt; 'required|in:Operativo,En Taller,Pendiente',
    ], [
        'marca.required'  =&gt; 'Debes ingresar la marca del equipo.',
        'modelo.required' =&gt; 'El modelo es obligatorio para el registro.',
        'estado.in'       =&gt; 'El estado seleccionado no es válido.',
    ]);

    // Si pasa la validación, se persiste en la BD
    $equipo = new Equipo();
    $equipo-&gt;marca       = $request-&gt;marca;
    $equipo-&gt;modelo      = $request-&gt;modelo;
    $equipo-&gt;diagnostico = $request-&gt;diagnostico;
    $equipo-&gt;estado      = $request-&gt;estado;
    $equipo-&gt;save();

    return redirect()-&gt;route('nt5.index')
                     -&gt;with('exito', '¡Equipo registrado correctamente!');
}
        </code></pre>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- BLOQUE 2: FORM REQUEST OBJECTS --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <div class="text-gray-700">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Form Request Objects</h3>
        <p class="mb-4 text-sm">
            Cuando un controlador maneja múltiples formularios o las reglas son complejas, colocar toda la validación directamente en el controlador lo vuelve difícil de leer y mantener. Para eso existe el <strong>Form Request Object</strong>.
        </p>
        <p class="mb-4 text-sm">
            Un Form Request es una <strong>clase dedicada</strong> que encapsula toda la lógica de validación fuera del controlador. El controlador simplemente declara que espera ese tipo en su parámetro y Laravel ejecuta la validación automáticamente antes de que el método del controlador se llame.
        </p>
        <h3 class="text-lg font-bold text-gray-800 mb-2">¿Cuándo usar Form Request?</h3>
        <ul class="list-disc pl-5 space-y-1 text-sm mb-4">
            <li>Cuando las reglas de validación son extensas o complejas.</li>
            <li>Cuando la misma validación se reutiliza en múltiples métodos del controlador.</li>
            <li>Para mantener el controlador limpio siguiendo el <strong>principio de responsabilidad única</strong>.</li>
            <li>Cuando se necesita lógica de autorización además de validación (método <code>authorize()</code>).</li>
        </ul>
        <div class="text-sm bg-green-50 border-l-4 border-green-400 p-3 rounded-r text-gray-700">
            <strong>Diferencia clave:</strong> Con <code>validate()</code> inline, la lógica vive en el controlador. Con un Form Request, vive en su propia clase reutilizable y testeable de forma independiente.
        </div>
    </div>

    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 space-y-5">
        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Crear el Form Request con Artisan</p>
            <pre><code class="language-bash rounded-md">
# Genera el archivo en app/Http/Requests/
php artisan make:request RegistroEquipoRequest
            </code></pre>
        </div>

        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; app/Http/Requests/RegistroEquipoRequest.php</p>
            <pre><code class="language-php rounded-md">
&lt;?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroEquipoRequest extends FormRequest
{
    // Define si el usuario está autorizado a hacer esta petición
    public function authorize(): bool
    {
        return true; // true = todos pueden enviar este formulario
    }

    // Define las reglas de validación
    public function rules(): array
    {
        return [
            'marca'       =&gt; 'required|string|max:50',
            'modelo'      =&gt; 'required|string|max:100',
            'diagnostico' =&gt; 'nullable|string|max:255',
            'estado'      =&gt; 'required|in:Operativo,En Taller,Pendiente',
        ];
    }

    // Mensajes de error personalizados en español
    public function messages(): array
    {
        return [
            'marca.required'  =&gt; 'Debes ingresar la marca del equipo.',
            'modelo.required' =&gt; 'El modelo es obligatorio.',
            'estado.in'       =&gt; 'El estado seleccionado no es válido.',
        ];
    }
}
            </code></pre>
        </div>

        <div>
            <p class="text-xs font-bold uppercase text-slate-500 mb-2">&#128196; Controlador usando el Form Request (más limpio)</p>
            <pre><code class="language-php rounded-md">
// Se inyecta RegistroEquipoRequest en vez de Request genérico
// Laravel valida automáticamente ANTES de ejecutar este método
public function store(RegistroEquipoRequest $request)
{
    // Si llega aquí, los datos ya pasaron la validación
    $equipo = new Equipo();
    $equipo-&gt;marca       = $request-&gt;marca;
    $equipo-&gt;modelo      = $request-&gt;modelo;
    $equipo-&gt;diagnostico = $request-&gt;diagnostico;
    $equipo-&gt;estado      = $request-&gt;estado;
    $equipo-&gt;save();

    return redirect()-&gt;route('nt5.index')
                     -&gt;with('exito', '¡Equipo registrado!');
}
            </code></pre>
        </div>
    </div>
</div>

<hr class="my-8 border-gray-300">

{{-- BLOQUE 3: EJEMPLO PRÁCTICO FUNCIONAL --}}
<div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
    <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional (Conexión a BD)</h3>
    <p class="text-blue-900 mb-4">
        Ingresa un nuevo equipo tecnológico. Intenta enviar el formulario vacío para probar las validaciones en tiempo real. Si el registro es exitoso, podrás ver el nuevo equipo listado en la pestaña del <strong>NT4</strong>.
    </p>

    @if(session('exito'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded font-medium shadow-sm">
            {{ session('exito') }}
        </div>
    @endif
    
    <div id="practica-nt5" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100 max-w-xl">
        <form action="{{ route('nt5.guardar') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Marca *</label>
                    <input type="text" name="marca" value="{{ old('marca') }}" 
                        class="w-full p-2 border rounded focus:ring-2 outline-none {{ $errors->has('marca') ? 'border-red-500 focus:ring-red-200' : 'border-gray-300 focus:ring-blue-500' }}">
                    @error('marca')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Modelo *</label>
                    <input type="text" name="modelo" value="{{ old('modelo') }}" 
                        class="w-full p-2 border rounded focus:ring-2 outline-none {{ $errors->has('modelo') ? 'border-red-500 focus:ring-red-200' : 'border-gray-300 focus:ring-blue-500' }}">
                    @error('modelo')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Diagnóstico Técnico</label>
                <textarea name="diagnostico" rows="3" 
                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">{{ old('diagnostico') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado de Operación *</label>
                <select name="estado" class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">Seleccione una opción...</option>
                    <option value="Operativo" {{ old('estado') == 'Operativo' ? 'selected' : '' }}>Operativo</option>
                    <option value="En Taller" {{ old('estado') == 'En Taller' ? 'selected' : '' }}>En Taller</option>
                    <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                </select>
                @error('estado')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded transition duration-200 mt-4">
                Registrar Equipo
            </button>
        </form>
    </div>
</div>

@endsection