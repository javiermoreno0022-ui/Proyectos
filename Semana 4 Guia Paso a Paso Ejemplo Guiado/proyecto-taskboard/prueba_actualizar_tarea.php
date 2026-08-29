<?php
require 'vendor/autoload.php';

use App\Modelos\Tarea; 

$tareas = (new Tarea("temp"))->listarTareas(); 
$primera = $tareas[0]; 
  
$editar = new Tarea( 
    $primera['titulo'] . " (editado)", 
    $primera['descripcion'], 
    true 
); 
$editar->id = $primera['id']; 
  
var_dump($editar->actualizarTarea($editar));
