<?php 
  
require_once __DIR__ . '/src/App/Dominio/Priorizable.php'; 
require_once __DIR__ . '/src/App/Dominio/Item.php'; 
require_once __DIR__ . '/src/App/Dominio/Tarea.php'; 
  
use App\Dominio\Tarea; 
  
$hoy = new DateTimeImmutable();

$tarea1 = new Tarea('Construir clase Tarea (PHP)', 1, (new DateTimeImmutable())->modify('+2 days')); 
$tarea2 = new Tarea('Configurar tablero Kanban', 2, (new DateTimeImmutable())->modify('+4 days')); 
$tarea3 = new Tarea('Entregar Informe', 3, (new DateTimeImmutable())->modify('-3 days'));
$tarea4 = new Tarea('Preparar Presentación,', 4, (new DateTimeImmutable())->modify('+5 days'));


echo "{$tarea1->titulo()} -> {$tarea1->estado()} (prioridad {$tarea1->prioridad()})" . PHP_EOL; 
echo "{$tarea2->titulo()} -> {$tarea2->estado()} (prioridad {$tarea2->prioridad()})" . PHP_EOL; 
  
$tarea1->mover(1); // 1 = "En progreso" 
echo "Después de mover tarea 1: " . $tarea1->estado() . PHP_EOL; 
echo "tarea 2 sigue en: " . $tarea2->estado() . " (no se vio afectada)" . PHP_EOL; 
echo "Tarea 3 Vencida:", ($tarea3->esVencida($hoy)? "Sí": "No"), PHP_EOL;
echo "Tarea 4 Vencida:", ($tarea4->esVencida($hoy)? "Sí": "No"), PHP_EOL;
