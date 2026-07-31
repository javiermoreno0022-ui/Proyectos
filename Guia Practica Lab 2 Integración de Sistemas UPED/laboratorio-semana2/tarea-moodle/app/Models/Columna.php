<?php

namespace App\Models;

class Columna
{
    private string $nombre;
    private int $limiteWIP;
    private array $tareas = [];

    public function __construct(string $nombre, int $limiteWIP = 5)
    {
        $this->nombre = $nombre;
        $this->limiteWIP = $limiteWIP;
    }

    // Agrega una nueva tarea a la columna
    public function agregarTarea(Tarea $tarea): void
    {
        $this->tareas[] = $tarea;
    }

    public function contarTareas(): int
    {
        return count($this->tareas);
    }

    public function estaLlena(): bool
    {
        return $this->contarTareas() >= $this->limiteWIP;
    }

}