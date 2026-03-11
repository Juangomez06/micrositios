{{-- resources/views/landing/home.blade.php --}}

@extends('layouts.landing')

@section('title', 'Inicio')

@section('content')

    {{-- ── 1. Header / Hero dinámico ── --}}
    <x-landing.header :header="$header" />

    {{-- ── 2. Sección de Productos Destacados ── --}}
    @php
    $defaultProducts = [
        ['icon'=>'👟','name'=>'Sneakers Urbanos Pro','category'=>'Calzado','price'=>'$89.99','badge'=>'Nuevo'],
        ['icon'=>'🎒','name'=>'Mochila Explorer 30L','category'=>'Accesorios','price'=>'$64.99','badge'=>'Top ventas'],
        ['icon'=>'⌚','name'=>'Reloj Smart Fit X3','category'=>'Tecnología','price'=>'$149.99','badge'=>'-20%'],
        ['icon'=>'🕶️','name'=>'Gafas UV400 Trend','category'=>'Accesorios','price'=>'$34.99','badge'=>'Oferta'],
    ];
    @endphp
    <section class="section-products" id="productos" aria-labelledby="products-title">
        <div class="section-container">

            <div class="section-label">Catálogo</div>
            <h2 class="section-title" id="products-title">
                Productos <em>destacados</em>
            </h2>
            <p class="section-subtitle">
                Seleccionados por calidad, precio y reseñas de nuestros clientes.
            </p>

            <div class="products-grid">
                @foreach($products ?? $defaultProducts as $product)
                <article class="product-card" data-animate="fade-up">
                    <div class="product-image">
                        <div class="product-placeholder">{{ $product['icon'] }}</div>
                        <span class="product-badge">{{ $product['badge'] }}</span>
                    </div>
                    <div class="product-info">
                        <div class="product-category">{{ $product['category'] }}</div>
                        <h3 class="product-name">{{ $product['name'] }}</h3>
                        <div class="product-footer">
                            <span class="product-price">{{ $product['price'] }}</span>
                            <button class="btn-add-cart" aria-label="Agregar al carrito {{ $product['name'] }}">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                    <path d="M16 10a4 4 0 01-8 0"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div style="text-align:center; margin-top:48px;">
                <a href="#" class="btn btn-secondary">
                    Ver todo el catálogo
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ── 3. Sección de Beneficios ── --}}
    <section class="section-benefits" id="beneficios" aria-labelledby="benefits-title">
        <div class="section-container">

            <div class="section-label" style="color:var(--color-accent)">¿Por qué elegirnos?</div>
            <h2 class="section-title" id="benefits-title" style="color:white">
                Todo lo que necesitas, <em>sin complicaciones</em>
            </h2>

            <div class="benefits-grid">
                @foreach([
                    ['icon'=>'🚀','title'=>'Envío ultrarrápido','desc'=>'Recibe tu pedido en 24-48 horas con seguimiento en tiempo real.'],
                    ['icon'=>'🔒','title'=>'Pago 100% seguro','desc'=>'Cifrado SSL y múltiples métodos de pago para tu tranquilidad.'],
                    ['icon'=>'↩️','title'=>'Devoluciones gratis','desc'=>'30 días para cambios y devoluciones sin preguntas.'],
                    ['icon'=>'🎯','title'=>'Garantía de calidad','desc'=>'Todos nuestros productos pasan controles de calidad rigurosos.'],
                ] as $benefit)
                <div class="benefit-card" data-animate="fade-up">
                    <div class="benefit-icon">{{ $benefit['icon'] }}</div>
                    <h3 class="benefit-title">{{ $benefit['title'] }}</h3>
                    <p class="benefit-desc">{{ $benefit['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── 4. Sección CTA Final ── --}}
    <section class="section-cta" id="contacto" aria-labelledby="cta-title">
        <div class="cta-container">
            <div class="cta-content" data-animate="fade-up">
                <div class="section-label">Oferta limitada</div>
                <h2 class="cta-title" id="cta-title">
                    ¿Listo para empezar<br>a comprar?
                </h2>
                <p class="cta-desc">
                    Únete a miles de clientes satisfechos y descubre una experiencia de compra diferente.
                </p>
                <div class="cta-actions">
                    <a href="{{ $header->cta_link }}" class="btn btn-primary" style="font-size:1rem; padding:16px 36px;">
                        {{ $header->cta_text }}
                    </a>
                    <div class="cta-trust">
                        <span>⭐ 4.9/5 de más de 2,400 reseñas</span>
                    </div>
                </div>
            </div>
            <div class="cta-graphic" aria-hidden="true">
                <div class="cta-circle cta-circle--1"></div>
                <div class="cta-circle cta-circle--2"></div>
                <span class="cta-emoji">🛍️</span>
            </div>
        </div>
    </section>

    {{-- ── 5. Footer ── --}}
    <footer class="site-footer" role="contentinfo">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="nav-brand" style="text-decoration:none;">
                    <span class="nav-site-name" style="color:white; font-size:1.3rem;">
                        {{ $header->site_name }}
                    </span>
                </a>
                <p class="footer-tagline">
                    {{ $header->hero_subtitle ?? 'Tu tienda de confianza' }}
                </p>
            </div>

            <nav class="footer-nav" aria-label="Footer navigation">
                <div class="footer-col">
                    <h4>Tienda</h4>
                    <ul>
                        <li><a href="#">Productos</a></li>
                        <li><a href="#">Novedades</a></li>
                        <li><a href="#">Ofertas</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Empresa</h4>
                    <ul>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Soporte</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Envíos</a></li>
                        <li><a href="#">Devoluciones</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ $header->site_name }}. Todos los derechos reservados.</span>
            <div class="footer-legal">
                <a href="#">Privacidad</a>
                <a href="#">Términos</a>
            </div>
        </div>
    </footer>

@endsection

@push('styles')
<style>
/* ── Secciones generales ── */
.section-container, .footer-container, .cta-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 max(24px, 5vw);
}

