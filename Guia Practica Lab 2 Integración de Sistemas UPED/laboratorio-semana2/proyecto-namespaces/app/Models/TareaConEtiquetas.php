<?php

namespace App\Models;

class TareaConEtiquetas extends Tarea
{
    private array $etiquetas = []; 

    public function agregarEtiqueta(string $etiqueta): void
    {
        if (!in_array($etiqueta, $this->etiquetas)) 
        {
        $this->etiquetas[] = $etiqueta;
        }
    }

    public function  getEtiquetas(): array
    {
        return $this->etiquetas;
    }
}