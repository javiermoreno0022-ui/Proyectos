<?php 
  
namespace App\Dominio; 
  
interface Priorizable 
{ 
    public function prioridad(): int; 
}