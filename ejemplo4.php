<?php 
abstract class Vehiculo 
{ 
    protected string $marca; 
     public function __construct(string $marca) 
    { 
        $this->marca = $marca; 
    } 
  
    public function arrancar(): string 
    { 
        return "{$this->marca}: el motor enciende."; 
    } 
} 
  
class Carro extends Vehiculo 
{ 
    public function abrirCajuela(): string 
    { 
        return "{$this->marca}: cajuela abierta."; 
    } 
} 
  
class Moto extends Vehiculo 
{ 
    public function hacerCaballito(): string 
    { 
        return "{$this->marca}: ¡wheelie!"; 
    } 
} 

class Bicicleta extends Vehiculo
{
    public function tocarTimbre(): string
    {
         return "{$this->marca}: Timbre tocado"; 
    }
}
  
$carro = new Carro("Toyota Corolla"); 
$moto = new Moto("Honda CB190R"); 
$bicicleta = new Bicicleta("Trek");
  
echo $carro->arrancar() . PHP_EOL; 
echo $carro->abrirCajuela() . PHP_EOL; 
echo $moto->arrancar() . PHP_EOL; 
echo $moto->hacerCaballito() . PHP_EOL;
echo $bicicleta->arrancar() . PHP_EOL;
echo $bicicleta->tocarTimbre() . PHP_EOL;