<?php 
class Tarea 
{ 
    public string $titulo; 
  
    public function __construct(string $titulo) 
    { 
        $this->titulo = $titulo; 
    } 
  
    public function mover(): void 
    { 
        echo "Moviendo: " . $this->titulo . PHP_EOL; 
    } 
} 
  
$t1 = new Tarea("Diseñar wireframe"); 
$t2 = new Tarea("Revisar presupuesto"); 
$t3 = new Tarea("Finalizar");
  
$t1->mover(); 
$t2->mover();
$t3->mover();