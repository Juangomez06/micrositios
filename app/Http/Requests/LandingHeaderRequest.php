<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingHeaderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'logo'               => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'logo_alt'           => ['nullable', 'string', 'max:100'],
            'site_name'          => ['required', 'string', 'max:80'],

            'hero_title'         => ['required', 'string', 'max:120'],
            'hero_subtitle'      => ['nullable', 'string', 'max:180'],
            'hero_description'   => ['nullable', 'string', 'max:500'],
            'badge_text'         => ['nullable', 'string', 'max:80'],

            'cta_text'           => ['required', 'string', 'max:60'],
            'cta_link'           => ['required', 'string', 'max:255'],
            'cta_style'          => ['required', 'in:primary,secondary,outline'],
            'cta_secondary_text' => ['nullable', 'string', 'max:60'],
            'cta_secondary_link' => ['nullable', 'string', 'max:255'],

            'bg_image'           => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:5120'],
            'bg_color'           => ['nullable', 'string', 'max:7'],
            'bg_overlay_opacity' => ['nullable', 'numeric', 'min:0', 'max:1'],

            'is_active'          => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'site_name.required'  => 'El nombre del sitio es obligatorio.',
            'hero_title.required' => 'El título principal es obligatorio.',
            'cta_text.required'   => 'El texto del botón es obligatorio.',
            'cta_link.required'   => 'El enlace del botón es obligatorio.',
            'cta_style.in'        => 'Estilo inválido.',
            'logo.image'          => 'El logo debe ser una imagen.',
            'logo.max'            => 'El logo no debe superar 2MB.',
            'bg_image.max'        => 'La imagen de fondo no debe superar 5MB.',
        ];
    }
}
