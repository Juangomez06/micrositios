<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} — @yield('title', 'Inicio')</title>
    <meta name="description" content="@yield('description', config('app.name'))">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-display: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
            --color-ink: #0d0d0d;
            --color-paper: #fafaf8;
            --color-accent: #e8ff3e;
            --color-accent-dark: #c8df00;
            --color-muted: #6b6b6b;
            --color-border: #e5e5e0;
            --radius-sm: 6px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-full: 9999px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: var(--font-body);
            background-color: var(--color-paper);
            color: var(--color-ink);
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, h5 {
            font-family: var(--font-display);
            line-height: 1.1;
            letter-spacing: -0.02em;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: var(--radius-full);
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.01em;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .btn-primary {
            background: var(--color-accent);
            color: var(--color-ink);
            border-color: var(--color-accent);
        }
        .btn-primary:hover {
            background: var(--color-accent-dark);
            border-color: var(--color-accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(232,255,62,0.4);
        }
        .btn-outline {
            background: transparent;
            color: white;
            border-color: rgba(255,255,255,0.4);
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.8);
        }
        .btn-secondary {
            background: var(--color-ink);
            color: white;
            border-color: var(--color-ink);
        }
        .btn-secondary:hover {
            background: #333;
            transform: translateY(-2px);
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Barra de admin — solo visible si hay sesión activa --}}
    @auth
    <div style="background:#0d0d0d;padding:8px 24px;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-body);font-size:0.8rem;position:sticky;top:0;z-index:9999;">
        <span style="color:#888;">👁 Vista previa como administrador</span>
        <div style="display:flex;gap:16px;align-items:center;">
            <a href="{{ route('admin.header.edit') }}"
               style="color:var(--color-accent);font-weight:600;text-decoration:none;">
                ✏️ Editar Header
            </a>
            <a href="{{ route('dashboard') }}" style="color:#aaa;text-decoration:none;">
                Dashboard →
            </a>
        </div>
    </div>
    @endauth

    @yield('content')

    @stack('scripts')
</body>
</html>
