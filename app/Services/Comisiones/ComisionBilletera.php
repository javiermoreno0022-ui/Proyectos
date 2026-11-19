<?php

namespace App\Services\Comisiones;

class ComisionBilletera implements ReglaComision
{
    public function aplica(string $metodo): bool
    {
        return $metodo === 'billetera';
    }

    public function calcular(float $monto): float
    {
        return round($monto * 0.02, 2);
    }
}