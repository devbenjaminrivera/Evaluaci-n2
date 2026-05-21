@extends('layouts.app')

@section('title', 'NT5: Formularios y Validaciones')

@section('header', 'Formularios y Validaciones')

@section('content')

<!-- Bloque 1: Formularios y CSRF -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Manejo de Formularios y Protección CSRF</h3>
        </div>
        <p style="margin-bottom:1rem;">
            Laravel facilita la captura y validación de datos enviados por usuarios. Su característica de seguridad más importante es la protección contra ataques <strong>CSRF</strong> (Cross-Site Request Forgery).
        </p>
        <p style="font-size:0.88rem; color:var(--ink-soft); margin-bottom:1.25rem;">
            Cualquier formulario con método <code>POST</code>, <code>PUT</code>, <code>PATCH</code> o <code>DELETE</code> debe incluir <code>&#64;csrf</code> para generar un token oculto que Laravel verificará automáticamente.
        </p>

        <h4 style="margin-bottom:0.75rem;">Validación con <code>validate()</code></h4>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>validate()</code> — Define reglas estrictas. Si falla, Laravel redirige con errores automáticamente.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>&#64;error('campo')</code> — Directiva Blade que muestra el mensaje de error de ese campo.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>old('campo')</code> — Repuebla el input con el valor anterior si la validación falló.</li>
        </ul>

        <h4 style="margin-bottom:0.75rem;">Reglas de validación comunes</h4>
        <div class="rules-grid">
            <div class="rule-chip"><code>required</code> — Campo obligatorio</div>
            <div class="rule-chip"><code>email</code> — Formato de correo válido</div>
            <div class="rule-chip"><code>min:N / max:N</code> — Longitud mínima/máxima</div>
            <div class="rule-chip"><code>unique:tabla</code> — No repetido en BD</div>
            <div class="rule-chip"><code>confirmed</code> — Coincide con _confirmation</div>
            <div class="rule-chip"><code>in:val1,val2</code> — Valor en lista permitida</div>
            <div class="rule-chip"><code>nullable</code> — Permite valor nulo</div>
            <div class="rule-chip"><code>string / integer</code> — Tipo de dato</div>
        </div>
    </div>

    <div class="panel-dark">
        <div class="code-label">php — validación en el controlador</div>
        <pre><code class="language-php">public function store(Request $request)
{
    // Validación con mensajes personalizados en español
    $request->validate([
        'marca'       => 'required|string|max:50',
        'modelo'      => 'required|string|max:100',
        'diagnostico' => 'nullable|string|max:255',
        'estado'      => 'required|in:Operativo,En Taller,Pendiente',
    ], [
        'marca.required'  => 'Debes ingresar la marca del equipo.',
        'modelo.required' => 'El modelo es obligatorio.',
        'estado.in'       => 'El estado seleccionado no es válido.',
    ]);

    $equipo = new Equipo();
    $equipo->marca       = $request->marca;
    $equipo->modelo      = $request->modelo;
    $equipo->diagnostico = $request->diagnostico;
    $equipo->estado      = $request->estado;
    $equipo->save();

    return redirect()->route('nt5.index')
                     ->with('exito', '¡Equipo registrado correctamente!');
}</code></pre>
    </div>
</div>

<hr>

<!-- Bloque 2: Form Request Objects -->
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Form Request Objects</h3>
        </div>
        <p style="margin-bottom:1rem; font-size:0.88rem;">
            Cuando las reglas son complejas o se reutilizan, colocar la validación directamente en el controlador lo vuelve difícil de mantener. El <strong>Form Request Object</strong> es una clase dedicada que encapsula toda la lógica de validación fuera del controlador.
        </p>
        <p style="margin-bottom:1rem; font-size:0.88rem; color:var(--ink-soft);">
            El controlador declara que espera ese tipo como parámetro y Laravel ejecuta la validación automáticamente <em>antes</em> de que el método se llame.
        </p>

        <h4 style="margin-bottom:0.75rem;">¿Cuándo usar Form Request?</h4>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Cuando las reglas son extensas o complejas.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Cuando la misma validación se reutiliza en múltiples métodos.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Para mantener el controlador limpio: <strong>principio de responsabilidad única</strong>.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Cuando se necesita lógica de autorización con <code>authorize()</code>.</li>
        </ul>

        <div class="panel-note">
            <p style="font-size:0.83rem;"><strong>Diferencia clave:</strong> Con <code>validate()</code> inline la lógica vive en el controlador. Con un Form Request vive en su propia clase reutilizable y testeable de forma independiente.</p>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">bash — generar con artisan</div>
            <pre><code class="language-bash"># Genera en app/Http/Requests/
