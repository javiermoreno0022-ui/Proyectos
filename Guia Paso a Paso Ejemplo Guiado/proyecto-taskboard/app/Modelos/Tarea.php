<?php 
  
namespace App\Modelos; 

use App\Config\Database;
use PDO;
class Tarea 
{ 
    public ?int $id; 
    public string $titulo; 
    public string $descripcion; 
    public bool $completada; 
  
    public function __construct( 
        string $titulo, 
        string $descripcion = "", 
        bool $completada = false 
    ) { 
        $this->titulo = $titulo; 
        $this->descripcion = $descripcion; 
        $this->completada = $completada; 
    } 
    public function crearTarea(Tarea $tarea): bool 
    { 
    $pdo = Database::conectar(); 
  
    $sql = "INSERT INTO tareas 
        (titulo, descripcion, completada) 
        VALUES (:titulo, :descripcion, :completada)"; 
  
    $stmt = $pdo->prepare($sql); 
  
    return $stmt->execute([ 
        'titulo'      => $tarea->titulo, 
        'descripcion' => $tarea->descripcion, 
        'completada'  => $tarea->completada, 
    ]); 
    } 

    public function listarTareas(): array 
   { 
    $pdo = Database::conectar(); 
  
    $sql = "SELECT * FROM tareas 
            ORDER BY id DESC"; 
  
    $stmt = $pdo->query($sql); 
  
    return $stmt->fetchAll( 
        PDO::FETCH_ASSOC 
    ); 
   } 
}