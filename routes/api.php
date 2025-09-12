<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productoControllerAPI;
use App\Http\Controllers\clienteControllerAPI;
use App\Http\Controllers\usuarioControllerAPI;

//Route::get('/user', function (Request $request) {
//return $request->user();
//})->middleware('auth:sanctum');

Route::post('/store', [usuarioControllerAPI::class, 'store']);
Route::post('/login', [usuarioControllerAPI::class, 'loginApi']);

Route::middleware('auth:api')->group(function () {
    // Rutas protegidas por autenticación
    Route::apiResource('productos', productoControllerAPI::class);
    Route::apiResource('clientes', clienteControllerAPI::class);
    Route::apiResource('usuarios', usuarioControllerAPI::class);
    Route::fallback(function () {
    return response()->json([
        'message' => 'La ruta solicitada no existe en la API.'
    ], 404);
});
});

Route::fallback(function () {
    return response()->json([
        'message' => 'La ruta solicitada no existe en la API.'
    ], 404);
});

