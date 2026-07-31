<?php
require __DIR__ . '/vendor/autoload.php';

use App\Contracts\Comentable;

function comentarATodas(array $tareas, string $comentario): void
{
    foreach ($tareas as $tarea) {

        if ($tarea instanceof Comentable) {
            $tarea->agregarComentario($comentario);
        }

    }
}