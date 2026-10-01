 
 
<?php $__env->startSection('titulo', 'Nueva transacción'); ?> 
  
<?php $__env->startSection('contenido'); ?> 
  <h1>Nueva transacción</h1> 
  <p class="meta">Comercio: <?php echo e($comercio->nombre_comercio); ?></p> 
  
  <form action="<?php echo e(route('transacciones.store')); ?>" method="POST"> 
    <?php echo csrf_field(); ?> 
    <input type="hidden" name="comercio_id" value="<?php echo e($comercio->id); ?>"> 
  
    <label for="cliente">Cliente</label> 
    <input id="cliente" name="cliente_nombre" type="text"><br> 
  
    <label for="monto">Monto</label> 
    <input id="monto" name="monto" type="number" step="0.01"><br> 

    <input type="hidden" name="estado" value="Completada">
  
    <button type="submit">Registrar</button> 
  </form> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\javie\Herd\Proyecto-Integracion-de-Sistemas\Semana 9\taskboard\resources\views/transacciones/create.blade.php ENDPATH**/ ?>