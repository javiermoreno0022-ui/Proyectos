<?php 
require 'vendor/autoload.php'; 
  
use App\Models\Tarea; 
use App\Models\TareaUrgente;
use App\Models\ClienteVIP;

$t1 = new Tarea("Leer manual de PHP"); 
$t2 = new TareaUrgente("Entregar Laboratorio I", "2026-08-11"); 
  
echo $t1->getTitulo() . PHP_EOL; 
echo $t2->notificar() . PHP_EOL;

$cliente = new ClienteVIP("Ana Beatriz Flores",  "ana@correo.com");
echo $cliente->emitirFactura(100);