<?php 
require 'vendor/autoload.php';

use App\Modelos\Tarea; 
  
// 1) CREAR dos tareas de prueba 
$t1 = new Tarea("Diseñar wireframes", "Pantallas principales de TaskBoard"); 
$t1->crearTarea($t1); 
  
$t2 = new Tarea("Escribir README", "Documentar instalación del proyecto", true); 
$t2->crearTarea($t2); 
  
$t3 = new Tarea("Preparar demo viernes"); 
$t3->crearTarea($t3); 
  
// 2) LISTAR todas las tareas 
$temp = new Tarea("temp"); 
$resultado = $temp->listarTareas(); 
  
var_dump($resultado); 
  
// — o, de forma más legible — 
  
foreach ($resultado as $fila) { 
    echo $fila['titulo'] . "\n"; 
} 
