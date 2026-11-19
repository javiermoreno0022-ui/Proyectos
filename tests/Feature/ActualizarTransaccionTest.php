<?php

namespace Tests\Feature;

use App\Models\Comercio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Enums\EstadoTransaccion;

class ActualizarTransaccionTest extends TestCase
{
    use RefreshDatabase;

    private function crearTransaccion(
        User $usuario,
        EstadoTransaccion $estado = EstadoTransaccion::Iniciada
    ) {
        $comercio = Comercio::factory()->create([
            'user_id' => $usuario->id,
        ]);

        return $comercio->transacciones()->create([
            'cliente_nombre' => 'Luis',
            'monto' => 100,
            'metodo' => 'tarjeta',
            'comision' => 3.50,
            'estado' => $estado,
        ]);
    }

    public function test_usuario_puede_cambiar_estado_de_transaccion_iniciada(): void
    {
        $usuario = User::factory()->create();
        $transaccion = $this->crearTransaccion($usuario);

        Sanctum::actingAs($usuario);

        $this->patchJson("/api/transacciones/{$transaccion->id}", [
            'estado' => EstadoTransaccion::Completada->value,
        ])->assertOk();

        $this->assertDatabaseHas('transacciones', [
            'id' => $transaccion->id,
            'estado' => EstadoTransaccion::Completada->value,
        ]);

        $this->assertDatabaseHas('eventos_transaccion', [
            'transaccion_id' => $transaccion->id,
            'tipo_evento' => 'cambio_estado',
        ]);
    }

    public function test_no_puede_cambiar_estado_si_transaccion_no_esta_iniciada(): void
    {
        $usuario = User::factory()->create();
        $transaccion = $this->crearTransaccion($usuario, EstadoTransaccion::Completada);

        Sanctum::actingAs($usuario);

        $this->patchJson("/api/transacciones/{$transaccion->id}", [
            'estado' => EstadoTransaccion::Fallida->value,
        ])
            ->assertStatus(422)
            ->assertJsonPath(
                'errors.estado.0',
                'Solo se pueden cambiar transacciones en estado Iniciada.'
            );

        $this->assertDatabaseHas('transacciones', [
            'id' => $transaccion->id,
            'estado' => EstadoTransaccion::Completada->value,
        ]);
    }

    public function test_usuario_no_puede_actualizar_transaccion_de_otro_usuario(): void
    {
        $usuario = User::factory()->create();
        $otroUsuario = User::factory()->create();

        $transaccionAjena = $this->crearTransaccion($otroUsuario);

        Sanctum::actingAs($usuario);

        $this->patchJson("/api/transacciones/{$transaccionAjena->id}", [
            'estado' => EstadoTransaccion::Completada->value,
        ])->assertNotFound();
    }
}
