<?php 
  
require __DIR__ . '/vendor/autoload.php'; 

use App\Modelo\Tarea; 
use App\Modelo\TareaUrgente; 
  
$t1 = new Tarea('Investigar PDO'); 
$t2 = new TareaUrgente('Corregir bug en login', 'alta'); 
  
echo "--- Tarea normal ---" . PHP_EOL; 
echo $t1->getTitulo() . ' (' . $t1->getEstado() . ')' . PHP_EOL; 
  
echo "--- Tarea urgente ---" . PHP_EOL; 
echo $t2->getTitulo() . ' - Prioridad: ' . $t2->getPrioridad() . PHP_EOL; 
  
$t1->marcarComoHecha(); 
echo "--- Después de marcarla como hecha ---" . PHP_EOL; 
echo $t1->getTitulo() . ' (' . $t1->getEstado() . ')' . PHP_EOL;