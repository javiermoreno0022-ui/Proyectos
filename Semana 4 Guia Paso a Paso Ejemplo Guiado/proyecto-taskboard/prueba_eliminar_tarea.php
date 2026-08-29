<?php 
require 'vendor/autoload.php';

use App\Modelos\Tarea; 

$tareas = (new Tarea("temp"))->listarTareas(); 
$ultima = end($tareas); 
  
$borrar = new Tarea("temp"); 
var_dump($borrar->eliminarTarea($ultima['id'])); 