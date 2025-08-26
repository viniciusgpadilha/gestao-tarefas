<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = $request->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "token_type" => 'Beater'
        ]);
    }

    return response()->json([
        "message" => "Usuário inválido"
    ]);
});

Route::get('/tasks', function (Request $request) {
    return [
        ['id' => 1, 'nome' => 'João'],
        ['id' => 2, 'nome' => 'Tido'],
        ['id' => 3, 'nome' => 'Rafael']
    ];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');