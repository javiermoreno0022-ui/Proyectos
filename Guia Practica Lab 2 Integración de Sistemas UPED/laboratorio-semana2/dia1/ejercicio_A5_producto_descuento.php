<?php  
class Producto 
{ 
    private string $nombre; 
    private float $precio; 
    private int $stock = 0; 
  
    public function __construct(string $nombre, float $precio) 
    { 
        $this->nombre = $nombre; 
        $this->precio = $precio; 
    } 
  
    public function agregarStock(int $cantidad): void 
    { 
        $this->stock += $cantidad; 
    } 
  
    public function vender(): void 
    { 
        if ($this->stock <= 0) { 
            throw new RuntimeException("Sin stock disponible de {$this->nombre}"); 
        } 
        $this->stock--; 
    } 
  
    public function getStock(): int 
    { 
        return $this->stock; 
    } 
  
    public function getNombre(): string 
    { 
        return $this->nombre; 
    } 
  
    public function getPrecio(): float 
    { 
        return $this->precio; 
    } 

    public function aplicarDescuento(float $porcentaje): void
    {
        if (($porcentaje<0) || ($porcentaje>100))
            {throw new InvalidArgumentException
             ("El porcentaje de descuento debe estar entre 0 y 100.");
        }
        $this->precio = $this->precio * (1 - $porcentaje / 100 );
            
    }
} 

$producto = new Producto("Casco de bicicleta", 24.99); 
$producto->agregarStock(15); 
  
echo "Producto: {$producto->getNombre()} | Stock inicial: {$producto->getStock()}" . 
PHP_EOL; 

$producto->vender(); 
$producto->vender(); 

echo "Después de vender 2 unidades -> Stock: {$producto->getStock()}" . PHP_EOL; 
$productoSinStock = new Producto("Casco agotado", 19.99); 
echo "Intento de venta sin stock disponible:" . PHP_EOL; 
try { 
    $productoSinStock->vender(); 
} catch (\RuntimeException $e) { 
    echo "Excepción capturada: " . $e->getMessage() . PHP_EOL; 
}

echo PHP_EOL . "Precio original: {$producto->getPrecio()}" . PHP_EOL; 
$producto->aplicarDescuento(20);
echo "Producto con 20% de descuento: {$producto->getPrecio()}";
try {
    $producto->aplicarDescuento(150);
}catch (\InvalidArgumentException $e) {
    echo PHP_EOL. "Excepción capturada: ". $e->getMessage() . PHP_EOL;
}

