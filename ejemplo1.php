<?php 
class Tarea {} 

$tarea1 = new Tarea(); 
$tarea2 = new Tarea(); 
  
var_dump($tarea1 === $tarea1); 
echo get_class($tarea1) . PHP_EOL; 
echo get_class($tarea2) . PHP_EOL;
