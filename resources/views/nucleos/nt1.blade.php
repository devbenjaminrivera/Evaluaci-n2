@extends('layouts.app')

@section('title', 'NT1: Introducción a Laravel')

@section('header', 'Introducción y Fundamentos de Laravel')

@section('content')

{{-- BLOQUE 1: Historia y características --}}
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Historia y Características de Laravel</h3>
        </div>
        <p style="margin-bottom:1rem;">
            Laravel fue creado por <strong>Taylor Otwell</strong> y lanzado en <strong>junio de 2011</strong> como una alternativa más elegante y expresiva a CodeIgniter, que en ese momento carecía de soporte nativo para autenticación y autorización.
        </p>
        <p style="font-size:0.88rem; color:var(--ink-soft); margin-bottom:1rem;">
            Desde su primera versión, el framework creció rápidamente hasta convertirse en el framework PHP más popular del mundo, con versiones mayores que introdujeron características fundamentales:
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Laravel 3 (2012)</strong> — Introduce Artisan CLI y el sistema de migraciones.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Laravel 4 (2013)</strong> — Reescritura total usando Composer. Base de los paquetes modernos.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Laravel 5 (2015)</strong> — Introduce el motor Blade maduro, middleware y Service Providers.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Laravel 8–10 (2020–2023)</strong> — Jetstream, Livewire, Octane y soporte PHP 8.x.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Laravel 11–12 (2024–2025)</strong> — Estructura simplificada, Folio, Volt y Reverb.</li>
        </ul>

        <h4 style="margin-bottom:0.75rem;">Características principales</h4>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.45rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Motor de plantillas <strong>Blade</strong> con cero sobrecarga.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Eloquent ORM</strong> para interacción con BD sin SQL manual.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Sistema de <strong>Migraciones</strong> para control de versiones de BD.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><strong>Artisan CLI</strong> para generación de código y gestión del proyecto.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Sistema de <strong>Middleware</strong> para filtrado de peticiones HTTP.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);">Ecosistema de paquetes oficiales: Sanctum, Passport, Horizon, Telescope.</li>
        </ul>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">bash — instalación del proyecto</div>
            <pre><code class="language-bash"># Crear un nuevo proyecto Laravel con Composer
composer create-project laravel/laravel nombre_proyecto

# Ingresar al directorio
cd nombre_proyecto

# Levantar el servidor local de desarrollo
php artisan serve</code></pre>
        </div>

        <div class="panel-dark">
            <div class="code-label">ini — archivo .env (variables de entorno)</div>
            <pre><code class="language-ini">APP_NAME="Guía UNACH"
APP_ENV=local
APP_KEY=base64:x/YourKeyHere=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_unach
DB_USERNAME=root
DB_PASSWORD=</code></pre>
        </div>
    </div>
</div>

<hr>

{{-- BLOQUE 2: Patrón MVC --}}
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Arquitectura MVC</h3>
        </div>
        <p style="margin-bottom:1rem;">
            Laravel adopta el patrón <strong>Modelo-Vista-Controlador (MVC)</strong>, que separa la lógica de negocio de la interfaz de usuario. Cada capa tiene una responsabilidad única y bien definida:
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.65rem; margin-bottom:1.25rem;">
            <li style="padding-left:0.75rem; border-left:3px solid var(--accent); font-size:0.88rem; color:var(--ink-soft);">
                <strong style="color:var(--ink);">Modelo</strong> — Representa los datos y las reglas de negocio. Se comunica con la base de datos a través de Eloquent ORM. Vive en <code>app/Models/</code>.
            </li>
            <li style="padding-left:0.75rem; border-left:3px solid #2040a0; font-size:0.88rem; color:var(--ink-soft);">
                <strong style="color:var(--ink);">Vista</strong> — Interfaz de usuario. Usa el motor Blade para renderizar HTML dinámico a partir de los datos recibidos. Vive en <code>resources/views/</code>.
            </li>
            <li style="padding-left:0.75rem; border-left:3px solid #2d6b47; font-size:0.88rem; color:var(--ink-soft);">
                <strong style="color:var(--ink);">Controlador</strong> — Capa intermedia. Recibe peticiones HTTP, consulta los Modelos y retorna las Vistas. Vive en <code>app/Http/Controllers/</code>.
            </li>
        </ul>

        <div class="cycle-flow">
            <span class="cycle-node node-blue">Request</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-amber">Router</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-green">Controller</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-amber">Model</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-purple">View</span>
            <span class="cycle-arrow">›</span>
            <span class="cycle-node node-blue">Response</span>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div class="panel-dark">
            <div class="code-label">php — ciclo completo MVC en Laravel</div>
            <pre><code class="language-php">// 1. RUTA: routes/web.php
