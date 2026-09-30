<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\View\View;

class ComercioController extends Controller
{
    public function index(): View
    {
        $comercios = Comercio::withCount('transacciones')
            ->orderByDesc('transacciones_count')
            ->get();

        return view('comercios.index', compact('comercios'));
    }
    public function show(Comercio $comercio): View
    {
        $comercio->load('transacciones');

        return view('comercios.show', compact('comercio'));
    }
}


