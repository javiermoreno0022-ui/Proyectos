<?php

namespace App\Models;

use App\Contracts\Notificable;

class TareaRecurrente extends Tarea implements Notificable
{
    private string $frecuencia;
    
    public function __construct(string $titulo, string $frecuencia)
    {
        parent::__construct($titulo);
        $this->frecuencia = $frecuencia;
    }

    public function getFrecuencia(): string
    {
        return $this->frecuencia;
    }

    public function notificar(): string 
    {
        return "Recordatorio: La tarea '{$this->getTitulo()}' debe realizarse de forma {$this->frecuencia} "; 
    }

}