.section-products, .section-cta, .site-footer {
    padding: 100px 0;
}

.section-benefits {
    padding: 100px 0;
    background: var(--color-ink);
}

.section-label {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--color-muted);
    margin-bottom: 16px;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3.2rem);
    color: var(--color-ink);
    margin: 0 0 16px;
    font-weight: 800;
}

.section-title em {
    font-style: normal;
    color: var(--color-muted);
}

.section-subtitle {
    color: var(--color-muted);
    font-size: 1.05rem;
    max-width: 50ch;
    margin: 0 0 56px;
    line-height: 1.6;
}

/* ── Products Grid ── */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
}

.product-card {
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    background: white;
    transition: transform 0.2s, box-shadow 0.2s;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.08);
}

.product-image {
    height: 200px;
    background: #f5f5f0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.product-placeholder {
    font-size: 4rem;
}

.product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: var(--color-accent);
    color: var(--color-ink);
    font-size: 0.7rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: var(--radius-full);
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.product-info {
    padding: 20px;
}

.product-category {
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--color-muted);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 6px;
}

.product-name {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-ink);
    margin: 0 0 16px;
}

.product-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.product-price {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--color-ink);
}

.btn-add-cart {
    width: 40px; height: 40px;
    border-radius: var(--radius-full);
    background: var(--color-ink);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.2s;
}

.btn-add-cart:hover {
    background: #333;
    transform: scale(1.1);
}

/* ── Benefits ── */
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 24px;
}

.benefit-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--radius-lg);
    padding: 32px 28px;
    transition: background 0.2s, border-color 0.2s;
}

.benefit-card:hover {
    background: rgba(232,255,62,0.06);
    border-color: rgba(232,255,62,0.2);
}

.benefit-icon {
    font-size: 2.2rem;
    margin-bottom: 16px;
}

.benefit-title {
    font-family: var(--font-display);
    font-size: 1.05rem;
    font-weight: 700;
    color: white;
    margin: 0 0 10px;
}

.benefit-desc {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.55);
    line-height: 1.6;
    margin: 0;
}

/* ── CTA Section ── */
.section-cta {
    background: #fafaf8;
    border-top: 1px solid var(--color-border);
}

.cta-container {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 48px;
    align-items: center;
}

.cta-title {
    font-size: clamp(2rem, 4vw, 3rem);
    color: var(--color-ink);
    margin: 16px 0 20px;
    font-weight: 800;
}

.cta-desc {
    color: var(--color-muted);
    font-size: 1rem;
    max-width: 48ch;
    margin: 0 0 36px;
    line-height: 1.7;
}

.cta-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: flex-start;
}

.cta-trust {
    font-size: 0.85rem;
    color: var(--color-muted);
}

.cta-graphic {
    position: relative;
    width: 200px;
    height: 200px;
    flex-shrink: 0;
}

.cta-circle {
    position: absolute;
    border-radius: 50%;
}

.cta-circle--1 {
    width: 180px; height: 180px;
    background: var(--color-accent);
    top: 10px; left: 10px;
    opacity: 0.15;
}

.cta-circle--2 {
    width: 120px; height: 120px;
    background: var(--color-accent);
    top: 40px; left: 40px;
    opacity: 0.25;
}

.cta-emoji {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    font-size: 4rem;
}

/* ── Footer ── */
.site-footer {
    background: var(--color-ink);
    padding: 60px 0 32px;
}

.footer-container {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 64px;
    margin-bottom: 48px;
}

.footer-tagline {
    color: rgba(255,255,255,0.4);
    font-size: 0.9rem;
    margin: 12px 0 0;
    max-width: 30ch;
}

.footer-nav {
    display: flex;
    gap: 56px;
}

.footer-col h4 {
    font-family: var(--font-display);
    font-size: 0.8rem;
    font-weight: 700;
    color: rgba(255,255,255,0.35);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin: 0 0 16px;
}

.footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.footer-col a {
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s;
}

.footer-col a:hover { color: white; }

.footer-bottom {
    max-width: 1280px;
    margin: 0 auto;
    padding: 24px max(24px, 5vw) 0;
    border-top: 1px solid rgba(255,255,255,0.07);
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: rgba(255,255,255,0.3);
    font-size: 0.8rem;
}

.footer-legal {
    display: flex;
    gap: 24px;
}

.footer-legal a {
    color: rgba(255,255,255,0.3);
    text-decoration: none;
    transition: color 0.2s;
}
.footer-legal a:hover { color: rgba(255,255,255,0.7); }

/* ── Responsive ── */
@media (max-width: 768px) {
    .cta-container { grid-template-columns: 1fr; }
    .cta-graphic { display: none; }
    .footer-container { grid-template-columns: 1fr; gap: 40px; }
    .footer-nav { flex-wrap: wrap; gap: 32px; }
    .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
}
</style>
@endpush
