<?php 
require 'vendor/autoload.php';

use App\Modelos\Tarea; 
  
// 1) CREAR dos tareas de prueba 
$tarea1 = new Tarea("Configurar entorno Laravel", "Instalar Composer y Laravel Installer"); 
$tarea1->crearTarea($tarea1); 
  
$tarea2 = new Tarea("Repasar PDO", "", true); 
$tarea2->crearTarea($tarea2); 
  
// 2) LISTAR todas las tareas 
$tareaTemp = new Tarea("temp"); 
$todas = $tareaTemp->listarTareas(); 
  
echo "<h2>Tareas registradas:</h2><ul>"; 
foreach ($todas as $t) { 
    $estado = $t['completada'] ? "✅" : "⏳"; 
    echo "<li>{$estado} {$t['titulo']}</li>"; 
} 
echo "</ul>"; 
