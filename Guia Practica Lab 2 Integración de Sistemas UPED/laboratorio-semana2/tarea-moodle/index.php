<?php 
require 'vendor/autoload.php';

use App\Models\Tablero; 
use App\Models\Columna;
use App\Models\Tarea; 
use App\Models\TareaUrgente; 
use App\Models\TareaRecurrente; 
use App\Contracts\Notificable; 

$tablero = new Tablero(); 

$pendiente = new Columna("Por hacer:");
$proceso = new Columna("En proceso:");
$finalizada = new Columna("Hecho:");
  
$tablero->agregarColumna($pendiente); 
$tablero->agregarColumna($proceso); 
$tablero->agregarColumna($finalizada); 

$t1 = new Tarea("Investigar Composer"); 
$t2 = new TareaUrgente("Entregar laboratorio", "2026-08-11"); 
$t3 = new TareaRecurrente("Respaldo del sistema", "semanal"); 
$t4 = new Tarea("Preparar Presentación");

$t1->agregarComentario("Revisar antes del viernes");

$pendiente->agregarTarea($t1);
$pendiente->agregarTarea($t2);
$proceso->agregarTarea($t3);
$finalizada->agregarTarea($t4);
 

echo "===== Tablero TASKBOARD =====" . PHP_EOL;
echo "total de tareas: " . $tablero->contarTareasTotales() . PHP_EOL;
echo PHP_EOL;

echo "***** Notificaciones *****" . PHP_EOL;

$tareas = [$t1, $t2, $t3, $t4];

foreach ([$t1, $t2, $t3, $t4] as $tarea) { 
    if ($tarea instanceof Notificable) { 
        echo $tarea->notificar() . PHP_EOL; 
    } 
}
echo PHP_EOL;

echo "///// Comentarios /////" . PHP_EOL;

foreach ($t1->getComentarios() as $comentario) 
    {
        echo "- ".  $comentario . PHP_EOL;
    }
