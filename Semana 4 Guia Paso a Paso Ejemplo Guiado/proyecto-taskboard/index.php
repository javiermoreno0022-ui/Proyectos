<?php 
require 'vendor/autoload.php'; 
  
use App\Modelos\Tarea; 
  
// 1) CREAR 
$nueva = new Tarea("Probar ciclo CRUD completo", "Verificación final", false); 
$nueva->crearTarea($nueva); 
  
// 2) LISTAR 
$temp = new Tarea("temp"); 
$todas = $temp->listarTareas(); 
echo "<h3>Después de Crear:</h3><ul>"; 
foreach ($todas as $t) { 
    echo "<li>#{$t['id']} - {$t['titulo']}</li>"; 
} 
echo "</ul>"; 
  
// 3) EDITAR la primera tarea de la lista 
$primera = $todas[0]; 
$editar = new Tarea($primera['titulo'] . " (editado)", $primera['descripcion'], true); 
$editar->id = $primera['id']; 
$editar->actualizarTarea($editar); 
  
// 4) ELIMINAR la última tarea de la lista 
$ultima = end($todas); 
$borrar = new Tarea("temp"); 
$borrar->eliminarTarea($ultima['id']); 
  
// Verificación final 
$resultadoFinal = $temp->listarTareas(); 
echo "<h3>Después de Editar + Eliminar:</h3><ul>"; 
foreach ($resultadoFinal as $t) { 
    $estado = $t['completada'] ? "✅" : "⏳"; 
    echo "<li>{$estado} #{$t['id']} - {$t['titulo']}</li>"; 
}

echo "</ul>";
