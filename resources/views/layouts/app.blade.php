<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guía Laravel — UNACH')</title>

    <!-- Google Fonts: Instrument Serif (display) + IBM Plex Mono (code) + DM Sans (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=IBM+Plex+Mono:wght@400;500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Highlight.js: GitHub Dark Dimmed -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark-dimmed.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>document.addEventListener('DOMContentLoaded', () => hljs.highlightAll());</script>

    <style>
        /* ── Design Tokens ─────────────────────────────────── */
        :root {
            --ink:        #1a1a1a;
            --ink-soft:   #4a4a4a;
            --ink-muted:  #8a8a8a;
            --rule:       #d8d4cc;
            --rule-soft:  #ede9e3;
            --paper:      #f5f2ec;
            --paper-dark: #edeae3;
            --accent:     #8b1a1a;
            --accent-dim: #b84040;
            --sidebar-bg: #16161a;
            --sidebar-border: #2c2c32;
            --code-bg:    #1c1e26;
        }

        /* ── Base ───────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            line-height: 1.7;
            color: var(--ink);
            background: var(--paper);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ────────────────────────────────────────── */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            flex-shrink: 0;
        }

        .sidebar-brand {
            padding: 2rem 1.75rem 1.25rem;
            border-bottom: 1px solid var(--sidebar-border);
        }

        .sidebar-brand .wordmark {
            font-family: 'Instrument Serif', serif;
            font-size: 1.35rem;
            color: #f0ece4;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .sidebar-brand .subtitle {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            color: #5a5a68;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-top: 0.4rem;
        }

        .sidebar-section-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #3e3e4a;
            padding: 1.5rem 1.75rem 0.5rem;
        }

        .sidebar nav {
            padding: 0 1rem 1.5rem;
        }

        .sidebar nav a {
            display: flex;
            align-items: baseline;
            gap: 0.75rem;
            padding: 0.55rem 0.75rem;
            border-radius: 3px;
            text-decoration: none;
            color: #9090a0;
            font-size: 0.82rem;
            font-weight: 400;
            transition: color 0.15s, background 0.15s;
            border-left: 2px solid transparent;
            margin-bottom: 1px;
        }

        .sidebar nav a .nt-num {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            color: #3e3e4a;
            min-width: 1.8rem;
            transition: color 0.15s;
        }

        .sidebar nav a:hover {
            color: #d0ccc4;
            background: #1f1f26;
        }

        .sidebar nav a:hover .nt-num { color: #6060a0; }

        .sidebar nav a.active {
            color: #f0ece4;
            background: #1f1f26;
            border-left-color: var(--accent);
        }

        .sidebar nav a.active .nt-num {
            color: var(--accent-dim);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.75rem;
            border-top: 1px solid var(--sidebar-border);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.6rem;
            color: #3e3e4a;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-align: center;
        }

        /* ── Main ───────────────────────────────────────────── */
        .main-content {
            flex: 1;
            overflow-y: auto;
            min-width: 0;
        }

        .page-header {
            padding: 2.5rem 3rem 1.75rem;
            border-bottom: 1px solid var(--rule);
            background: var(--paper);
        }

        .page-header .nt-tag {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .page-header h2 {
            font-family: 'Instrument Serif', serif;
            font-size: 2rem;
            font-weight: 400;
            color: var(--ink);
            letter-spacing: -0.02em;
            line-height: 1.15;
        }

        .content-area {
            padding: 2.5rem 3rem 4rem;
            max-width: 1100px;
        }

        /* ── Typography ─────────────────────────────────────── */
        h3 {
            font-family: 'Instrument Serif', serif;
            font-size: 1.35rem;
            font-weight: 400;
            letter-spacing: -0.01em;
            color: var(--ink);
            line-height: 1.25;
        }

        h4 {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--ink-muted);
        }

        p { color: var(--ink-soft); font-size: 0.9rem; }

        code:not([class]) {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.78rem;
            background: var(--paper-dark);
            color: var(--accent);
            padding: 0.15em 0.4em;
            border-radius: 2px;
            border: 1px solid var(--rule);
        }

        strong { color: var(--ink); font-weight: 500; }

        ul li { color: var(--ink-soft); font-size: 0.9rem; }
        ul li strong { color: var(--ink); }

        /* ── Rule / Divider ─────────────────────────────────── */
        hr {
            border: none;
            border-top: 1px solid var(--rule);
            margin: 2.5rem 0;
        }

        /* ── Cards & Panels ─────────────────────────────────── */
        .panel {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 4px;
            padding: 1.75rem;
        }

        .panel-dark {
            background: var(--code-bg);
            border: 1px solid #2a2c38;
            border-radius: 4px;
            padding: 1.75rem;
        }

        .panel-accent {
            background: #fff;
            border: 1px solid var(--rule);
            border-left: 3px solid var(--accent);
            border-radius: 0 4px 4px 0;
            padding: 1.25rem 1.5rem;
        }

        .panel-note {
            background: #faf8f4;
            border: 1px solid var(--rule);
            border-left: 3px solid #c8a84b;
            border-radius: 0 4px 4px 0;
            padding: 1.25rem 1.5rem;
        }

        .panel-success {
            background: #f4faf6;
            border: 1px solid #c2dccb;
            border-left: 3px solid #3a7a52;
            border-radius: 0 4px 4px 0;
            padding: 1.25rem 1.5rem;
        }

        /* ── Code blocks ────────────────────────────────────── */
        pre {
            border-radius: 4px;
            overflow-x: auto;
            margin: 0;
        }

        pre code.hljs {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.78rem;
            line-height: 1.7;
            border-radius: 4px;
        }

        .code-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--ink-muted);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .code-label::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            background: var(--rule);
            border-radius: 50%;
        }

        /* ── Grid layout helpers ────────────────────────────── */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (max-width: 900px) {
            .two-col { grid-template-columns: 1fr; }
            .sidebar { display: none; }
            .page-header, .content-area { padding-left: 1.5rem; padding-right: 1.5rem; }
        }

        /* ── Section headers ─────────────────────────────────── */
        .section-heading {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .section-heading h3 { margin: 0; }

        .section-index {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            color: var(--accent-dim);
            background: #fff3f3;
            border: 1px solid #f0d0d0;
            border-radius: 2px;
            padding: 0.2em 0.5em;
            flex-shrink: 0;
        }

        /* ── Table ───────────────────────────────────────────── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .data-table thead tr {
            background: var(--ink);
            color: #f0ece4;
        }

        .data-table thead th {
            padding: 0.7rem 1rem;
            text-align: left;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
        }

        .data-table thead th:first-child { border-radius: 3px 0 0 0; }
        .data-table thead th:last-child  { border-radius: 0 3px 0 0; }

        .data-table tbody tr {
            border-bottom: 1px solid var(--rule-soft);
            transition: background 0.1s;
        }

        .data-table tbody tr:hover { background: var(--paper-dark); }
        .data-table tbody tr.alt    { background: #faf8f4; }

        .data-table tbody td {
            padding: 0.7rem 1rem;
            color: var(--ink-soft);
            vertical-align: middle;
        }

        .data-table tbody td.mono {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.75rem;
            color: var(--ink-muted);
        }

        .data-table tbody td.strong { color: var(--ink); font-weight: 500; }

        /* ── Badges ──────────────────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3em;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            padding: 0.25em 0.6em;
            border-radius: 2px;
            font-weight: 500;
            letter-spacing: 0.03em;
        }

        .badge-green  { background: #ecf5ef; color: #2d6b47; border: 1px solid #c0ddc9; }
        .badge-amber  { background: #fdf5e6; color: #7a5c0a; border: 1px solid #e8d5a0; }
        .badge-red    { background: #fdf0f0; color: #7a2020; border: 1px solid #e8c0c0; }
        .badge-gray   { background: #f4f2ee; color: #5a5a5a; border: 1px solid #d8d4cc; }
        .badge-blue   { background: #f0f3fd; color: #2040a0; border: 1px solid #c0ccee; }
        .badge-start  { background: #f0f3fd; color: #2040a0; border: 1px solid #c0ccee; }
        .badge-end    { background: #fdf5e6; color: #7a5c0a; border: 1px solid #e8d5a0; }

        /* ── Directive legend pills ──────────────────────────── */
        .directive-legend {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        @media (max-width: 700px) {
            .directive-legend { grid-template-columns: repeat(2, 1fr); }
        }

        .directive-pill {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 3px;
            padding: 0.75rem 1rem;
            text-align: center;
        }

        .directive-pill code {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.7rem;
            color: var(--accent);
            background: none;
            border: none;
            padding: 0;
            margin-bottom: 0.3rem;
        }

        .directive-pill span {
            font-size: 0.72rem;
            color: var(--ink-muted);
        }

        /* ── Cycle flow ──────────────────────────────────────── */
        .cycle-flow {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.4rem;
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 4px;
            padding: 1rem 1.25rem;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.72rem;
        }

        .cycle-node {
            padding: 0.25em 0.6em;
            border-radius: 2px;
            font-weight: 500;
        }

        .cycle-arrow { color: var(--ink-muted); font-size: 0.65rem; }
        .node-blue   { background: #eef1fb; color: #2040a0; border: 1px solid #c8d0ee; }
        .node-amber  { background: #fdf5e6; color: #7a5c0a; border: 1px solid #e8d5a0; }
        .node-green  { background: #ecf5ef; color: #2d6b47; border: 1px solid #c0ddc9; }
        .node-purple { background: #f4f0fb; color: #5a2890; border: 1px solid #d0c0ec; }

        /* ── Rule grid ──────────────────────────────────────── */
        .rules-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.4rem;
        }

        @media (max-width: 600px) { .rules-grid { grid-template-columns: 1fr; } }

        .rule-chip {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 3px;
            padding: 0.5rem 0.75rem;
            font-size: 0.78rem;
            color: var(--ink-soft);
        }

        .rule-chip code {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.72rem;
            color: #2040a0;
            background: none;
            border: none;
            padding: 0;
        }

        /* ── Forms ───────────────────────────────────────────── */
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 0.35rem;
            letter-spacing: 0.01em;
        }

        .form-input {
            width: 100%;
            padding: 0.55rem 0.75rem;
            border: 1px solid var(--rule);
            border-radius: 3px;
            background: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            color: var(--ink);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-input:focus {
            border-color: var(--ink);
            box-shadow: 0 0 0 3px rgba(26,26,26,0.07);
        }

        .form-input.error {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(139,26,26,0.08);
        }

        .form-error {
            font-size: 0.75rem;
            color: var(--accent);
            margin-top: 0.3rem;
            font-family: 'IBM Plex Mono', monospace;
        }

        .btn-primary {
            width: 100%;
            background: var(--ink);
            color: #f0ece4;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.65rem 1.5rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-primary:hover {
            background: #2d2d2d;
            transform: translateY(-1px);
        }

        .btn-primary:active { transform: translateY(0); }

        /* ── Server info bar ─────────────────────────────────── */
        .info-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--code-bg);
            border: 1px solid #2a2c38;
            border-radius: 4px;
            padding: 0.75rem 1.25rem;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.72rem;
            color: #8888aa;
            margin-top: 1rem;
        }

        .info-bar span strong { color: #c0bcd4; }

        /* ── Status dot ──────────────────────────────────────── */
        .status-dot {
            display: inline-flex;
            align-items: center;
            gap: 0.4em;
            font-size: 0.78rem;
        }

        .dot-live {
            width: 7px;
            height: 7px;
            background: #3a9a5c;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.35; }
        }

        /* ── Page fade-in ────────────────────────────────────── */
        .content-area {
            animation: fadein 0.25s ease;
        }

        @keyframes fadein {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- ─── SIDEBAR ──────────────────────────────────────────── -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="wordmark">Guía Laravel</div>
            <div class="subtitle">Electivo Profesional I</div>
        </div>

        <div class="sidebar-section-label">Núcleos Temáticos</div>

        <nav>
            <a href="{{ route('nt1.index') }}" class="{{ request()->routeIs('nt1.*') ? 'active' : '' }}">
                <span class="nt-num">NT1</span> Introducción
            </a>
            <a href="{{ route('nt2.index') }}" class="{{ request()->routeIs('nt2.*') ? 'active' : '' }}">
                <span class="nt-num">NT2</span> Rutas y Controladores
            </a>
            <a href="{{ route('nt3.index') }}" class="{{ request()->routeIs('nt3.*') ? 'active' : '' }}">
                <span class="nt-num">NT3</span> Vistas y Blade
            </a>
            <a href="{{ route('nt4.index') }}" class="{{ request()->routeIs('nt4.*') ? 'active' : '' }}">
                <span class="nt-num">NT4</span> Eloquent ORM
            </a>
            <a href="{{ route('nt5.index') }}" class="{{ request()->routeIs('nt5.*') ? 'active' : '' }}">
                <span class="nt-num">NT5</span> Formularios
            </a>
        </nav>

        <div class="sidebar-footer" style="">
            UNACH &copy; 2026
        </div>
    </aside>

    <!-- ─── MAIN ─────────────────────────────────────────────── -->
    <main class="main-content">

        <header class="page-header">
            <div class="nt-tag">@yield('title', 'Guía Laravel')</div>
            <h2>@yield('header')</h2>
        </header>

        <div class="content-area">
            @yield('content')
        </div>

    </main>

</body>
</html>