<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $datos = $request->validate([
            'email'       => ['required', 'email'],
            'password'    => ['required'],
            'dispositivo' => ['required', 'max:100'],
        ]);

        $user = User::where('email', $datos['email'])->first();

        if (! $user || ! Hash::check($datos['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Las credenciales no coinciden.',
            ]);
        }

        $token = $user->createToken($datos['dispositivo']);

        return response()->json([
            'token' => $token->plainTextToken,
            'tipo'  => 'Bearer',
        ], 201);
    }
    public function yo(Request $request)
    {
    return $request->user()->only('id', 'name', 'email');
    }

    public function logout(Request $request)
    {
    $token = PersonalAccessToken::findToken($request->bearerToken());

    if (
        $token &&
        $token->tokenable_id == $request->user()->id &&
        $token->tokenable_type === $request->user()->getMorphClass()
    ) {
        $token->delete();
    }

    return response()->noContent();
    }

    public function tokens(Request $request)
    {
    return $request->user()->tokens()
        ->get(['id', 'name', 'created_at', 'last_used_at']);
    }

    public function eliminarToken(Request $request, int $id)
    {
    $token = $request->user()->tokens()->findOrFail($id);

    $token->delete();

    return response()->noContent();
    }
}
