<?php

interface Imprimible
{
    public function imprimir(): string; 
}
class Factura implements Imprimible
{
   private string $numero;
   private float $total; 

   public function __construct(string $numero, float $total)
   {
    $this->numero = $numero;
    $this->total = $total;
   }

   public function imprimir(): string
   {
     return "Factura # {$this->numero} - Total: $ {$this->total}";
   }

}
Class Recibo implements Imprimible
{
    private string $numero;
    private float $monto;

    public function __construct(string $numero, float $monto)
    {
        $this->numero = $numero;
        $this->monto = $monto;
    }
    public function imprimir(): string
    {
        return "Recibo de pago # {$this->numero} - Monto: $ {$this->monto}";
    }
}
function imprimirTodos(array $items): void
    {
        foreach ($items as $item) 
      { 
        if ($item instanceof Imprimible) { 
            echo $item->imprimir() . PHP_EOL; 
        } else { 
            echo "(sin impresiones: " . get_class($item) . " no implementa Imprimible)" . PHP_EOL; 
        } 
      } 
    }

$factura = new Factura("001", 125.50);
$recibo = new Recibo("045", 60.00);

imprimirTodos([$factura, $recibo]);