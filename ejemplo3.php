<?php
class Tarea
{ 
    public int $columna = 0; 
  
    public function mover(int $indice): void 
    { 
        $this->columna = $indice; 
    } 
  
    public function columnaActual(): int 
    { 
        return $this->columna; 
    } 
} 
  
$t = new Tarea(); 
$t->mover(2); 
echo "Columna actual (vía método público): " . $t->columnaActual() . PHP_EOL; 
  

    echo $t->columna; 
