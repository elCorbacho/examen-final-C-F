<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosControllerAPI;
use App\Http\Controllers\ClientesControllerAPI;
use App\Http\Controllers\UsuariosControllerAPI;

//Route::get('/user', function (Request $request) {
//return $request->user();
//})->middleware('auth:sanctum');

Route::post('/store', [UsuariosControllerAPI::class, 'store']);
Route::post('/login', [UsuariosControllerAPI::class, 'loginApi']);

Route::middleware('auth:api')->group(function () {
    // Rutas protegidas por autenticación
    Route::apiResource('productos', ProductosControllerAPI::class);
    Route::apiResource('clientes', ClientesControllerAPI::class);
    Route::apiResource('usuarios', UsuariosControllerAPI::class);

    // Ruta para manejar rutas no encontradas dentro del middleware
    Route::fallback(function () {
    return response()->json([
        'message' => 'La ruta solicitada no existe en la API.'
    ], 404);
});
});


// Ruta para manejar rutas no encontradas fuera del middleware
Route::fallback(function () {
    return response()->json([
        'message' => 'La ruta solicitada no existe en la API.'
    ], 404);
});

