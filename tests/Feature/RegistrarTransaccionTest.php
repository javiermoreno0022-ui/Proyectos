<?php

namespace Tests\Feature;

use App\Models\Comercio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RegistrarTransaccionTest extends TestCase
{
    use RefreshDatabase;

    private function prepararUsuarioYComercio(): array
    {
        $usuario = User::factory()->create();

        $comercio = Comercio::factory()->create([
            'user_id' => $usuario->id,
        ]);

        Sanctum::actingAs($usuario);

        return [$usuario, $comercio];
    }

    public function test_comision_tarjeta_es_del_35_por_ciento(): void
    {
        [, $comercio] = $this->prepararUsuarioYComercio();

        $this->postJson('/api/transacciones', [
            'comercio_id' => $comercio->id,
            'cliente_nombre' => 'Luis',
            'monto' => 100,
            'metodo' => 'tarjeta',
        ])->assertStatus(201);

        $this->assertDatabaseHas('transacciones', [
            'comercio_id' => $comercio->id,
            'metodo' => 'tarjeta',
            'monto' => 100,
            'comision' => 3.50,
        ]);
    }

    public function test_comision_transferencia_es_fija_de_150(): void
    {
        [, $comercio] = $this->prepararUsuarioYComercio();

        $this->postJson('/api/transacciones', [
            'comercio_id' => $comercio->id,
            'cliente_nombre' => 'Luis',
            'monto' => 100,
            'metodo' => 'transferencia',
        ])->assertStatus(201);

        $this->assertDatabaseHas('transacciones', [
            'comercio_id' => $comercio->id,
            'metodo' => 'transferencia',
            'monto' => 100,
            'comision' => 1.50,
        ]);
    }

    public function test_no_puede_usar_comercio_de_otro_usuario(): void
    {
        $this->prepararUsuarioYComercio();

        $otroUsuario = User::factory()->create();

        $comercioAjeno = Comercio::factory()->create([
            'user_id' => $otroUsuario->id,
        ]);

        $this->postJson('/api/transacciones', [
            'comercio_id' => $comercioAjeno->id,
            'cliente_nombre' => 'Luis',
            'monto' => 100,
            'metodo' => 'tarjeta',
        ])->assertStatus(404);
    }

    public function test_datos_invalidos_responden_422(): void
    {
        [, $comercio] = $this->prepararUsuarioYComercio();

        $this->postJson('/api/transacciones', [
            'comercio_id' => $comercio->id,
            'cliente_nombre' => 'Luis',
            'monto' => 0,
            'metodo' => 'tarjeta',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('monto');
    }

    public function test_usuario_sin_token_recibe_401(): void
    {
        $usuario = User::factory()->create();

        $comercio = Comercio::factory()->create([
            'user_id' => $usuario->id,
        ]);

        $this->postJson('/api/transacciones', [
            'comercio_id' => $comercio->id,
            'cliente_nombre' => 'Luis',
            'monto' => 100,
            'metodo' => 'tarjeta',
        ])->assertStatus(401);
    }
}
