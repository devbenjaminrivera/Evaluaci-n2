@extends('layouts.app')

@section('title', 'NT5: Formularios y Validaciones')

@section('header', 'Núcleo Temático 5: Formularios y Validaciones')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Manejo de Formularios</h3>
            <p class="mb-4">
                Laravel facilita enormemente la captura y validación de datos enviados por los usuarios. Una de sus características de seguridad más importantes es la protección contra ataques de falsificación de peticiones en sitios cruzados (CSRF). 
            </p>
            <p class="mb-4">
                Cualquier formulario HTML que apunte a una ruta <code>POST</code>, <code>PUT</code>, <code>PATCH</code> o <code>DELETE</code> debe incluir la directiva de Blade <code>&#64;csrf</code> para generar un token oculto que el framework verificará automáticamente.
            </p>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Validación y Recuperación de Datos</h3>
            <ul class="list-disc pl-5 mb-4 space-y-2">
                <li><strong>El método validate():</strong> Permite definir reglas estrictas (como <code>required</code>, <code>max</code>, <code>email</code>). Si la validación falla, Laravel redirige automáticamente al usuario de vuelta con los errores.</li>
                <li><strong>La directiva &#64;error:</strong> Permite mostrar mensajes de validación específicos justo debajo del campo que falló.</li>
                <li><strong>El helper old():</strong> Si un formulario falla la validación, esta función repuebla el <code>input</code> con lo que el usuario había escrito, evitando que tenga que rellenar todo desde cero.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Lógica de Validación (Controlador)</h3>
            <pre><code class="language-php rounded-md shadow-sm">
public function store(Request $request) {
    $request-&gt;validate([
        'marca'  =&gt; 'required|string|max:50',
        'modelo' =&gt; 'required|string|max:100',
        'estado' =&gt; 'required|in:Operativo,En Taller,Pendiente'
    ]);

    // Si pasa la validación, se persiste en la BD
    $equipo = new Equipo();
    $equipo-&gt;marca = $request-&gt;marca;
    $equipo-&gt;save();

    return back()-&gt;with('exito', 'Guardado con éxito');
}
            </code></pre>
        </div>
    </div>

    <hr class="my-10 border-gray-300">

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