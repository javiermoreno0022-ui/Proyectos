<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComercioController extends Controller
{
    public function index() 
    { 
        $comercios = [ 
            ['id' => 1, 'nombre' => 'Café Amanecer'], 
            ['id' => 2, 'nombre' => 'Ferretería San José'], 
            ['id' => 3, 'nombre' => 'Pupusería El Buen Sabor'], 
        ]; 
  
        return $comercios; 
    }
    public function show($id) 
    { 
        return "Detalle del comercio #$id"; 
    }
    
}
