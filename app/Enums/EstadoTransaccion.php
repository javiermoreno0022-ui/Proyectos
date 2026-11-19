<?php

namespace App\Enums;

enum EstadoTransaccion: string
{
    case Iniciada = 'Iniciada';
    case Completada = 'Completada';
    case Fallida = 'Fallida';
}