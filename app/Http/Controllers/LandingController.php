<?php

namespace App\Http\Controllers;

use App\Models\LandingHeader;
use Illuminate\View\View;

/**
 * LandingController
 *
 * Sirve la Landing Page pública con datos dinámicos desde la base de datos.
 */
class LandingController extends Controller
{
    /**
     * Muestra la landing page principal con el header dinámico.
     */
    public function index(): View
    {
        // Carga el header activo (o crea uno por defecto si no existe)
        $header = LandingHeader::getActive();

        return view('landing.home', compact('header'));
    }
}
