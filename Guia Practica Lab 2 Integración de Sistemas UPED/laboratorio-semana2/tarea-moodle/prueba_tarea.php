<?php 
require __DIR__ . '/vendor/autoload.php'; 
  
use App\Models\Tablero; 
use App\Models\Tarea; 
use App\Models\TareaUrgente; 
use App\Models\TareaRecurrente; 
use App\Models\Columna; 
use App\Contracts\Notificable; 
use App\Contracts\Comentable; 
  
echo "=== PRUEBA DE VERIFICACIÓN: Tarea Semana 2 ===" . PHP_EOL; 
$pasadas = 0; $total = 0; 
function verificar(string $d, bool $c): void { 
    global $pasadas, $total; $total++; 
    if ($c) { $pasadas++; echo "PASÓ: $d" . PHP_EOL; } 
    else { echo "FALLÓ: $d" . PHP_EOL; } 
} 
  
// 1. Herencia 
$urgente = new TareaUrgente("Prueba", "2026-12-01"); 
verificar("TareaUrgente ES-UNA Tarea (herencia)", $urgente instanceof Tarea); 
  
$recurrente = new TareaRecurrente("Prueba 2", "diaria"); 
verificar("TareaRecurrente ES-UNA Tarea (herencia)", $recurrente instanceof Tarea); 
  
// 2. Interfaces 
verificar("TareaUrgente implementa Notificable", $urgente instanceof Notificable); 
verificar("TareaRecurrente implementa Notificable", $recurrente instanceof 
Notificable); 
verificar("Tarea implementa Comentable", $urgente instanceof Comentable); 
  
// 3. Comportamiento polimórfico 
verificar( 
    "notificar() difiere entre TareaUrgente y TareaRecurrente (polimorfismo)", 
    $urgente->notificar() !== $recurrente->notificar() 
); 
  
// Deben incorporarse verificaciones adicionales sobre Composición y Comentable 

// 4. Composición

$columna = new Columna("Pendientes");

$columna->agregarTarea($urgente);
$columna->agregarTarea($recurrente);

$tablero = new Tablero();
$tablero->agregarColumna($columna);

verificar(
    "La columna contiene dos tareas",
    $columna->contarTareas() === 2
);

verificar(
    "El tablero cuenta correctamente las tareas",
    $tablero->contarTareasTotales() === 2
);

// 5. Comentable

$urgente->agregarComentario("Revisar antes de entregar");

verificar(
    "Se agregó un comentario",
    count($urgente->getComentarios()) === 1
);

verificar(
    "El comentario almacenado es correcto",
    $urgente->getComentarios()[0] === "Revisar antes de entregar"
);
  
echo PHP_EOL . "Resultado: $pasadas de $total pruebas aprobadas." . PHP_EOL;