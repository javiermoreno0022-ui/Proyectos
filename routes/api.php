<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Comercio;
use App\Http\Resources\ComercioResource;
use App\Http\Controllers\Api\TransaccionApiController;
use App\Http\Controllers\Api\AuthApiController;

Route::post('/login', [AuthApiController::class, 'login'])
    ->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/yo', [AuthApiController::class, 'yo']);

    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/tokens', [AuthApiController::class, 'tokens']);

    Route::delete('/tokens/{id}', [AuthApiController::class, 'eliminarToken']);

    Route::get('/comercios', function (Request $request) {
    return ComercioResource::collection(
        $request->user()->comercios()
            ->orderBy('nombre_comercio')
            ->get()
        );
    });

    Route::get('/comercios/{comercio}', function (
    Request $request,
    Comercio $comercio
    ) {
    abort_unless(
        $comercio->user_id === $request->user()->id,
        404
    );

    return new ComercioResource($comercio->load('transacciones'));
    });

    Route::get(
    '/transacciones/filtrar',
    [TransaccionApiController::class, 'filtrar']
    );

    Route::apiResource('transacciones', TransaccionApiController::class);

});

