{{--
    resources/views/admin/header/edit.blade.php
    Panel de administración para editar el Header/Hero de la Landing Page.
    Ruta: GET /admin/header/edit → admin.header.edit
--}}

@php $title = 'Editar Header Landing'; @endphp

<x-layouts::app.sidebar :title="$title">
<flux:main>
<style>

/* ── Admin Page Layout ── */
.admin-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: 32px 24px 80px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
    gap: 16px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.82rem;
    color: #6b6b6b;
    margin-bottom: 8px;
}

.breadcrumb a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb a:hover { color: #0d0d0d; }

.page-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: #0d0d0d;
    margin: 0 0 4px;
    letter-spacing: -0.02em;
}

.page-desc {
    color: #6b6b6b;
    font-size: 0.9rem;
    margin: 0;
}

.btn-preview {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border: 1.5px solid #e5e5e0;
    border-radius: 9999px;
    color: #0d0d0d;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.2s;
    white-space: nowrap;
}

.btn-preview:hover {
    background: #0d0d0d;
    color: white;
    border-color: #0d0d0d;
}

/* ── Alert ── */
.alert {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-size: 0.9rem;
    font-weight: 500;
}

.alert-success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
}

.alert-close {
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    line-height: 1;
}

/* ── Form Layout ── */
.form-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 24px;
    align-items: start;
}

/* ── Form Card ── */
.form-card {
    background: white;
    border: 1px solid #e5e5e0;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 24px;
}

.form-card:last-child { margin-bottom: 0; }

.sidebar-card { margin-bottom: 20px; }

.form-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px 24px;
    border-bottom: 1px solid #f0f0ec;
    background: #fafaf8;
}

.form-card-icon {
    font-size: 1.4rem;
    flex-shrink: 0;
}

.form-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #0d0d0d;
    margin: 0 0 2px;
    letter-spacing: -0.01em;
}

.form-card-desc {
    font-size: 0.82rem;
    color: #6b6b6b;
    margin: 0;
}

.form-body {
    padding: 24px;
}

/* ── Form Elements ── */
.form-group { margin-bottom: 20px; }
.form-group:last-child { margin-bottom: 0; }

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #0d0d0d;
    margin-bottom: 8px;
}

.required { color: #ef4444; }

.badge-optional {
    font-size: 0.7rem;
    font-weight: 500;
    background: #f0f0ec;
    color: #6b6b6b;
    padding: 2px 8px;
    border-radius: 9999px;
}

.form-input {
    display: block;
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e5e5e0;
    border-radius: 10px;
    font-size: 0.9rem;
    color: #0d0d0d;
    background: white;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
    font-family: inherit;
}

.form-input:focus {
    border-color: #0d0d0d;
    box-shadow: 0 0 0 3px rgba(13,13,13,0.08);
}

.form-input.is-invalid { border-color: #ef4444; }

.form-textarea {
    resize: vertical;
    min-height: 72px;
    line-height: 1.5;
}

.form-hint {
    font-size: 0.78rem;
    color: #9b9b90;
    margin: 6px 0 0;
    line-height: 1.4;
}

.form-error {
    font-size: 0.8rem;
    color: #ef4444;
    margin: 6px 0 0;
    display: flex;
    align-items: center;
    gap: 4px;
}

.form-error::before { content: '⚠️'; font-size: 0.7rem; }

.char-counter {
    font-size: 0.75rem;
    color: #9b9b90;
    text-align: right;
    margin-top: 4px;
}

.form-divider {
    border: none;
    border-top: 1px solid #f0f0ec;
    margin: 20px 0;
}

/* ── Upload Zone ── */
.upload-zone {
    position: relative;
    border: 2px dashed #e5e5e0;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    min-height: 120px;
}

.upload-zone:hover {
    border-color: #0d0d0d;
    background: #fafaf8;
}

/* El label cubre toda la zona — es él quien recibe el click */
.upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 24px;
    gap: 8px;
    min-height: 120px;
    cursor: pointer;
    width: 100%;
}

/* Input oculto pero funcional — dentro del label */
.upload-input {
    display: none;
}

.upload-ui {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    pointer-events: none;
    width: 100%;
}

.upload-icon { font-size: 2rem; }

.upload-hint {
    font-size: 0.82rem;
    color: #6b6b6b;
    text-align: center;
    margin: 0;
    line-height: 1.5;
}

.upload-preview {
    width: 64px;
    height: 64px;
    object-fit: contain;
    border-radius: 8px;
}

.upload-preview--wide {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.upload-actions {
    margin-top: 8px;
}

.btn-danger-sm {
    background: none;
    border: 1px solid #fca5a5;
    color: #ef4444;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-danger-sm:hover {
    background: #fef2f2;
}

/* ── Style Picker ── */
.style-picker {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.style-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border: 1.5px solid #e5e5e0;
    border-radius: 10px;
    cursor: pointer;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.2s;
}

.style-option:hover { border-color: #aaa; }

.style-option.is-selected,
.style-option:has(input:checked) {
    border-color: #0d0d0d;
    background: #0d0d0d;
    color: white;
}

.style-option input { display: none; }

/* ── Toggle Switch ── */
.toggle-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 20px;
}

.toggle-switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 26px;
    flex-shrink: 0;
}

.toggle-switch input { display: none; }

.toggle-slider {
    position: absolute;
    inset: 0;
    background: #e5e5e0;
    border-radius: 9999px;
    transition: background 0.2s;
    cursor: pointer;
}

.toggle-slider::before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    top: 3px;
    left: 3px;
    transition: transform 0.2s;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}

