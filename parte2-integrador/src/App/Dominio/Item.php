<?php 
  
namespace App\Dominio; 
  
abstract class Item 
{ 
    protected string $titulo; 
    protected \DateTimeImmutable $creadoEn; 
  
    public function __construct(string $titulo) 
    { 
        $this->titulo = $titulo; 
        $this->creadoEn = new \DateTimeImmutable(); 
    } 
  
    public function titulo(): string 
    { 
        return $this->titulo; 
    } 
  
    abstract public function estado(): string;
}