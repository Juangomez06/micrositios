<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class LandingHeader extends Model
{
    protected $table = 'landing_headers';

    protected $fillable = [
        'logo_path',
        'logo_alt',
        'site_name',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'cta_text',
        'cta_link',
        'cta_style',
        'cta_secondary_text',
        'cta_secondary_link',
        'bg_image_path',
        'bg_color',
        'bg_overlay_opacity',
        'badge_text',
        'is_active',
        'updated_by',
    ];

    protected $casts = [
        'is_active'          => 'boolean',
        'bg_overlay_opacity' => 'float',
    ];

    // ── Relación con el editor ───────────────────────────────────────────────
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ── Obtener o crear el registro único ────────────────────────────────────
    public static function getActive(): self
    {
        return static::latest()->firstOr(function () {
            return static::create([
                'site_name'          => config('app.name', 'Mi Tienda'),
                'hero_title'         => 'Descubre productos increíbles',
                'hero_subtitle'      => 'Calidad, precio y entrega rápida',
                'cta_text'           => 'Ver catálogo',
                'cta_link'           => '#productos',
                'cta_style'          => 'primary',
                'bg_color'           => '#0f172a',
                'bg_overlay_opacity' => 0.55,
                'is_active'          => true,
            ]);
        });
    }

    // ── Accessors (sintaxis Laravel 9+ compatible con L12) ───────────────────

    /**
     * URL pública del logo. Usa Storage::url() que es más fiable que asset().
     */
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo_path && Storage::disk('public')->exists($this->logo_path)) {
            return Storage::disk('public')->url($this->logo_path);
        }
        return '';
    }

    /**
     * URL pública de la imagen de fondo.
     */
    public function getBgImageUrlAttribute(): string
    {
        if ($this->bg_image_path && Storage::disk('public')->exists($this->bg_image_path)) {
            return Storage::disk('public')->url($this->bg_image_path);
        }
        return '';
    }

    /**
     * Color de fondo con fallback seguro.
     */
    public function getBgColorSafeAttribute(): string
    {
        return $this->bg_color ?: '#0f172a';
    }

    /**
     * Opacidad del overlay con fallback seguro.
     */
    public function getOverlaySafeAttribute(): float
    {
        return $this->bg_overlay_opacity ?? 0.55;
    }
}
