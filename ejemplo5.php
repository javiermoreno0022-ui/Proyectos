<?php 
interface Nadador 
{ 
    public function nadar(): string;
} 
  
class Pato implements Nadador 
{ 
    public function nadar(): string 
    { 
        return "El pato nada en la superficie."; 
    } 
} 
  
class Pez implements Nadador 
{ 
    public function nadar(): string 
    { 
        return "El pez nada bajo el agua."; 
    } 
} 

class Persona implements Nadador
{
    public function nadar(): string
    {
        return "La persona puede nadar.";
    }
}
  
$animales = [new Pato(), new Pez(), new Persona()]; 
  
foreach ($animales as $animal) { 
    echo $animal->nadar() . PHP_EOL; 
} 
  
echo "¿Pato es Nadador? " . ($animales[0] instanceof Nadador ? "Sí" : "No") . PHP_EOL; 
echo "¿Pato es un tipo de Pez? " . ($animales[0] instanceof Pez ? "Sí" : "No") . PHP_EOL; 
echo "¿Persona es Nadador?", ($animales[2] instanceof Nadador ? "Sí" : "No") . PHP_EOL;