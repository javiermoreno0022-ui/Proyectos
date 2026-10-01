<?php $__env->startSection('titulo', $comercio->nombre_comercio); ?>

<?php $__env->startSection('contenido'); ?>
    <p><a href="<?php echo e(route('comercios.index')); ?>">&larr; Volver a comercios</a></p>

    <h1><?php echo e($comercio->nombre_comercio); ?></h1>
    <p>
    <a href="<?php echo e(route('transacciones.create', $comercio)); ?>">
        + Nueva transacción
    </a>
    </p>

    <p class="meta">
        Rubro: <?php echo e($comercio->rubro); ?>

        &middot;
        Teléfono: <?php echo e($comercio->telefono ?? 'Sin teléfono registrado'); ?>

    </p>

    <h2>Transacciones</h2>

    <?php $__empty_1 = true; $__currentLoopData = $comercio->transacciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card">
            <strong>$<?php echo e(number_format($transaccion->monto, 2)); ?></strong>
            — <?php echo e($transaccion->cliente_nombre); ?>

            <?php if (isset($component)) { $__componentOriginal9c947ba6e39685f9d66d4e62ab77716a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c947ba6e39685f9d66d4e62ab77716a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge-estado','data' => ['estado' => $transaccion->estado]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge-estado'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['estado' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($transaccion->estado)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c947ba6e39685f9d66d4e62ab77716a)): ?>
<?php $attributes = $__attributesOriginal9c947ba6e39685f9d66d4e62ab77716a; ?>
<?php unset($__attributesOriginal9c947ba6e39685f9d66d4e62ab77716a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c947ba6e39685f9d66d4e62ab77716a)): ?>
<?php $component = $__componentOriginal9c947ba6e39685f9d66d4e62ab77716a; ?>
<?php unset($__componentOriginal9c947ba6e39685f9d66d4e62ab77716a); ?>
<?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Sin transacciones</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\javie\Herd\Proyecto-Integracion-de-Sistemas\Semana 9\taskboard\resources\views/comercios/show.blade.php ENDPATH**/ ?>