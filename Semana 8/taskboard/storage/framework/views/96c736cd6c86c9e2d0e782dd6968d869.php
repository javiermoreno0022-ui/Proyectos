<?php $__env->startSection('titulo', 'Comercios afiliados'); ?>

<?php $__env->startSection('contenido'); ?>
    <h1>Comercios afiliados a la pasarela</h1>

    <ul class="comercios">
        <?php $__empty_1 = true; $__currentLoopData = $comercios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comercio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li class="card">
                <a href="<?php echo e(route('comercios.show', $comercio)); ?>">
                    <?php echo e($comercio->nombre_comercio); ?>

                </a>
                <span class="meta">— <?php echo e($comercio->rubro); ?>

                    (<?php echo e($comercio->transacciones_count); ?> transacciones)</span>
                <br>
                <?php if (isset($component)) { $__componentOriginal7ad24a46054ce970b1b5f9f0a1c190c6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ad24a46054ce970b1b5f9f0a1c190c6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge-actividad','data' => ['totalTransacciones' => $comercio->transacciones_count]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge-actividad'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['totalTransacciones' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($comercio->transacciones_count)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ad24a46054ce970b1b5f9f0a1c190c6)): ?>
<?php $attributes = $__attributesOriginal7ad24a46054ce970b1b5f9f0a1c190c6; ?>
<?php unset($__attributesOriginal7ad24a46054ce970b1b5f9f0a1c190c6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ad24a46054ce970b1b5f9f0a1c190c6)): ?>
<?php $component = $__componentOriginal7ad24a46054ce970b1b5f9f0a1c190c6; ?>
<?php unset($__componentOriginal7ad24a46054ce970b1b5f9f0a1c190c6); ?>
<?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li class="card">Aún no hay comercios afiliados.</li>
        <?php endif; ?>
    </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\javie\Herd\Proyecto-Integracion-de-Sistemas\Semana 8\taskboard\resources\views/comercios/index.blade.php ENDPATH**/ ?>