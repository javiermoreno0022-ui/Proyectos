<?php

namespace App\Models;

 class Tablero 
 {
    private array $columnas = [];

    public function agregarColumna(Columna $columna): void
    {
        $this->columnas[] = $columna;
    }

    public function contarTareasTotales(): int
    {
        $total = 0;
        foreach ($this->columnas as $columna) 
            {
        $total += $columna->contarTareas();
    }
    return $total;
    }
 }