Route::get('/equipos', [EquipoControlador::class, 'index']);

// 2. CONTROLADOR: app/Http/Controllers/EquipoControlador.php
public function index()
{
    // Consulta al MODELO
    $equipos = Equipo::all();

    // Retorna la VISTA con los datos
    return view('equipos.index', compact('equipos'));
}

// 3. MODELO: app/Models/Equipo.php
class Equipo extends Model
{
    protected $fillable = ['marca', 'modelo', 'estado'];
}

// 4. VISTA: resources/views/equipos/index.blade.php
    @@foreach($equipos as $equipo)
        @{{ $equipo->marca }}
    @@endforeach</code></pre>
        </div>
    </div>
</div>

<hr>

{{-- BLOQUE 3: Estructura de directorios --}}
<div style="margin-bottom:2.5rem;">
    <div class="section-heading">
        <h3>Estructura de Directorios de un Proyecto Laravel</h3>
    </div>
    <p style="font-size:0.88rem; color:var(--ink-soft); margin-bottom:1.5rem;">
        Al crear un proyecto con <code>composer create-project</code>, Laravel genera la siguiente estructura. Cada carpeta tiene una responsabilidad específica dentro del patrón MVC:
    </p>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
        <div style="display:flex; flex-direction:column; gap:0.6rem;">
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">app/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Núcleo de la aplicación: Modelos, Controladores, Middleware, Requests.</span>
                </div>
            </div>
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">routes/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Define las URLs de la app. <code>web.php</code> para rutas web, <code>api.php</code> para APIs.</span>
                </div>
            </div>
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">resources/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Vistas Blade (<code>views/</code>), archivos CSS y JS sin compilar (<code>css/</code>, <code>js/</code>).</span>
                </div>
            </div>
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">database/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Migraciones (<code>migrations/</code>), Seeders, Factories para datos de prueba.</span>
                </div>
            </div>
        </div>
        <div style="display:flex; flex-direction:column; gap:0.6rem;">
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">public/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Único directorio accesible desde el navegador. Contiene <code>index.php</code> (punto de entrada) y assets estáticos.</span>
                </div>
            </div>
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">config/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Archivos de configuración de la app: BD (<code>database.php</code>), correo, caché, sesiones.</span>
                </div>
            </div>
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">storage/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Archivos generados en runtime: logs, caché de vistas Blade compiladas, archivos subidos.</span>
                </div>
            </div>
            <div class="panel" style="padding:1rem 1.25rem;">
                <div style="display:flex; gap:0.75rem; align-items:baseline;">
                    <code style="font-family:'IBM Plex Mono',monospace; font-size:0.78rem; color:var(--accent); background:none; border:none; padding:0; min-width:9rem;">vendor/</code>
                    <span style="font-size:0.83rem; color:var(--ink-soft);">Dependencias instaladas por Composer. No se edita manualmente ni se sube a Git.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

