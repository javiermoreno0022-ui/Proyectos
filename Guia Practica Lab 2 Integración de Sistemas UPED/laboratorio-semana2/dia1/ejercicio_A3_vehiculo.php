<?php 

class Vehiculo 
{ 
    private string $marca; 
    private int $anio; 
  
    public function __construct(string $marca, int $anio) 
    { 
        $this->marca = $marca; 
        $this->anio = $anio; 
    } 
  
    public function getMarca(): string 
    { 
        return $this->marca; 
    } 

    public function getAnio(): int 
    { 
        return $this->anio; 
    } 

    public function antiguedad(int $anioActual = 2026): int 
    { 
        return $anioActual - $this->anio;
    } 
} 
  
$v = new Vehiculo("Toyota", 2019); 
  

echo "Vehiculo: {$v->getMarca()} ({$v->getAnio()}) " . PHP_EOL;
echo "Antiguedad en 2026: {$v->antiguedad()} años" . PHP_EOL;
