<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarTransaccionRequest;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Http\Resources\TransaccionResource;
use Illuminate\Support\Facades\DB;

class TransaccionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $estado = $request->query('estado');

    $transacciones = Transaccion::whereHas(
        'comercio',
        fn ($q) => $q->where('user_id', $request->user()->id)
    )
        ->when($estado, fn ($q) => $q->where('estado', $estado))
        ->latest()
        ->get();

    return TransaccionResource::collection($transacciones);
    }
    private function autorizar(Transaccion $t): void
    {
        abort_unless($t->comercio->user_id === auth()->id(), 404);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarTransaccionRequest $request)
    {
    $datos = $request->validated();

    $datos['estado'] = 'Iniciada';

    $t = DB::transaction(function () use ($datos) {
        $t = Transaccion::create($datos);

        $t->eventos()->create([
            'tipo_evento' => 'creacion',
            'detalle'     => 'Transacción iniciada',
        ]);

        return $t;
    });

    return (new TransaccionResource($t))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaccion $transaccione)
    {
    $this->autorizar($transaccione);

    return new TransaccionResource($transaccione);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaccion $transaccione)
    {
    $this->autorizar($transaccione);

    $transaccione->delete();

    return response()->noContent();
    }
}