{{-- BLOQUE 4: Artisan + Composer --}}
<div class="two-col" style="margin-bottom:2.5rem;">
    <div>
        <div class="section-heading">
            <h3>Artisan CLI — Comandos Esenciales</h3>
        </div>
        <p style="margin-bottom:1rem; font-size:0.88rem;">
            <strong>Artisan</strong> es la interfaz de línea de comandos incluida en Laravel. Automatiza tareas repetitivas de desarrollo: generación de clases, gestión de la BD, limpieza de caché y arranque del servidor.
        </p>
        <p style="margin-bottom:1rem; font-size:0.85rem; color:var(--ink-soft);">
            Se ejecuta siempre desde la raíz del proyecto con <code>php artisan [comando]</code>. El comando <code>php artisan list</code> muestra todos los comandos disponibles.
        </p>

        <div class="section-heading" style="margin-top:1.75rem;">
            <h3>Composer en el Ecosistema PHP</h3>
        </div>
        <p style="margin-bottom:0.75rem; font-size:0.88rem;">
            <strong>Composer</strong> es el gestor de dependencias estándar de PHP. Lee el archivo <code>composer.json</code> del proyecto para instalar, actualizar y autocargar todos los paquetes requeridos.
        </p>
        <ul style="padding-left:1.25rem; list-style:none; display:flex; flex-direction:column; gap:0.45rem;">
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>composer install</code> — Instala las dependencias listadas en <code>composer.lock</code>.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>composer update</code> — Actualiza las dependencias a sus últimas versiones permitidas.</li>
            <li style="padding-left:0.75rem; border-left:2px solid var(--rule); font-size:0.85rem; color:var(--ink-soft);"><code>composer require paquete/nombre</code> — Agrega un nuevo paquete al proyecto.</li>
        </ul>
    </div>

    <div class="panel-dark">
        <div class="code-label">bash — comandos Artisan esenciales</div>
        <pre><code class="language-bash"># ── Servidor ───────────────────────────────────
php artisan serve                    # Inicia servidor en localhost:8000

# ── Generación de código ───────────────────────
php artisan make:controller NombreControlador
php artisan make:model NombreModelo -m    # -m crea la migración junto al modelo
php artisan make:migration create_tabla_table
php artisan make:seeder NombreSeeder
php artisan make:request NombreRequest
php artisan make:middleware NombreMiddleware

# ── Base de datos ──────────────────────────────
php artisan migrate                  # Ejecuta migraciones pendientes
php artisan migrate:fresh --seed     # Reinicia BD y carga seeders
php artisan db:seed                  # Ejecuta solo los seeders

# ── Caché y optimización ───────────────────────
php artisan cache:clear              # Limpia caché de datos
php artisan view:clear               # Limpia vistas Blade compiladas
php artisan config:clear             # Limpia caché de configuración
php artisan optimize                 # Optimiza para producción

# ── Información ────────────────────────────────
php artisan list                     # Lista todos los comandos disponibles
php artisan route:list               # Muestra todas las rutas registradas</code></pre>
    </div>
</div>

<hr>

{{-- BLOQUE 5: Ejemplo práctico --}}
<div class="panel-accent" style="margin-bottom:1.5rem;">
    <h4 style="color:var(--accent); margin-bottom:0.5rem;">Ejemplo Práctico Funcional</h4>
    <p style="font-size:0.85rem; color:var(--ink-soft);">
        El helper <code>config()</code> accede a las variables del entorno en tiempo real desde cualquier vista Blade. Los valores a continuación son leídos en vivo desde el <code>.env</code> del servidor.
    </p>
</div>

<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1rem;">
    <div class="panel" style="padding:1rem;">
        <h4 style="margin-bottom:0.4rem;">Nombre de la App</h4>
        <strong style="font-size:0.95rem; color:var(--ink);">{{ config('app.name') }}</strong>
    </div>
    <div class="panel" style="padding:1rem;">
        <h4 style="margin-bottom:0.4rem;">Entorno</h4>
        <strong style="font-family:'IBM Plex Mono',monospace; font-size:0.9rem; color:var(--accent);">{{ config('app.env') }}</strong>
    </div>
    <div class="panel" style="padding:1rem;">
        <h4 style="margin-bottom:0.4rem;">Modo Debug</h4>
        <strong style="font-size:0.88rem; color:{{ config('app.debug') ? '#7a5c0a' : '#2d6b47' }};">
            {{ config('app.debug') ? 'Activo' : 'Inactivo' }}
        </strong>
    </div>
</div>

<div class="info-bar">
    <span class="status-dot"><span class="dot-live"></span> Servidor activo</span>
    <span>Laravel <strong>{{ app()->version() }}</strong></span>
    <span>PHP <strong>{{ phpversion() }}</strong></span>
</div>

@endsection