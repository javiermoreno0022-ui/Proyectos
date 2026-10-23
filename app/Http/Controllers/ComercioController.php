<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ComercioController extends Controller
{
   public function index() 
    { 
        $comercios = Auth::user() 
        ->comercios() 
        ->withCount('transacciones') 
        ->orderBy('nombre_comercio') 
        ->get(); 
  
    return view('comercios.index', compact('comercios')); 
    } 
    public function show(Comercio $comercio) 
    { 
    abort_unless($comercio->user_id === Auth::id(), 404); 
  
    $comercio->load('transacciones'); 
  
    return view('comercios.show', compact('comercio')); 
    } 
}
