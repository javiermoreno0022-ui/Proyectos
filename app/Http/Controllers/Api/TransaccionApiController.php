<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarTransaccionRequest;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Http\Resources\TransaccionResource;

class TransaccionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $estado = request()->query('estado');

        $transacciones = Transaccion::when(
        $estado,
        fn ($q) => $q->where('estado', $estado)
        )->latest()->get();

        return TransaccionResource::collection($transacciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarTransaccionRequest $request)
    {
    $transaccion = Transaccion::create($request->validated());

    return (new TransaccionResource($transaccion))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaccion $transaccione)
    {
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
    $transaccione->delete();

    return response()->noContent();   // 204
    }
}
