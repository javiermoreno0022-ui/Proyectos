<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarTransaccionRequest;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Http\Resources\TransaccionResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransaccionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $datos = $request->validate([
        'estado' => [
            'nullable',
            Rule::in(['Iniciada', 'Completada', 'Fallida']),
        ],
    ]);

    $estado = $datos['estado'] ?? null;

    $transacciones = Transaccion::whereHas(
        'comercio',
        fn ($q) => $q->where('user_id', $request->user()->id)
    )
        ->when($estado, fn ($q) => $q->where('estado', $estado))
        ->latest()
        ->get();

    return TransaccionResource::collection($transacciones);
    }

    public function filtrar(Request $request)
    {
    $validated = $request->validate([
        'estado' => [
            'sometimes',
            'nullable',
            Rule::in(['Iniciada', 'Completada', 'Fallida']),
        ],
        'desde' => [
            'sometimes',
            'nullable',
            'date_format:Y-m-d',
        ],
        'hasta' => [
            'sometimes',
            'nullable',
            'date_format:Y-m-d',
            'after_or_equal:desde',
        ],
        'monto_min' => ['nullable', 'numeric', 'min:0'],
        'monto_max' => [
        'nullable',
        'numeric',
        'min:0',
        Rule::when(
        $request->filled('monto_min'),
        ['gte:monto_min']
            ),
        ],
    ]);

    $transacciones = Transaccion::whereHas(
        'comercio',
        fn ($q) => $q->where(
            'user_id',
            $request->user()->id
        )
    )
        ->when(
            !empty($validated['estado']),
            fn ($q) => $q->where('estado', $validated['estado'])
        )
        ->when(
            !empty($validated['desde']),
            fn ($q) => $q->whereDate(
                'created_at',
                '>=',
                $validated['desde']
            )
        )
        ->when(
            !empty($validated['hasta']),
            fn ($q) => $q->whereDate(
                'created_at',
                '<=',
                $validated['hasta']
            )
        )
        ->when(
        isset($validated['monto_min']),
        fn ($q) => $q->where('monto', '>=', $validated['monto_min'])
        )
        ->when(
        isset($validated['monto_max']),
        fn ($q) => $q->where('monto', '<=', $validated['monto_max'])
            )
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
