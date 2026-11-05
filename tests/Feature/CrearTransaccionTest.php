<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transaccion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CrearTransaccionTest extends TestCase
{
    use RefreshDatabase;

    private function crear(array $datos)
    {
        $this->seed();

        Sanctum::actingAs(
            User::where('email', 'ana@taskboard.test')->first()
        );

        return $this->postJson('/api/transacciones', array_merge([
            'comercio_id'    => 1,
            'cliente_nombre' => 'Luis',
            'monto'          => 25.50,
        ], $datos));
    }

    public function test_cl02_monto_cero_responde_422(): void
    {
        $this->crear(['monto' => 0])
            ->assertStatus(422)
            ->assertJsonValidationErrors('monto');
    }

    public function test_cl07_monto_excesivo_responde_422(): void
    {
        $this->crear(['monto' => 100000000])
            ->assertStatus(422)
            ->assertJsonValidationErrors('monto');
    }

    public function test_e02_tres_decimales(): void
    {
        $this->crear(['monto' => 25.999])
            ->assertStatus(422)
            ->assertJsonValidationErrors('monto');
    }

    public function test_e03_estado_prohibido(): void
    {
        $this->crear(['estado' => 'Completada'])
            ->assertStatus(422)
            ->assertJsonValidationErrors('estado');
    }

    public function test_crear_registra_el_evento(): void
    {
        $this->crear([])
            ->assertStatus(201);

        $id = Transaccion::latest('id')->first()->id;

        $this->assertDatabaseHas('eventos_transaccion', [
            'transaccion_id' => $id,
            'tipo_evento'    => 'creacion',
        ]);
    }
}
