<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    public function index() 
    { 
        $transacciones = [ 
            ['id' => 1, 'nombre' => 'Café Amanecer', 'monto' => 20.75, 'estado' => 'Aprobada'], 
            ['id' => 2, 'nombre' => 'Ferretería San José', 'monto' => 50.25, 'estado' => 'Rechazada'], 
            ['id' => 3, 'nombre' => 'Pupusería El Buen Sabor', 'monto' => 35.30, 'estado' => 'Aprobada'], 
        ]; 
  
        return $transacciones; 
    }
}
