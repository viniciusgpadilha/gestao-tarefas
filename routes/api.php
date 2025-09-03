<?php

use App\Http\Controllers\TasksController;
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

Route::get('/tasks', [TasksController::class, 'index'])->name('index');

Route::get('/tasks/{id}', [TasksController::class, 'get'])->name('get');

Route::put('/tasks/update/{id}', [TasksController::class, 'update'])->name('update');

Route::delete('/tasks/delete/{id}', [TasksController::class, 'delete'])->name('delete');

Route::post('/tasks/store', [TasksController::class, 'store'])->name('store');



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');