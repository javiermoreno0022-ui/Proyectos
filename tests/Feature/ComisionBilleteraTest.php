<?php

namespace Tests\Feature;

use App\Models\Comercio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ComisionBilleteraTest extends TestCase
{
    use RefreshDatabase;

    public function test_comision_billetera_es_del_2_por_ciento(): void
    {
        $usuario = User::factory()->create();

        $comercio = Comercio::factory()->create([
            'user_id' => $usuario->id,
        ]);

        Sanctum::actingAs($usuario);

        $this->postJson('/api/transacciones', [
            'comercio_id' => $comercio->id,
            'cliente_nombre' => 'Luis',
            'monto' => 100,
            'metodo' => 'billetera',
        ])->assertStatus(201);

        $this->assertDatabaseHas('transacciones', [
            'comercio_id' => $comercio->id,
            'metodo' => 'billetera',
            'monto' => 100,
            'comision' => 2.00,
        ]);
    }
}