.toggle-switch input:checked + .toggle-slider {
    background: #0d0d0d;
}

.toggle-switch input:checked + .toggle-slider::before {
    transform: translateX(22px);
}

.last-updated {
    font-size: 0.78rem;
    color: #9b9b90;
    display: flex;
    gap: 6px;
    align-items: flex-start;
    line-height: 1.5;
    margin-bottom: 20px;
}

/* ── Save Button ── */
.btn-save {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 14px;
    background: #0d0d0d;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
    letter-spacing: -0.01em;
}

.btn-save:hover {
    background: #333;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.btn-save:active { transform: none; }

.btn-preview-full {
    display: block;
    text-align: center;
    margin-top: 12px;
    padding: 10px;
    border: 1.5px solid #e5e5e0;
    border-radius: 10px;
    color: #6b6b6b;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-preview-full:hover {
    border-color: #0d0d0d;
    color: #0d0d0d;
}

/* ── Color Picker ── */
/* ── Custom Color Picker ── */
.custom-color-picker {
    display: flex;
    align-items: center;
    gap: 10px;
}

.ccp-preview {
    width: 48px;
    height: 42px;
    border-radius: 10px;
    border: 1.5px solid #e5e5e0;
    flex-shrink: 0;
    cursor: pointer;
    transition: border-color 0.2s, transform 0.15s;
}

.ccp-preview:hover {
    border-color: #0d0d0d;
    transform: scale(1.05);
}

.ccp-text {
    flex: 1;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.ccp-swatches {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 10px;
}

.ccp-swatch {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    border: 2px solid transparent;
    cursor: pointer;
    transition: transform 0.15s, border-color 0.15s;
    padding: 0;
}

.ccp-swatch:hover {
    transform: scale(1.2);
    border-color: rgba(0,0,0,0.3);
}

.ccp-swatch.is-active {
    border-color: #0d0d0d;
    transform: scale(1.15);
    box-shadow: 0 0 0 2px white, 0 0 0 4px #0d0d0d;
}

/* ── Range ── */
.form-range {
    width: 100%;
    accent-color: #0d0d0d;
    cursor: pointer;
}

.range-labels {
    display: flex;
    justify-content: space-between;
    font-size: 0.72rem;
    color: #9b9b90;
    margin-top: 4px;
}

/* ── Responsive ── */
@media (max-width: 900px) {
    .form-layout {
        grid-template-columns: 1fr;
    }

    .form-sidebar {
        order: -1;
    }

    .form-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .admin-page { padding: 20px 16px 60px; }
    .page-header { flex-direction: column; }
    .style-picker { flex-direction: column; }
}


@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

</style>
<script>

// ══════════════════════════════════════════════════════
// 1. PREVIEW DE IMÁGENES — instantáneo con createObjectURL
// ══════════════════════════════════════════════════════
function setupImagePreview(inputId, uiContainerId, isWide) {
    const input = document.getElementById(inputId);
    const container = document.getElementById(uiContainerId);
    if (!input || !container) return;

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        // Validar tamaño al instante, sin leer el archivo
        const maxMB = isWide ? 5 : 2;
        if (file.size > maxMB * 1024 * 1024) {
            alert('Archivo demasiado grande. Máximo ' + maxMB + 'MB.');
            this.value = '';
            return;
        }

        // createObjectURL es INSTANTÁNEO — no lee el archivo en memoria
        const objectUrl = URL.createObjectURL(file);

        const imgStyle = isWide
            ? 'width:100%;height:120px;object-fit:cover;border-radius:8px;display:block;'
            : 'width:64px;height:64px;object-fit:contain;border-radius:8px;display:block;margin:0 auto;';

        container.innerHTML = `
            <img src="${objectUrl}"
                 style="${imgStyle}"
                 alt="Vista previa"
                 onload="URL.revokeObjectURL(this.src)">
            <p style="margin:6px 0 0;font-size:0.78rem;color:#22c55e;font-weight:600;text-align:center;">
                ✅ ${file.name}
            </p>
        `;

        // Resaltar la zona de upload
        const zone = input.closest('.upload-zone');
        if (zone) {
            zone.style.borderColor = '#22c55e';
            zone.style.borderStyle = 'solid';
        }
    });
}

