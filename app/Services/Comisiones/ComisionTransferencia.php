<?php 
  
namespace App\Services\Comisiones;

class ComisionTransferencia implements ReglaComision
{
    public function aplica(string $metodo): bool
    {
        return $metodo === 'transferencia';
    }

    public function calcular(float $monto): float
    {
        return 1.50;
    }
}