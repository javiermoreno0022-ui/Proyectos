

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['estado']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['estado']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($estado === 'Completada'): ?>
    <span class="badge verde">✔ Completada</span>
<?php elseif($estado === 'Fallida'): ?>
    <span class="badge rojo">✗ Fallida</span>
<?php else: ?>
    <span class="badge amarillo">⏳ <?php echo e($estado); ?></span>
<?php endif; ?>
<?php /**PATH C:\Users\javie\Herd\Proyecto-Integracion-de-Sistemas\Semana 7\taskboard\resources\views/components/badge-estado.blade.php ENDPATH**/ ?>