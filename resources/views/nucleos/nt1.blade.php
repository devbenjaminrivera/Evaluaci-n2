@extends('layouts.app')

@section('title', 'NT1: Introducción a Laravel')

@section('header', 'Núcleo Temático 1: Introducción y Fundamentos')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="prose max-w-none text-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">¿Qué es Laravel?</h3>
            <p class="mb-4">
                Laravel es un framework de código abierto para el desarrollo de aplicaciones web con PHP. Su filosofía se centra en la elegancia, la simplicidad y la legibilidad del código, facilitando tareas comunes como el enrutamiento, la autenticación, las sesiones y el almacenamiento en caché.
            </p>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">El Patrón MVC</h3>
            <p class="mb-4">
                Laravel adopta el patrón de arquitectura de software <strong>Modelo-Vista-Controlador (MVC)</strong>, el cual separa la lógica de la aplicación de la interfaz de usuario:
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2">
                <li><strong>Modelo:</strong> Representa los datos y las reglas de negocio. En Laravel, esto se maneja elegantemente con Eloquent ORM.</li>
                <li><strong>Vista:</strong> Es la interfaz de usuario. Laravel utiliza el motor de plantillas Blade para renderizar el HTML dinámicamente.</li>
                <li><strong>Controlador:</strong> Actúa como intermediario. Recibe las peticiones HTTP (rutas), interactúa con los Modelos para obtener datos y los envía a las Vistas.</li>
            </ul>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Herramientas Core</h3>
            <p class="mb-4">
                El ecosistema de Laravel funciona gracias a dos herramientas de línea de comandos fundamentales:
            </p>
            <ul class="list-disc pl-5 mb-4 space-y-2">
                <li><strong>Composer:</strong> El gestor de dependencias de PHP. Se encarga de instalar Laravel y los paquetes de terceros necesarios.</li>
                <li><strong>Artisan:</strong> Es la interfaz de línea de comandos (CLI) incluida en Laravel. Permite generar código repetitivo (controladores, migraciones, modelos) y gestionar la base de datos.</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Comandos de Instalación</h3>
            <p class="text-sm text-gray-600 mb-3">Para iniciar un proyecto desde cero, se utiliza Composer. El siguiente comando crea una estructura limpia de directorios:</p>
            
            <pre><code class="language-bash rounded-md shadow-sm">
# Creación de un nuevo proyecto
composer create-project laravel/laravel nombre_del_proyecto

# Ingresar al directorio
cd nombre_del_proyecto

# Iniciar el servidor local de desarrollo
php artisan serve
            </code></pre>

            <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">Estructura del archivo .env</h3>
            <p class="text-sm text-gray-600 mb-3">El archivo de entorno es crucial para definir las variables globales, como la conexión a la base de datos, sin exponer credenciales en el código fuente:</p>
            
            <pre><code class="language-ini rounded-md shadow-sm">
APP_NAME="Guía UNACH"
APP_ENV=local
APP_KEY=base64:x/YourKeyHere=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_unach
DB_USERNAME=root
DB_PASSWORD=
            </code></pre>
        </div>
    </div>

    <hr class="my-10 border-gray-300">

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
        <h3 class="text-2xl font-bold text-blue-800 mb-2">Ejemplo Práctico Funcional</h3>
        <p class="text-blue-900 mb-4">
            Aquí insertaremos el resultado de la práctica para demostrar que el entorno y la estructura base están operativos.
        </p>
        
        <div id="practica-nt1" class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
            <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                Estado del Servidor en Tiempo Real (Helper `config()`)
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="p-4 bg-slate-50 rounded border border-slate-200">
                    <span class="text-xs font-semibold text-slate-500 uppercase block">Nombre de la App</span>
                    <strong class="text-base text-slate-800">{{ config('app.name') }}</strong>
                </div>
                
                <div class="p-4 bg-slate-50 rounded border border-slate-200">
                    <span class="text-xs font-semibold text-slate-500 uppercase block">Entorno de Trabajo</span>
                    <strong class="text-base text-blue-600 font-mono">{{ config('app.env') }}</strong>
                </div>

                <div class="p-4 bg-slate-50 rounded border border-slate-200">
                    <span class="text-xs font-semibold text-slate-500 uppercase block">Modo Depuración (Debug)</span>
                    <strong class="text-base {{ config('app.debug') ? 'text-amber-600' : 'text-emerald-600' }}">
                        {{ config('app.debug') ? 'Activo (True)' : 'Inactivo (False)' }}
                    </strong>
                </div>
            </div>

            <div class="mt-4 p-3 bg-slate-800 text-slate-200 rounded font-mono text-xs flex justify-between items-center">
                <span>Versión de Laravel: <strong>{{ app()->version() }}</strong></span>
                <span>Versión de PHP: <strong>{{ phpversion() }}</strong></span>
            </div>
        </div>
    </div>
@endsection