<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\EventoTransaccionController;

Route::get('/', function () { 
    return view('welcome'); 
}); 

Route::get('/taskboard', function () { 
    return 'Bienvenido a TaskBoard, tu pasarela de pagos.'; 
}); 

Route::get('/acerca-de', function () { 
    return 'Esto es un TaskBoard<br>El cual nos ayudará a orgnaizar nuestras actividades, para poder 
    crear nuevas actividades, visualizarlas y organizarlas como queramos.'; 
}); 

Route::get('/contacto', function () {
    return 'Francisco Javier Moreno Navas<br>francisco.moreno64016@uped.edu.sv';
});

Route::get('/comercios', function () 
{ 
    return [
    [ 
        'id' => '1',
        'nombre' => 'El Buen Sabor'
    ],  
    [
        'id' => '2',
        'nombre' => 'Panaderia San Jose'
    ],  
    [
        'id'=> '3',
        'nombre'=> 'Dulceria Niña Juanita'
    ]
    ];
}); 

Route::get('/comercios/{nombre}', function ($nombre) { 
    return "Bienvenidos a $nombre";
});

Route::get('/estados', function () { 
    return [
        'Iniciada',  
        'Procesando',  
        'Aprobada',
        'Rechazada',
        'Liquidada'
    ];
});

Route::get('/transaccion/demo', function () {
    return [
        'id' => 1,
        'comercio' => 'El Buen Sabor',
        'monto' => 25.50,
        'moneda' => 'USD',
        'estado' => 'Aprobada'
    ];
});

Route::get('/comercios', [ComercioController::class, 'index']) 
    ->name('comercios.index');

Route::get('/transacciones', [TransaccionController::class, 'index']) 
    ->name('transacciones.index');

Route::get('/comercio/{id}', [ComercioController::class, 'show']
)->where('id', '[0-9]+'); 

Route::get('/evento-transaccion', [EventoTransaccionController::class, 'index']) 
    ->name('evento-transaccion.index');

Route::prefix('comercios')->name('comercios.')->group(function () { 

Route::get('/', function () {  
})->name('index'); 

Route::get('/{id}', function ($id) {  
})->name('show')->where('id', '[0-9]+'); 
}); 