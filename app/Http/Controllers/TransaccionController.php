<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Models\Transaccion;
use App\Http\Requests\GuardarTransaccionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Enums\EstadoTransaccion;
use App\Services\TransaccionService;

class TransaccionController extends Controller
{
    public function __construct(
    private TransaccionService $servicio
    ) {}
    private function autorizar(Transaccion $t): void
    {
        abort_unless($t->comercio->user_id === Auth::id(), 404);
    }

    // Mostrar el formulario de creación
    public function create(Comercio $comercio): View
    {
        abort_unless($comercio->user_id === Auth::id(), 404);

        $comercios = Auth::user()
            ->comercios()
            ->orderBy('nombre_comercio')
            ->get();

        return view('transacciones.create', compact('comercio', 'comercios'));
    }

    // Registrar una transacción
    public function store(GuardarTransaccionRequest $request)
    {
        $transaccion = Transaccion::create($request->validated());

        return redirect()
            ->route('comercios.show', $transaccion->comercio_id)
            ->with('mensaje', 'Transacción registrada con éxito.');
    }

    // Mostrar el formulario de edición
    public function edit(Transaccion $transaccion): View
    {
        $this->autorizar($transaccion);

        $comercios = Auth::user()
            ->comercios()
            ->orderBy('nombre_comercio')
            ->get();

        return view('transacciones.edit', compact('transaccion', 'comercios'));
    }

    // Actualizar una transacción existente
    public function update(
        GuardarTransaccionRequest $request,
        Transaccion $transaccion
    ) {
        $this->autorizar($transaccion);

        $transaccion->update($request->validated());

        return redirect()
            ->route('comercios.show', $transaccion->comercio_id)
            ->with('mensaje', 'Transacción actualizada correctamente.');
    }

    // Eliminar una transacción
    public function destroy(Transaccion $transaccion)
    {
        $this->autorizar($transaccion);

        $comercioId = $transaccion->comercio_id;
        $cliente = $transaccion->cliente_nombre;

        $transaccion->delete();

        return redirect()
            ->route('comercios.show', $comercioId)
            ->with('mensaje', "Transacción de {$cliente} eliminada.");
    }

    // Cambiar el estado de una transacción
    // Cambiar el estado de una transacción
    public function moverEstado(Transaccion $transaccion, string $estado)
    {
    $this->autorizar($transaccion);

    $nuevoEstado = EstadoTransaccion::tryFrom($estado);

    if (!$nuevoEstado) {
        abort(400, 'Estado no válido.');
    }

    $this->servicio->moverEstado($transaccion, $nuevoEstado);

    return redirect()
        ->route('comercios.show', $transaccion->comercio_id)
        ->with('mensaje', "Transacción movida a {$nuevoEstado->value}.");
    }
}