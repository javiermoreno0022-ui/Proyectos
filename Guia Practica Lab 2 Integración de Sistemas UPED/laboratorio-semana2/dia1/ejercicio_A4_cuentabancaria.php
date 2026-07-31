<?php 
  
class CuentaBancaria
{ 
    private float $saldo = 0; 
    public function depositar(float $monto): void
    { 
        if ($monto <= 0) {
            throw new InvalidArgumentException("El monto a depositar debe ser mayor que cero.");
    } 
    $this->saldo += $monto;
    }
    public function getSaldo(): float
    { 
        return $this->saldo;
    } 
} 
  
$cuenta = new CuentaBancaria(); 
echo "Saldo Inicial: {$cuenta->getSaldo()}" . PHP_EOL; 

$cuenta->depositar(150.5); 
echo "Saldo después de depositar 150.5: {$cuenta->getSaldo()}" . PHP_EOL; 
try { 
    $cuenta->depositar(0); 
} catch (\InvalidArgumentException $e) { 
    echo "Excepción capturada: " . $e->getMessage() . PHP_EOL; 
}
echo "Saldo tras el intento fallido (sin modificación): {$cuenta->getSaldo()}" . PHP_EOL; 
