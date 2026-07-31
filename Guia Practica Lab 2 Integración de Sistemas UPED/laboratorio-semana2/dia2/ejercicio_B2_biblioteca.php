<?php 
class Libro
{ 
    private string $titulo; 
  
    public function __construct(string $titulo) 
    { 
        $this->titulo = $titulo; 
    } 
  
    public function getTitulo(): string 
    { 
        return $this->titulo; 
    } 
} 
  
class Biblioteca 
{ 
    private array $libros = []; 
  
    public function agregarLibro(Libro $libro): void 
    { 
        $this->libros[] = $libro; 
    } 

    public function contarLibros(): int
    {
        return count($this->libros);
    }
  
    public function  listarTitulos(): array 
    { 
        return array_map(fn (Libro $l) => $l->getTitulo(), $this->libros); 
    } 
} 
  
$libro = new Biblioteca();
$libro->agregarLibro(new Libro("Clean Code"));
$libro->agregarLibro(new Libro("Refactoring"));
$libro->agregarLibro(new Libro("El Quijote"));

  
echo "Biblioteca tiene {$libro->contarLibros()} libro(s): " . implode(", ", $libro->listarTitulos()) . PHP_EOL; 