php artisan make:request RegistroEquipoRequest</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — app/Http/Requests/RegistroEquipoRequest.php</div>
            <pre><code class="language-php">class RegistroEquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'marca'       => 'required|string|max:50',
            'modelo'      => 'required|string|max:100',
            'diagnostico' => 'nullable|string|max:255',
            'estado'      => 'required|in:Operativo,En Taller,Pendiente',
        ];
    }

    public function messages(): array
    {
        return [
            'marca.required'  => 'Debes ingresar la marca.',
            'modelo.required' => 'El modelo es obligatorio.',
            'estado.in'       => 'Estado no válido.',
        ];
    }
}</code></pre>
        </div>
        <div class="panel-dark">
            <div class="code-label">php — controlador usando Form Request</div>
            <pre><code class="language-php">// Laravel valida automáticamente antes de ejecutar
public function store(RegistroEquipoRequest $request)
{
    $equipo = new Equipo();
    $equipo->fill($request->validated());
    $equipo->save();

    return redirect()->route('nt5.index')
                     ->with('exito', '¡Equipo registrado!');
}</code></pre>
        </div>
    </div>
</div>

<hr>

<!-- Bloque 3: Ejemplo práctico funcional -->
<div class="panel-accent" style="margin-bottom:1.5rem;">
    <h4 style="color:var(--accent); margin-bottom:0.5rem;">Ejemplo Práctico Funcional</h4>
    <p style="font-size:0.85rem; color:var(--ink-soft);">
        Envía el formulario vacío para activar las validaciones. Un registro exitoso persiste en MySQL y aparece en el inventario del NT4.
    </p>
</div>

@if(session('exito'))
    <div class="panel-success" style="margin-bottom:1.5rem;">
        <p style="font-size:0.88rem; font-family:'IBM Plex Mono',monospace; color:#2d5a40;">
            {{ session('exito') }}
        </p>
    </div>
@endif

<div style="max-width:520px; background:#fff; border:1px solid var(--rule); border-radius:4px; padding:1.75rem;">
    <form action="{{ route('nt5.guardar') }}" method="POST" style="display:flex; flex-direction:column; gap:1.1rem;">
        @csrf
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div>
                <label class="form-label">Marca <span style="color:var(--accent);">*</span></label>
                <input type="text" name="marca" value="{{ old('marca') }}"
                    class="form-input {{ $errors->has('marca') ? 'error' : '' }}"
                    placeholder="ej: Lenovo">
                @error('marca')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="form-label">Modelo <span style="color:var(--accent);">*</span></label>
                <input type="text" name="modelo" value="{{ old('modelo') }}"
                    class="form-input {{ $errors->has('modelo') ? 'error' : '' }}"
                    placeholder="ej: IdeaPad 5">
                @error('modelo')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div>
            <label class="form-label">Diagnóstico Técnico</label>
            <textarea name="diagnostico" rows="3"
                class="form-input"
                style="resize:vertical;"
                placeholder="Descripción del fallo o mantenimiento...">{{ old('diagnostico') }}</textarea>
        </div>

        <div>
            <label class="form-label">Estado de Operación <span style="color:var(--accent);">*</span></label>
            <select name="estado" class="form-input {{ $errors->has('estado') ? 'error' : '' }}">
                <option value="">Seleccione...</option>
                <option value="Operativo"  {{ old('estado') == 'Operativo'  ? 'selected' : '' }}>Operativo</option>
                <option value="En Taller"  {{ old('estado') == 'En Taller'  ? 'selected' : '' }}>En Taller</option>
                <option value="Pendiente"  {{ old('estado') == 'Pendiente'  ? 'selected' : '' }}>Pendiente</option>
            </select>
            @error('estado')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary">Registrar Equipo</button>
    </form>
</div>

@endsection