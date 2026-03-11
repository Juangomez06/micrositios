<?php

namespace App\Http\Controllers;

use App\Http\Requests\LandingHeaderRequest;
use App\Models\LandingHeader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LandingHeaderController extends Controller
{
    public function edit(): View
    {
        $header = LandingHeader::getActive();
        return view('admin.header.edit', compact('header'));
    }

    public function update(LandingHeaderRequest $request): RedirectResponse
    {
        $header = LandingHeader::getActive();
        $data   = $request->validated();

        // ── Logo ──────────────────────────────────────────────────────────────
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            // Borrar el anterior si existe
            if ($header->logo_path && Storage::disk('public')->exists($header->logo_path)) {
                Storage::disk('public')->delete($header->logo_path);
            }
            $data['logo_path'] = $request->file('logo')
                ->store('landing/logos', 'public');
        }
        unset($data['logo']);

        // ── Imagen de fondo ───────────────────────────────────────────────────
        if ($request->hasFile('bg_image') && $request->file('bg_image')->isValid()) {
            if ($header->bg_image_path && Storage::disk('public')->exists($header->bg_image_path)) {
                Storage::disk('public')->delete($header->bg_image_path);
            }
            $data['bg_image_path'] = $request->file('bg_image')
                ->store('landing/backgrounds', 'public');
        }
        unset($data['bg_image']);

        // ── is_active: el hidden input manda "0", el checkbox manda "1" ───────
        $data['is_active'] = $request->input('is_active', '0') === '1';

        // ── Auditoría ─────────────────────────────────────────────────────────
        $data['updated_by'] = auth()->id();

        // ── Nullificar campos opcionales vacíos ───────────────────────────────
        foreach (['hero_subtitle', 'hero_description', 'badge_text',
                  'cta_secondary_text', 'cta_secondary_link', 'logo_alt'] as $field) {
            if (array_key_exists($field, $data) && trim((string)($data[$field] ?? '')) === '') {
                $data[$field] = null;
            }
        }

        $header->update($data);

        return redirect()
            ->route('admin.header.edit')
            ->with('success', '✅ Header actualizado. Los cambios ya son visibles en la landing.');
    }

    public function removeLogo(): RedirectResponse
    {
        $header = LandingHeader::getActive();
        if ($header->logo_path && Storage::disk('public')->exists($header->logo_path)) {
            Storage::disk('public')->delete($header->logo_path);
        }
        $header->update(['logo_path' => null]);
        return back()->with('success', '🗑 Logo eliminado.');
    }

    public function removeBgImage(): RedirectResponse
    {
        $header = LandingHeader::getActive();
        if ($header->bg_image_path && Storage::disk('public')->exists($header->bg_image_path)) {
            Storage::disk('public')->delete($header->bg_image_path);
        }
        $header->update(['bg_image_path' => null]);
        return back()->with('success', '🗑 Imagen de fondo eliminada.');
    }
}
