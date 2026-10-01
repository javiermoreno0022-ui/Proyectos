<!DOCTYPE html> 
<html lang="es"> 
<head><meta charset="UTF-8"><title>Sandbox de formulario</title></head> 
<body> 
  <h1>Laboratorio de formularios</h1> 
  
  <form method="POST" action="/practica/enviar">
    <?php echo csrf_field(); ?>
    <label for="cliente">Cliente</label> 
    <input id="cliente" name="cliente_nombre" type="text"><br> 
    
    <label for="monto">Monto</label> 
    <input id="monto" name="monto" type="number" step="0.01"><br>

    <label for="correo">Correo de contacto</label>
    <input type="email" id="correo" name="correo"><br>

    <label for="recurrente">¿Es una transacción recurrente?</label>
    <input type="checkbox" id="recurrente" name="recurrente"><br>

    <label for="estado">Estado</label> 
    <select id="estado" name="estado"> 
      <option value="Iniciada">Iniciada</option> 
      <option value="Completada">Completada</option> 
    </select><br> 
  
    <button type="submit">Enviar (modo prueba)</button> 
  </form> 
</body> 
</html>






<?php /**PATH C:\Users\javie\Herd\Proyecto-Integracion-de-Sistemas\Semana 9\taskboard\resources\views/practica/formulario_demo.blade.php ENDPATH**/ ?>