setupImagePreview('logo', 'logoUI', false);
setupImagePreview('bg_image', 'bgUI', true);

// ══════════════════════════════════════════════════════
// 2. CONTADOR DE CARACTERES
// ══════════════════════════════════════════════════════
const titleInput = document.getElementById('hero_title');
const titleCount = document.getElementById('titleCount');
if (titleInput && titleCount) {
    titleInput.addEventListener('input', () => {
        const len = titleInput.value.length;
        titleCount.textContent = len;
        titleCount.style.color = len > 100 ? '#ef4444' : '#9b9b90';
    });
}

// ══════════════════════════════════════════════════════
// 3. CUSTOM COLOR PICKER — swatches + input de texto
// ══════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', function () {
    const preview  = document.getElementById('ccpPreview');
    const text     = document.getElementById('bg_color_text');
    const hidden   = document.getElementById('bg_color');
    const swatches = document.querySelectorAll('.ccp-swatch');

    if (!preview || !text || !hidden) return;

    function isValidHex(val) {
        return /^#([0-9A-Fa-f]{6})$/.test(val);
    }

    function applyColor(hex) {
        hex = hex.toLowerCase();
        if (!isValidHex(hex)) return;

        preview.style.background = hex;
        hidden.value  = hex;
        text.value    = hex.toUpperCase();
        text.style.outline = '';

        swatches.forEach(s => {
            s.classList.toggle('is-active', s.dataset.color === hex);
        });
    }

    // ── Click en swatch ──────────────────────────────
    swatches.forEach(swatch => {
        swatch.addEventListener('click', () => {
            applyColor(swatch.dataset.color);
        });
    });

    // ── Escritura manual en el input ─────────────────
    text.addEventListener('input', () => {
        let val = text.value.trim();
        if (val.length > 0 && val[0] !== '#') {
            val = '#' + val;
            text.value = val;
        }
        if (isValidHex(val)) {
            preview.style.background = val;
            hidden.value = val;
            swatches.forEach(s => s.classList.toggle('is-active', s.dataset.color === val.toLowerCase()));
            text.style.outline = '2px solid #22c55e';
            text.style.outlineOffset = '-2px';
        } else {
            text.style.outline = val.length > 2 ? '2px solid #ef4444' : '';
            text.style.outlineOffset = '-2px';
        }
    });

    // ── Blur — normalizar ────────────────────────────
    text.addEventListener('blur', () => {
        let val = text.value.trim();
        if (val && !val.startsWith('#')) val = '#' + val;
        if (isValidHex(val)) {
            applyColor(val);
        } else {
            text.value = hidden.value.toUpperCase();
        }
        text.style.outline = '';
    });

    // ── Click en preview → picker nativo ────────────
    preview.addEventListener('click', () => {
        const tmp = document.createElement('input');
        tmp.type  = 'color';
        tmp.value = hidden.value || '#0f172a';
        Object.assign(tmp.style, { position:'fixed', opacity:'0', width:'0', height:'0', top:'0', left:'0' });
        document.body.appendChild(tmp);
        tmp.click();
        tmp.addEventListener('change', () => {
            applyColor(tmp.value);
            tmp.remove();
        });
        tmp.addEventListener('blur', () => setTimeout(() => tmp.remove(), 500));
    });

    // ── Estado inicial ───────────────────────────────
    const initialColor = hidden.value || '#0f172a';
    applyColor(initialColor);
});

