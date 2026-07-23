<?php 
namespace Colonia\Escalon; 
  
class Persona 
{ 
    public function saludar(): string 
    { 
        return "Hola, soy Juan Pérez, de la Colonia Escalón."; 
    }
    } 
  
namespace Colonia\Soyapango; 
  
class Persona 
{ 
    public function saludar(): string 
    { 
        return "Hola, soy Juan Pérez, de Soyapango."; 
    } 
} 

namespace Colonia\Merliot;

class Persona 
{
    public function saludar(): string
    {
        return "Hola, soy Juan Pérez, de Merliot.";
    }
}
  
namespace App; 
  
$p1 = new \Colonia\Escalon\Persona(); 
$p2 = new \Colonia\Soyapango\Persona(); 
$p3 = new \Colonia\Merliot\Persona();
  
echo $p1->saludar() . PHP_EOL; 
echo $p2->saludar() . PHP_EOL; 
echo $p3->saludar() . PHP_EOL;
echo get_class($p1) . PHP_EOL; 
echo get_class($p2) . PHP_EOL; 
echo get_class($p3) . PHP_EOL;