<?php

namespace App\Services\Comisiones;

interface ReglaComision
{
    public function aplica(string $metodo): bool;

    public function calcular(float $monto): float;
}