<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guía Laravel - UNACH')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
</head>
<body class="bg-gray-100 flex min-h-screen font-sans text-gray-900">

    <aside class="w-64 bg-slate-800 text-white flex flex-col hidden md:flex">
        <div class="p-6">
            <h1 class="text-2xl font-bold tracking-wider">Guía Laravel</h1>
            <p class="text-sm text-slate-400 mt-1">Electivo Profesional I</p>
        </div>
        
        <nav class="flex-1 px-4 space-y-2 mt-4">
            <a href="{{ route('nt1.index') }}" class="block px-4 py-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('nt1.*') ? 'bg-blue-600' : '' }}">
                NT1: Introducción
            </a>
            <a href="{{ route('nt2.index') }}" class="block px-4 py-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('nt2.*') ? 'bg-blue-600' : '' }}">
                NT2: Rutas y Controladores
            </a>
            <a href="{{ route('nt3.index') }}" class="block px-4 py-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('nt3.*') ? 'bg-blue-600' : '' }}">
                NT3: Vistas y Blade
            </a>
            <a href="{{ route('nt4.index') }}" class="block px-4 py-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('nt4.*') ? 'bg-blue-600' : '' }}">
                NT4: Eloquent ORM
            </a>
            <a href="{{ route('nt5.index') }}" class="block px-4 py-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('nt5.*') ? 'bg-blue-600' : '' }}">
                NT5: Formularios
            </a>
        </nav>
        
        <div class="p-4 bg-slate-900 text-xs text-center text-slate-500">
            UNACH &copy; 2026
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <header class="mb-8 border-b pb-4">
            <h2 class="text-3xl font-bold text-gray-800">@yield('header')</h2>
        </header>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            @yield('content')
        </div>
    </main>

</body>
</html>