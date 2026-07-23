<?php 
function modelo_obtenerReceta(string $plato): string 
{ 
    $recetas = [ 
        'tacos' => 'tortilla, carne, cebolla y cilantro', 
        'pupusas' => 'masa de maíz, queso y frijol', 
        'yucafrita' => 'yuca, aceite ,sal, pimienta'
    ]; 
  
    return $recetas[$plato] ?? 'receta no encontrada'; 
} 
  
function vista_mostrarPlato(string $plato, string $receta): string 
{ 
    return "Pedido de $plato listo. Ingredientes: $receta."; 
} 
  
function controlador_atenderPedido(string $plato): string 
{ 
    $receta = modelo_obtenerReceta($plato); 
    return vista_mostrarPlato($plato, $receta); 
} 
  
echo controlador_atenderPedido('pupusas') . PHP_EOL; 
echo controlador_atenderPedido('tacos') . PHP_EOL; 
echo controlador_atenderPedido('pizza') . PHP_EOL;
echo controlador_atenderPedido('yucafrita') . PHP_EOL;