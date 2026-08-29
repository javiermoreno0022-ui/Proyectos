```php
<?php

require 'vendor/autoload.php';

use App\Modelos\Tarea;

// 1) CREAR TAREAS DE PRUEBA
$t1 = new Tarea(
    "Diseñar wireframes",
    "Pantallas principales de TaskBoard"
);

$t1->crearTarea($t1);

$t2 = new Tarea(
    "Escribir README",
    "Documentar instalación del proyecto",
    true
);
$t2->crearTarea($t2);

$t3 = new Tarea(
    "Preparar demo viernes"
);
$t3->crearTarea($t3);

// 2) LISTAR TODAS LAS TAREAS
$temp = new Tarea("temp");

$resultado = $temp->listarTareas();

echo "<h2>Después de Crear:</h2>";

foreach ($resultado as $fila) {

    $estado = $fila['completada'] ? "✅" : "⏳";

    echo "{$estado} #{$fila['id']} - {$fila['titulo']}<br>";
}

// 3) EDITAR LA PRIMERA TAREA
if (!empty($resultado)) {

    $primera = $resultado[0];

    $editar = new Tarea(
        $primera['titulo'] . " (editado)",
        $primera['descripcion'],
        true
    );

    $editar->id = $primera['id'];

    $actualizado = $editar->actualizarTarea($editar);

    echo "<h3>Resultado de Editar:</h3>";

    var_dump($actualizado);
}

// 4) ELIMINAR LA ÚLTIMA TAREA
if (!empty($resultado)) {

    $ultima = end($resultado);

    $borrar = new Tarea("temp");

    $eliminado = $borrar->eliminarTarea($ultima['id']);

    echo "<h3>Resultado de Eliminar:</h3>";

    var_dump($eliminado);
}

// 5) LISTAR NUEVAMENTE - VERIFICACIÓN FINAL
$resultadoFinal = $temp->listarTareas();

echo "<h2>Después de Editar + Eliminar:</h2>";

foreach ($resultadoFinal as $fila) {

    $estado = $fila['completada'] ? "✅" : "⏳";

    echo "{$estado} #{$fila['id']} - {$fila['titulo']}<br>";
}


