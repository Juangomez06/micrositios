@php $title = 'Dashboard'; @endphp

<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div style="max-width: 960px; margin: 0 auto; padding: 32px 24px;">

            {{-- Saludo --}}
            <div style="margin-bottom: 32px;">
                <h1 style="font-size:1.6rem; font-weight:800; letter-spacing:-0.02em; margin:0 0 4px;">
                    Bienvenido, {{ auth()->user()->name }} 👋
                </h1>
                <p style="color:#6b6b6b; font-size:0.9rem; margin:0;">
                    Panel de administración — {{ config('app.name') }}
                </p>
            </div>

            {{-- Módulos --}}
            <h2 style="font-size:0.75rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:#9b9b90; margin:0 0 16px;">
                Módulos disponibles
            </h2>

            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:16px;">

                {{-- Card: Editar Header Landing --}}
                <a href="{{ route('admin.header.edit') }}"
                   style="display:block; text-decoration:none; border:1.5px solid #e5e5e0; border-radius:16px; padding:24px; background:white; transition:all 0.2s;"
                   onmouseover="this.style.borderColor='#0d0d0d'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'"
                   onmouseout="this.style.borderColor='#e5e5e0'; this.style.transform=''; this.style.boxShadow=''">
                    <div style="width:44px;height:44px;border-radius:12px;background:#0d0d0d;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:16px;">✏️</div>
                    <h3 style="font-size:1rem;font-weight:700;color:#0d0d0d;margin:0 0 6px;">Header Landing</h3>
                    <p style="font-size:0.82rem;color:#6b6b6b;margin:0;line-height:1.5;">Edita título, subtítulo, botones e imagen de fondo de la landing page.</p>
                    <div style="margin-top:16px;font-size:0.78rem;font-weight:600;color:#0d0d0d;display:flex;align-items:center;gap:4px;">
                        Editar ahora
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </a>

                {{-- Card: Ver Landing --}}
                <a href="{{ route('home') }}" target="_blank" rel="noopener"
                   style="display:block;text-decoration:none;border:1.5px solid #e5e5e0;border-radius:16px;padding:24px;background:white;transition:all 0.2s;"
                   onmouseover="this.style.borderColor='#0d0d0d'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'"
                   onmouseout="this.style.borderColor='#e5e5e0'; this.style.transform=''; this.style.boxShadow=''">
                    <div style="width:44px;height:44px;border-radius:12px;background:#e8ff3e;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:16px;">🌐</div>
                    <h3 style="font-size:1rem;font-weight:700;color:#0d0d0d;margin:0 0 6px;">Ver Landing Page</h3>
                    <p style="font-size:0.82rem;color:#6b6b6b;margin:0;line-height:1.5;">Vista previa de la página pública tal como la ven tus visitantes.</p>
                    <div style="margin-top:16px;font-size:0.78rem;font-weight:600;color:#0d0d0d;display:flex;align-items:center;gap:4px;">
                        Abrir en nueva pestaña
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </div>
                </a>

            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
