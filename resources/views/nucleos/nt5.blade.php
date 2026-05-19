@extends('layouts.app')

@section('title', 'NT5:')

@section('header', 'Núcleo Temático 5')

@section('content')
    <div class="prose max-w-none">
        <h3 class="text-xl font-semibold mb-4">Conceptos Teóricos</h3>
        <p class="mb-4">Aquí vaciaremos la teoría extraída de los documentos (MVC, estructura de carpetas, instalación).</p>
        
        <h3 class="text-xl font-semibold mt-8 mb-4">Ejemplo de Código</h3>
        <pre><code class="language-php">
// Ejemplo de configuración en el archivo .env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost
        </code></pre>
    </div>
@endsection