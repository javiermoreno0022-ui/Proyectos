<?php 
  
namespace App\Dominio; 
  
class Tarea extends Item implements Priorizable 
{ 
    private const COLUMNAS = ['Por hacer', 'En progreso', 'En revisión', 'Hecho']; 
  
    private int $columna = 0; 
    private int $prioridad; 
    private \DateTimeImmutable $fechaLimite; 
  
    public function __construct(string $titulo, int $prioridad , \DateTimeImmutable $fechaLimite) 
    { 
        parent::__construct($titulo); 
        $this->prioridad = $prioridad; 
        $this->fechaLimite = $fechaLimite; 
    } 
  
    public function mover(int $indice): void 
    { 
        $this->columna = $indice;
    }

     public function estado(): string 
    { 
        return self::COLUMNAS[$this->columna]; 
    } 
  
    public function prioridad(): int 
    { 
        return $this->prioridad;
    }

    public function esVencida(\DateTimeImmutable $hoy): bool 
    {  
        return $hoy > $this->fechaLimite; 
    }
}