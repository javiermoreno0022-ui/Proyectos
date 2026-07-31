<?php 

namespace App\Models;

use App\Contracts\Facturable;

class ClienteVIP extends Cliente implements Facturable
{
    public function emitirFactura(float $monto): string
    {
        
        $montoConDescuento = $monto * 0.90;

        return "Factura para {$this->nombre}: $$montoConDescuento (10% descuento VIP aplicado)";
    
    }
}
