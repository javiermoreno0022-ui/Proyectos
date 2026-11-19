<?php

namespace App\Services\Comisiones;

class ComisionTarjeta implements ReglaComision
{
    public function aplica(string $metodo): bool
    {
        return $metodo === 'tarjeta';
    }

    public function calcular(float $monto): float
    {
        return round($monto * 0.035, 2);
    }
}