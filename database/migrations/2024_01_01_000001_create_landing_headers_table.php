<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla landing_headers para almacenar
     * el contenido editable del header de la landing page.
     */
    public function up(): void
    {
        Schema::create('landing_headers', function (Blueprint $table) {
            $table->id();

            // Identidad del sitio
            $table->string('logo_path')->nullable()->comment('Ruta del logo subido');
            $table->string('logo_alt')->default('Logo')->comment('Texto alternativo del logo');
            $table->string('site_name')->default('Mi Tienda')->comment('Nombre del sitio en navbar');

            // Contenido Hero
            $table->string('hero_title')->default('Bienvenido a nuestra tienda');
            $table->string('hero_subtitle')->nullable()->comment('Subtítulo debajo del título principal');
            $table->text('hero_description')->nullable()->comment('Párrafo descriptivo del hero');

            // CTA Principal
            $table->string('cta_text')->default('Ver productos')->comment('Texto del botón principal');
            $table->string('cta_link')->default('/productos')->comment('URL del botón principal');
            $table->string('cta_style')->default('primary')->comment('Estilo: primary | secondary | outline');

            // CTA Secundario (opcional)
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_link')->nullable();

            // Imagen de fondo
            $table->string('bg_image_path')->nullable()->comment('Ruta de la imagen de fondo del hero');
            $table->string('bg_color')->default('#0f172a')->comment('Color de fondo fallback (hex)');
            $table->string('bg_overlay_opacity')->default('0.5')->comment('Opacidad del overlay (0 a 1)');

            // Badge / Tag opcional sobre el título
            $table->string('badge_text')->nullable()->comment('Ej: "🔥 Ofertas de temporada"');

            // Control de visibilidad
            $table->boolean('is_active')->default(true)->comment('Si el header está activo');

            // Auditoría
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_headers');
    }
};
