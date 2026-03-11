<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingHeaderController;

// ─────────────────────────────────────────────────────────────────────────────
// RUTAS PÚBLICAS
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Landing Page pública — reemplaza el welcome.blade.php estático
 * por una vista dinámica con datos desde la base de datos.
 */
Route::get('/', [LandingController::class, 'index'])->name('home');


// ─────────────────────────────────────────────────────────────────────────────
// RUTAS PROTEGIDAS (auth + verified)
// ─────────────────────────────────────────────────────────────────────────────

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard principal
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // ── Plantilla (existente) ──────────────────────────────────────────────
    Route::get('plantilla', [PlantillaController::class, 'index'])->name('plantilla');

    // ── Módulo: Edición del Header Landing ────────────────────────────────
    Route::prefix('admin')->name('admin.')->group(function () {

        // Editar header (GET = mostrar formulario, PUT = guardar)
        Route::get('header/edit', [LandingHeaderController::class, 'edit'])
            ->name('header.edit');

        Route::put('header/update', [LandingHeaderController::class, 'update'])
            ->name('header.update');

        // Acciones de eliminación de archivos
        Route::delete('header/logo', [LandingHeaderController::class, 'removeLogo'])
            ->name('header.remove-logo');

        Route::delete('header/bg-image', [LandingHeaderController::class, 'removeBgImage'])
            ->name('header.remove-bg-image');
    });

});

require __DIR__.'/settings.php';