// ══════════════════════════════════════════════════════
// 4. SLIDER OPACIDAD
// ══════════════════════════════════════════════════════
(function () {
    const slider = document.getElementById('bg_overlay_opacity');
    const label  = document.getElementById('opacityValue');
    if (!slider || !label) return;

    slider.addEventListener('input', () => {
        label.textContent = parseFloat(slider.value).toFixed(2);
    });
})();

// ══════════════════════════════════════════════════════
// 5. STYLE PICKER (botones CTA)
// ══════════════════════════════════════════════════════
document.querySelectorAll('.style-option').forEach(option => {
    option.addEventListener('click', () => {
        document.querySelectorAll('.style-option').forEach(o => o.classList.remove('is-selected'));
        option.classList.add('is-selected');
    });
});

// ── Loading state al guardar ──
const form    = document.getElementById('headerForm');
const saveBtn = document.getElementById('saveBtn');

form?.addEventListener('submit', () => {
    saveBtn.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" style="animation:spin 1s linear infinite">
            <path d="M21 12a9 9 0 11-6.219-8.56"/>
        </svg>
        Guardando...
    `;
    saveBtn.disabled = true;
});

</script>
<div class="admin-page">

    {{-- ── Page Header ── --}}
    <div class="page-header">
        <div>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Editar Header Landing</span>
            </nav>
            <h1 class="page-title">Header de la Landing Page</h1>
            <p class="page-desc">Los cambios se reflejan inmediatamente en la página pública.</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('home') }}" target="_blank" class="btn-preview" rel="noopener">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                    <polyline points="15 3 21 3 21 9"/>
                    <line x1="10" y1="14" x2="21" y2="3"/>
                </svg>
                Ver landing
            </a>
        </div>
    </div>

    {{-- ── Mensaje de éxito ── --}}
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="alert-close" aria-label="Cerrar">×</button>
    </div>
    @endif

    {{-- ── Formulario principal ── --}}
    <form action="{{ route('admin.header.update') }}"
          method="POST"
          enctype="multipart/form-data"
          id="headerForm"
          novalidate>
        @csrf
        @method('PUT')

        <div class="form-layout">

            {{-- ══ COLUMNA PRINCIPAL ══ --}}
            <div class="form-main">

                {{-- ── Card: Identidad del sitio ── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-icon">🏷️</div>
                        <div>
                            <h2 class="form-card-title">Identidad del sitio</h2>
                            <p class="form-card-desc">Nombre y logo que aparecen en la barra de navegación.</p>
                        </div>
                    </div>

                    <div class="form-body">
                        {{-- Nombre del sitio --}}
                        <div class="form-group">
                            <label for="site_name" class="form-label">
                                Nombre del sitio <span class="required">*</span>
                            </label>
                            <input type="text"
                                   id="site_name"
                                   name="site_name"
                                   value="{{ old('site_name', $header->site_name) }}"
                                   class="form-input @error('site_name') is-invalid @enderror"
                                   placeholder="Mi Tienda Online"
                                   maxlength="80"
                                   required>
                            @error('site_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="form-group">
                            <label class="form-label">Logo del sitio</label>
                            <div class="upload-zone" id="logoZone">
                                <label class="upload-label" for="logo">
                                    <input type="file"
                                           id="logo"
                                           name="logo"
                                           class="upload-input @error('logo') is-invalid @enderror"
                                           accept="image/png,image/jpeg,image/svg+xml,image/webp"
                                           aria-describedby="logo-help">
                                    <div class="upload-ui" id="logoUI">
                                        @if($header->logo_url)
                                            <img src="{{ $header->logo_url }}"
                                                 alt="Logo actual"
                                                 class="upload-preview"
                                                 id="logoPreview"
                                                 style="width:64px;height:64px;object-fit:contain;border-radius:8px;">
                                            <p class="upload-hint" style="margin:0;font-size:0.82rem;color:#6b6b6b;">Logo actual • Click para cambiar</p>
                                        @else
                                            <div class="upload-icon">📁</div>
                                            <p class="upload-hint" style="margin:0;font-size:0.82rem;color:#6b6b6b;text-align:center;">
                                                Click para subir logo<br>
                                                <small>PNG, JPG, SVG, WEBP • Máx. 2MB</small>
                                            </p>
                                        @endif
                                    </div>
                                </label>
                            </div>

                            @if($header->logo_path)
                            <div class="upload-actions">
                                <button type="button" class="btn-danger-sm"
                                        onclick="if(confirm('¿Eliminar el logo actual?')) document.getElementById('form-remove-logo').submit()">
                                    🗑 Eliminar logo
                                </button>
                            </div>
                            @endif

                            @error('logo')
                                <p class="form-error">{{ $message }}</p>
                            @enderror

                            <p id="logo-help" class="form-hint">
                                Recomendado: PNG con fondo transparente, mínimo 200×200px.
                            </p>
                        </div>

                        {{-- Alt del logo --}}
                        <div class="form-group">
                            <label for="logo_alt" class="form-label">Texto alternativo del logo</label>
                            <input type="text"
                                   id="logo_alt"
                                   name="logo_alt"
                                   value="{{ old('logo_alt', $header->logo_alt) }}"
                                   class="form-input"
                                   placeholder="Logo de Mi Tienda"
                                   maxlength="100">
                            <p class="form-hint">Para accesibilidad (lectores de pantalla).</p>
                        </div>
                    </div>
                </div>

                {{-- ── Card: Contenido Hero ── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-icon">✨</div>
                        <div>
                            <h2 class="form-card-title">Contenido principal (Hero)</h2>
                            <p class="form-card-desc">El mensaje central que verán tus visitantes al entrar.</p>
                        </div>
                    </div>

                    <div class="form-body">
                        {{-- Badge opcional --}}
                        <div class="form-group">
                            <label for="badge_text" class="form-label">
                                Badge / Tag destacado
                                <span class="badge-optional">Opcional</span>
                            </label>
                            <input type="text"
                                   id="badge_text"
                                   name="badge_text"
                                   value="{{ old('badge_text', $header->badge_text) }}"
                                   class="form-input"
                                   placeholder="🔥 Ofertas de temporada"
                                   maxlength="80">
                            <p class="form-hint">Aparece sobre el título como un tag pequeño.</p>
                        </div>

                        {{-- Título principal --}}
                        <div class="form-group">
                            <label for="hero_title" class="form-label">
                                Título principal <span class="required">*</span>
                            </label>
                            <textarea id="hero_title"
                                      name="hero_title"
                                      class="form-input form-textarea @error('hero_title') is-invalid @enderror"
                                      placeholder="Descubre productos increíbles"
                                      maxlength="120"
                                      rows="2"
                                      required>{{ old('hero_title', $header->hero_title) }}</textarea>
                            <div class="char-counter">
                                <span id="titleCount">{{ strlen(old('hero_title', $header->hero_title ?? '')) }}</span>/120
                            </div>
                            @error('hero_title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Subtítulo --}}
                        <div class="form-group">
                            <label for="hero_subtitle" class="form-label">Subtítulo</label>
                            <input type="text"
                                   id="hero_subtitle"
                                   name="hero_subtitle"
                                   value="{{ old('hero_subtitle', $header->hero_subtitle) }}"
                                   class="form-input"
                                   placeholder="Calidad, precio y entrega rápida"
                                   maxlength="180">
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group">
                            <label for="hero_description" class="form-label">Descripción</label>
                            <textarea id="hero_description"
                                      name="hero_description"
                                      class="form-input form-textarea"
                                      placeholder="Un párrafo breve que describa tu propuesta de valor..."
                                      maxlength="500"
                                      rows="3">{{ old('hero_description', $header->hero_description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ── Card: Botones CTA ── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-icon">🎯</div>
                        <div>
                            <h2 class="form-card-title">Llamados a la acción (CTA)</h2>
                            <p class="form-card-desc">Los botones que guían al visitante a actuar.</p>
                        </div>
                    </div>

                    <div class="form-body">
                        <div class="form-row">
                            {{-- Texto CTA Principal --}}
                            <div class="form-group">
                                <label for="cta_text" class="form-label">
                                    Texto del botón principal <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="cta_text"
                                       name="cta_text"
                                       value="{{ old('cta_text', $header->cta_text) }}"
                                       class="form-input @error('cta_text') is-invalid @enderror"
                                       placeholder="Ver catálogo"
                                       maxlength="60"
                                       required>
                                @error('cta_text')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Link CTA Principal --}}
                            <div class="form-group">
                                <label for="cta_link" class="form-label">
                                    Enlace del botón principal <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="cta_link"
                                       name="cta_link"
                                       value="{{ old('cta_link', $header->cta_link) }}"
                                       class="form-input @error('cta_link') is-invalid @enderror"
                                       placeholder="#productos o /tienda"
                                       maxlength="255"
                                       required>
                                @error('cta_link')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Estilo del botón --}}
                        <div class="form-group">
                            <label class="form-label">Estilo del botón principal</label>
                            <div class="style-picker">
                                @foreach(['primary' => '⭐ Primary (amarillo)', 'secondary' => '⚫ Secondary (negro)', 'outline' => '⬜ Outline (transparente)'] as $val => $label)
                                <label class="style-option {{ old('cta_style', $header->cta_style) === $val ? 'is-selected' : '' }}">
                                    <input type="radio" name="cta_style" value="{{ $val }}"
                                           {{ old('cta_style', $header->cta_style) === $val ? 'checked' : '' }}>
                                    <span>{{ $label }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <hr class="form-divider">

                        <div class="form-row">
                            {{-- CTA Secundario --}}
                            <div class="form-group">
                                <label for="cta_secondary_text" class="form-label">
                                    Texto del botón secundario
                                    <span class="badge-optional">Opcional</span>
                                </label>
                                <input type="text"
                                       id="cta_secondary_text"
                                       name="cta_secondary_text"
                                       value="{{ old('cta_secondary_text', $header->cta_secondary_text) }}"
                                       class="form-input"
                                       placeholder="Saber más"
                                       maxlength="60">
                            </div>

                            <div class="form-group">
                                <label for="cta_secondary_link" class="form-label">Enlace del botón secundario</label>
                                <input type="text"
                                       id="cta_secondary_link"
                                       name="cta_secondary_link"
                                       value="{{ old('cta_secondary_link', $header->cta_secondary_link) }}"
                                       class="form-input"
                                       placeholder="#nosotros"
                                       maxlength="255">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ══ COLUMNA LATERAL ══ --}}
            <aside class="form-sidebar">

                {{-- ── Card: Publicar / Estado ── --}}
                <div class="form-card sidebar-card">
                    <div class="form-card-header">
                        <div class="form-card-icon">📢</div>
                        <h2 class="form-card-title">Publicación</h2>
                    </div>
                    <div class="form-body">
                        <label class="toggle-row">
                            <div>
                                <strong>Header activo</strong>
                                <p class="form-hint" style="margin:0;">Visible en la landing pública.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1"
                                       {{ old('is_active', $header->is_active) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </label>

                        @if($header->updated_at)
                        <div class="last-updated">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Última actualización:<br>
                            <strong>{{ $header->updated_at->diffForHumans() }}</strong>
                            @if($header->editor)
                                por {{ $header->editor->name }}
                            @endif
                        </div>
                        @endif

                        <button type="submit" class="btn-save" id="saveBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/>
                                <polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Guardar cambios
                        </button>

                        <a href="{{ route('home') }}" target="_blank" class="btn-preview-full">
                            Ver landing →
                        </a>
                    </div>
                </div>

                {{-- ── Card: Imagen de fondo ── --}}
                <div class="form-card sidebar-card">
                    <div class="form-card-header">
                        <div class="form-card-icon">🖼️</div>
                        <h2 class="form-card-title">Fondo del Hero</h2>
                    </div>
                    <div class="form-body">
                        {{-- Imagen de fondo --}}
                        <div class="form-group">
                            <label class="form-label">Imagen de fondo</label>
                            <div class="upload-zone upload-zone--bg" id="bgZone">
                                <label class="upload-label" for="bg_image">
                                    <input type="file"
                                           id="bg_image"
                                           name="bg_image"
                                           class="upload-input"
                                           accept="image/png,image/jpeg,image/webp">
                                    <div class="upload-ui" id="bgUI">
                                        @if($header->bg_image_url)
                                            <img src="{{ $header->bg_image_url }}"
                                                 alt="Fondo actual"
                                                 id="bgPreview"
                                                 style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                                            <p class="upload-hint" style="margin:0;font-size:0.82rem;color:#6b6b6b;">Click para cambiar imagen</p>
                                        @else
                                            <div class="upload-icon">🏞️</div>
                                            <p class="upload-hint" style="margin:0;font-size:0.82rem;color:#6b6b6b;text-align:center;">
                                                Click para subir imagen de fondo<br>
                                                <small>PNG, JPG, WEBP • Máx. 5MB</small>
                                            </p>
                                        @endif
                                    </div>
                                </label>
                            </div>

                            @if($header->bg_image_path)
                            <div style="margin-top:8px">
                                <button type="button" class="btn-danger-sm"
                                        onclick="if(confirm('¿Eliminar la imagen de fondo?')) document.getElementById('form-remove-bg').submit()">
                                    🗑 Eliminar imagen
                                </button>
                            </div>
                            @endif

                            @error('bg_image')
                                <p class="form-error" style="margin-top:8px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Color de fondo --}}
                        @php
                            $bgColorVal = old('bg_color', $header->bg_color ?? '#0f172a');
                            if (!str_starts_with($bgColorVal, '#')) {
                                $bgColorVal = '#' . $bgColorVal;
                            }
                        @endphp
                        <div class="form-group">
                            <label class="form-label">Color de fondo (fallback)</label>

                            {{-- Custom color picker — no depende del picker nativo --}}
                            <div class="custom-color-picker" id="customColorPicker">
                                <div class="ccp-preview" id="ccpPreview"
                                     style="background:{{ $bgColorVal }}"></div>
                                <input type="text"
                                       id="bg_color_text"
                                       class="form-input ccp-text"
                                       value="{{ strtoupper($bgColorVal) }}"
                                       maxlength="7"
                                       placeholder="#0F172A"
                                       autocomplete="off"
                                       spellcheck="false">
                                <input type="hidden"
                                       id="bg_color"
                                       name="bg_color"
                                       value="{{ $bgColorVal }}">
                            </div>

                            {{-- Paleta de colores rápidos --}}
                            <div class="ccp-swatches">
                                @foreach(['#0f172a','#1e293b','#7c3aed','#db2777','#dc2626','#d97706','#16a34a','#0284c7','#ffffff','#000000'] as $sw)
                                <button type="button"
                                        class="ccp-swatch"
                                        data-color="{{ $sw }}"
                                        style="background:{{ $sw }}"
                                        title="{{ $sw }}"
                                        aria-label="Color {{ $sw }}"></button>
                                @endforeach
                            </div>

                            <p class="form-hint">Se usa cuando no hay imagen de fondo.</p>
                        </div>

                        {{-- Opacidad del overlay --}}
                        <div class="form-group">
                            <label for="bg_overlay_opacity" class="form-label">
                                Oscuridad del overlay:
                                <strong id="opacityValue">{{ old('bg_overlay_opacity', $header->bg_overlay_opacity ?? 0.55) }}</strong>
                            </label>
                            <input type="range"
                                   id="bg_overlay_opacity"
                                   name="bg_overlay_opacity"
                                   min="0" max="1" step="0.05"
                                   value="{{ old('bg_overlay_opacity', $header->bg_overlay_opacity ?? 0.55) }}"
                                   class="form-range"
                                   aria-describedby="opacity-help">
                            <div class="range-labels" aria-hidden="true">
                                <span>Transparente</span>
                                <span>Muy oscuro</span>
                            </div>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </form>

</div>



{{-- Formularios de eliminación FUERA del form principal (HTML no permite forms anidados) --}}
@if($header->logo_path)
<form id="form-remove-logo"
      action="{{ route('admin.header.remove-logo') }}"
      method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>
@endif

@if($header->bg_image_path)
<form id="form-remove-bg"
      action="{{ route('admin.header.remove-bg-image') }}"
      method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>
@endif


</flux:main>
</x-layouts::app.sidebar>
