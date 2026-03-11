{{--
    Componente: components/landing/header.blade.php
    Uso: <x-landing.header :header="$header" />
--}}

@props(['header'])

@php
    // Fondo del hero — imagen tiene prioridad sobre color
    $hasBgImage = !empty($header->bg_image_url);
    $bgColor    = $header->bg_color_safe;   // accessor con fallback #0f172a
    $overlay    = $header->overlay_safe;    // accessor con fallback 0.55

    if ($hasBgImage) {
        $bgStyle = "background-image:url('{$header->bg_image_url}');background-size:cover;background-position:center;background-color:{$bgColor};";
    } else {
        $bgStyle = "background-color:{$bgColor};";
    }
@endphp

<header class="landing-header" style="{{ $bgStyle }}" id="inicio">

    {{-- Overlay de oscuridad sobre la imagen de fondo --}}
    @if($hasBgImage)
    <div class="header-overlay" style="--overlay-opacity:{{ $overlay }}"></div>
    @endif

    {{-- ── Navbar ── --}}
    <nav class="header-nav" role="navigation" aria-label="Navegación principal">
        <div class="nav-container">

            <a href="{{ route('home') }}" class="nav-brand">
                @if($header->logo_url)
                    <img src="{{ $header->logo_url }}"
                         alt="{{ $header->logo_alt ?? '' }}"
                         class="nav-logo"
                         width="40" height="40">
                @endif
                <span class="nav-site-name">{{ $header->site_name }}</span>
            </a>

            <ul class="nav-links" role="list">
                <li><a href="#productos" class="nav-link">Productos</a></li>
                <li><a href="#beneficios" class="nav-link">Beneficios</a></li>
                <li><a href="#contacto" class="nav-link">Contacto</a></li>
            </ul>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Ingresar</a>
                @endauth
            </div>

            <button class="nav-toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div class="nav-mobile" id="navMobile" aria-hidden="true">
            <ul role="list">
                <li><a href="#productos" class="nav-link">Productos</a></li>
                <li><a href="#beneficios" class="nav-link">Beneficios</a></li>
                <li><a href="#contacto" class="nav-link">Contacto</a></li>
            </ul>
        </div>
    </nav>

    {{-- ── Hero Content ── --}}
    <div class="hero-content">

        @if($header->badge_text)
        <div class="hero-badge" data-animate="fade-up">
            {{ $header->badge_text }}
        </div>
        @endif

        <h1 class="hero-title" data-animate="fade-up" data-delay="100">
            {!! nl2br(e($header->hero_title)) !!}
        </h1>

        @if($header->hero_subtitle)
        <p class="hero-subtitle" data-animate="fade-up" data-delay="200">
            {{ $header->hero_subtitle }}
        </p>
        @endif

        @if($header->hero_description)
        <p class="hero-description" data-animate="fade-up" data-delay="300">
            {{ $header->hero_description }}
        </p>
        @endif

        <div class="hero-actions" data-animate="fade-up" data-delay="400">
            <a href="{{ $header->cta_link }}" class="btn btn-{{ $header->cta_style ?? 'primary' }}">
                {{ $header->cta_text }}
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            @if($header->cta_secondary_text && $header->cta_secondary_link)
            <a href="{{ $header->cta_secondary_link }}" class="btn btn-outline">
                {{ $header->cta_secondary_text }}
            </a>
            @endif
        </div>

        <div class="hero-scroll-indicator" aria-hidden="true">
            <span>Desliza para explorar</span>
            <div class="scroll-dot"></div>
        </div>
    </div>

</header>

@once
@push('styles')
<style>
.landing-header {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* El overlay usa una CSS variable para la opacidad dinámica */
.header-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(0,0,0,0.85) 0%,
        rgba(0,0,0,0.4) 60%,
        rgba(0,0,0,0.15) 100%
    );
    opacity: var(--overlay-opacity, 0.55);
    z-index: 1;
}

.header-nav {
    position: relative;
    z-index: 10;
    padding: 0 max(24px, 5vw);
}

.nav-container {
    display: flex;
    align-items: center;
    gap: 32px;
    height: 72px;
    max-width: 1280px;
    margin: 0 auto;
    width: 100%;
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
}

.nav-logo {
    border-radius: 8px;
    object-fit: contain;
}

.nav-site-name {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
    letter-spacing: -0.01em;
}

.nav-links {
    display: flex;
    list-style: none;
    gap: 32px;
    margin: 0 auto;
    padding: 0;
}

.nav-link {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    letter-spacing: 0.02em;
    transition: color 0.2s;
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -4px; left: 0;
    width: 0; height: 2px;
    background: var(--color-accent);
    transition: width 0.2s;
}

.nav-link:hover { color: white; }
.nav-link:hover::after { width: 100%; }

.nav-actions { flex-shrink: 0; }

.btn-sm { padding: 8px 20px; font-size: 0.85rem; }

.nav-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    margin-left: auto;
}

.nav-toggle span {
    display: block;
    width: 24px; height: 2px;
    background: white;
    border-radius: 2px;
    transition: all 0.3s;
}

.nav-mobile {
    display: none;
    padding: 16px 24px 24px;
}

.nav-mobile ul {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.nav-mobile .nav-link { font-size: 1.1rem; }

.hero-content {
    position: relative;
    z-index: 2;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px max(24px, 5vw) 100px;
    max-width: calc(1280px + max(24px, 5vw) * 2);
    margin: 0 auto;
    width: 100%;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    background: rgba(232,255,62,0.15);
    border: 1px solid rgba(232,255,62,0.3);
    border-radius: var(--radius-full);
    color: var(--color-accent);
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    margin-bottom: 24px;
    width: fit-content;
    backdrop-filter: blur(8px);
}

.hero-title {
    font-size: clamp(2.5rem, 6vw, 5.5rem);
    color: white;
    margin: 0 0 20px;
    max-width: 14ch;
    font-weight: 800;
}

.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.35rem);
    color: rgba(255,255,255,0.75);
    margin: 0 0 12px;
    max-width: 50ch;
    font-weight: 300;
    line-height: 1.6;
}

.hero-description {
    font-size: 1rem;
    color: rgba(255,255,255,0.55);
    margin: 0 0 40px;
    max-width: 55ch;
    line-height: 1.7;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: center;
}

.hero-scroll-indicator {
    position: absolute;
    bottom: 32px;
    left: max(24px, 5vw);
    display: flex;
    align-items: center;
    gap: 12px;
    color: rgba(255,255,255,0.4);
    font-size: 0.75rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.scroll-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--color-accent);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.3; transform: scale(1.5); }
}

[data-animate] {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

[data-animate].is-visible {
    opacity: 1;
    transform: translateY(0);
}

@media (max-width: 768px) {
    .nav-links, .nav-actions { display: none; }
    .nav-toggle { display: flex; }
    .nav-mobile.is-open { display: block; }
    .hero-title { font-size: clamp(2rem, 8vw, 3rem); }
    .hero-scroll-indicator { display: none; }
}
</style>
@endpush

@push('scripts')
<script>
// Animaciones de entrada
document.querySelectorAll('[data-animate]').forEach(el => {
    el.style.transitionDelay = (el.dataset.delay || 0) + 'ms';
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('is-visible');
            observer.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));

// Menú mobile
const toggle     = document.getElementById('navToggle');
const mobileMenu = document.getElementById('navMobile');

if (toggle && mobileMenu) {
    toggle.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', isOpen);
        mobileMenu.setAttribute('aria-hidden', !isOpen);
    });
    mobileMenu.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });
}
</script>
@endpush
@endonce
