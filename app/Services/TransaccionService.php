<?php

namespace App\Services;

use App\Models\Transaccion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\CalculadoraComision;
use App\Enums\EstadoTransaccion;

class TransaccionService
{
    public function __construct(
    private CalculadoraComision $calculadora
    ) {}
    public function registrar(User $usuario, array $datos): Transaccion
    {
        // 1. Verificar que el comercio pertenezca al usuario.
        $comercio = $usuario->comercios()->findOrFail($datos['comercio_id']);

        // 2. Calcular la comisión según el método de pago.
        $comision = $this->calculadora->calcular(
            $datos['metodo'],
            (float) $datos['monto']
        );

        // 3. Registrar la transacción y su evento en una operación atómica.
        $transaccion = DB::transaction(function () use ($comercio, $datos, $comision) {
            $transaccion = $comercio->transacciones()->create([
                'cliente_nombre' => $datos['cliente_nombre'],
                'monto'          => $datos['monto'],
                'metodo'         => $datos['metodo'],
                'comision'       => $comision,
                'estado' => EstadoTransaccion::Iniciada,
            ]);

            $transaccion->eventos()->create([
                'tipo_evento' => 'creacion',
                'detalle'     => 'Transacción iniciada',
            ]);

            return $transaccion;
        });
        
        

        // 4. Registrar la operación en el log.
        Log::info("Transacción {$transaccion->id} registrada");

        return $transaccion;
    }

    public function cambiarEstado(User $usuario, Transaccion $t, EstadoTransaccion $nuevo): Transaccion
    {
    // 1. Verificar que la transacción pertenezca al usuario.
    $transaccion = Transaccion::whereKey($t->id)
        ->whereHas('comercio', fn ($q) => $q->where('user_id', $usuario->id))
        ->firstOrFail();

    // 2. Solo permitir cambios desde el estado Iniciada.
    if ($transaccion->estado !== EstadoTransaccion::Iniciada) {
        throw ValidationException::withMessages([
            'estado' => ['Solo se pueden cambiar transacciones en estado Iniciada.'],
        ]);
    }

    // 3. Actualizar el estado y registrar el evento en una operación atómica.
    DB::transaction(function () use ($transaccion, $nuevo) {
        $estadoAnterior = $transaccion->estado;

        $transaccion->update([
        'estado' => $nuevo,
        ]);

        $transaccion->eventos()->create([
        'tipo_evento' => 'cambio_estado',
        'detalle' => "Estado cambiado de {$estadoAnterior->value} a {$nuevo->value}",
        ]);
    });

    // 4. Registrar la operación en el log.
    Log::info("Transaccion {$transaccion->id} cambio de estado a {$nuevo->value}");

    return $transaccion->refresh();
    }

    public function moverEstado(
    Transaccion $transaccion,
    EstadoTransaccion $nuevoEstado
    ): Transaccion {
    $transiciones = [
        EstadoTransaccion::Iniciada->value => [
            EstadoTransaccion::Completada,
            EstadoTransaccion::Fallida,
        ],
        EstadoTransaccion::Completada->value => [],
        EstadoTransaccion::Fallida->value => [
            EstadoTransaccion::Iniciada,
        ],
    ];

    if (!in_array(
        $nuevoEstado,
        $transiciones[$transaccion->estado->value] ?? [],
        true
    )) {
        abort(
            400,
            "No se puede mover de {$transaccion->estado->value} a {$nuevoEstado->value}."
        );
    }

    $transaccion->update([
        'estado' => $nuevoEstado,
    ]);

    return $transaccion;
    }
}